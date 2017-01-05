<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Base_Controller {
	function __construct()
	{
		parent::__construct();
		//加载model
		$this->load->model('Upload_file_model');
	}
	public function aliyunmail(){
		$accesskey=$this->config->item('aliyunAccess');
		include_once BASEPATH.'sdk/aliyun-php-sdk-core/Config.php';
		$iClientProfile = DefaultProfile::getProfile("cn-hangzhou", $accesskey['KeyID'], $accesskey['Secret']);
		$client = new DefaultAcsClient($iClientProfile);
		$request = new Dm\Request\V20151123\SingleSendMailRequest();
		$request->setAccountName("hekunyu@mail.hemisu.com");
		$request->setAddressType(1);
		$request->setTagName("forget");
		$request->setReplyToAddress("true");
		$request->setToAddress("");
		$request->setSubject("aliyun mail test");
		$request->setHtmlBody("test");
		$response = $client->getAcsResponse($request);
		print_r($response);
	}
	/*
	 * Qiniu云 token生成
	 * @return json token
	 */
	public function Qiniu_token(){
		//转码
		$mimetocmd = array(
			'video/x-ms-wmv' => 'vframe/jpg/offset/7/w/480/h/360', //wmv
			'video/x-msvideo' => 'avthumb/mp4/ab/160k/ar/48000/acodec/libfaac/r/30/vb/2200k/vcodec/libx264/s/1280x720/autoscale/1/stripmeta/0;vframe/jpg/offset/7/w/480/h/360', //avi
			'video/quicktime' => 'avthumb/mp4/ab/160k/ar/48000/acodec/libfaac/r/30/vb/2200k/vcodec/libx264/s/1280x720/autoscale/1/stripmeta/0;vframe/jpg/offset/7/w/480/h/360', //mov
			'application/msword' => 'odconv/pdf', //doc
			'application/vnd.ms-powerpoint' => 'odconv/pdf', //ppt
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'odconv/pdf', //docx
			'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'odconv/pdf', //pptx
		);

		include_once BASEPATH.'sdk/Qiniu/autoload.php';

		$qiniuAccess = $this->config->item('qiniuAccess');
		$accessKey = $qiniuAccess['accessKey'];
		$secretKey = $qiniuAccess['secretKey'];
		// 要上传的空间
		$bucket = 'stumanager';
		//自定义变量
		$custome_callback_var = '&sid=$(x:sid)&pid=$(x:pid)&cfname=$(x:cfname)';
		$auth = new Qiniu\Auth($accessKey, $secretKey);
		//Post获得数据
		$fname = $this->input->post('fname');
		$fsize = $this->input->post('fsize');
		$ftype = $this->input->post('ftype');

		//上传策略（PutPolicy）
		//http://developer.qiniu.com/docs/v6/api/reference/security/put-policy.html#put-policy-persistent-ops-explanation
		if(isset($mimetocmd[$ftype])){
			$policy['PersistentOps'] = $mimetocmd[$ftype];
			$policy['PersistentNotifyUrl'] = base_url('api/qiniu_notify');
			$policy['PersistentPipeline'] = 'stumps';//hardcode
		}
		$policy['scope'] = $bucket;
		$policy['callbackUrl'] = base_url('api/Qiniu_callback');
		$policy['callbackBody'] = 'key=$(key)&fname=$(fname)&fsize=$(fsize)&mimeType=$(mimeType)&persistentId=$(persistentId)&bucket=$(bucket)' . $custome_callback_var;
		// 生成上传 Token


		$upToken = $auth->uploadToken($bucket, null, 3600, $policy);

		echo json_encode(array("uptoken" => $upToken));

	}
	/*
	 * Qiniu_callback 七牛云回调
	 */
	public function Qiniu_callback(){
		if(empty($_POST['key']))exit(json_encode(array('tips'=>'禁止访问')));
		//vars from qiniu
		//save them into db and get the last id
		$key = $this->input->post('key');
		$fname = $this->input->post('fname'); //if fname is empty use cfname instead of fname
		$fsize = $this->input->post('fsize');
		$mimeType = $this->input->post('mimeType');
		$persistentId = $this->input->post('persistentId'); //may empty
		$bucket = $this->input->post('bucket');
		$pid = $this->input->post('pid'); //parent folder id
		$cfname = $this->input->post('cfname'); //if fname is empty use cfname instead of fname
		$student_id = $this->input->post('sid'); //if fname is empty use cfname instead of fname

		$params = array();
		$params['parent_id'] = ($pid != null && $pid != '' && is_numeric($pid)) ? $pid : null;
		$params['student_id'] = $student_id;
		$params['file_name'] = ($fname != null && $fname != '') ? $fname : $cfname;
		$params['file_size'] = $fsize;
		$params['persistent_ID'] = ($persistentId != null && $persistentId != '') ? $persistentId : null;
		$params['is_processing'] = ($persistentId != null && $persistentId != '') ? 1 : null;
		$params['create_time'] = date('Y-m-d H:i:s',time());//创建时间
		//set thumb url for image
		if(stripos($mimeType,"image") !== false){
			$params['thumb'] = $key . '?imageView2/2/w/200/h/200';
		}
		else{
			$params['thumb'] = null;
		}

		if(stripos($mimeType,"image") !== false || stripos($mimeType,"application/pdf") !== false ){
			$params['preview'] = $key;
		}
		else{
			$params['preview'] = null;
		}
		$params['key_orignal'] = $key;//源地址
		$params['mime_type'] = $mimeType;
		$params['bucket'] = $bucket;
		$params['student_id'] = $student_id;



		$id = $this->Upload_file_model->insert($params);
		echo json_encode(array('id' => $id));
	}
	/*
	 * Qiniu_privateDownloadUrl 私有连接生成
	 */
	public function Qiniu_privateDownloadUrl(){
		include_once BASEPATH.'sdk/Qiniu/autoload.php';

		$qiniuAccess = $this->config->item('qiniuAccess');
		$accessKey = $qiniuAccess['accessKey'];
		$secretKey = $qiniuAccess['secretKey'];
		$auth = new Qiniu\Auth($accessKey, $secretKey);
		$bucketurl = "http://7xozcr.com1.z0.glb.clouddn.com/FqNS90EaGy0P_hBMHz2ZexN2_sFV?imageView2/2/w/200/h/200";
		$auth = new Qiniu\Auth($accessKey, $secretKey);

		$privateurl = $auth->privateDownloadUrl($bucketurl);
		echo $privateurl;
	}
	public function setitem(){
		echo $this->config->set_item('site_name', 'StuManager');
		echo $this->config->item('site_name');
	}
	public function q1(){
//		exit('都是大头的锅，打死大头');
		if(isset($_POST['student_id'])){
			$arr = explode(' ',$_POST['student_id']);
			sort($arr);
			$num=count($arr);
			$html = '';
			switch($num){
				case 1:$sum=array_sum($arr);$html.="$arr[0]过桥还回来个P啊！";break;
				case 2:$sum=array_sum($arr);$html.="$arr[0],$arr[1]过桥还回来个P啊！";break;
				case 3:$sum=array_sum($arr);$html.="$arr[0],$arr[1]过桥;回来个$arr[0];再$arr[0],$arr[3]一起过桥。";break;
				default:
					$sum=0;
					while($num >= 3) {
						$time1 = $arr[1] + $arr[0] + $arr[$num - 1] + $arr[1] ;
						$time2 = $arr[$num - 1] + $arr[0] + $arr[$num - 2] + $arr[0] ;

						if($time1 < $time2){
							$sum += $time1;
							$html.= "$arr[1],$arr[0]过桥;回来个$arr[0];再$arr[0],".$arr[$num - 1]."一起过桥;"."$arr[1]再回来，";
						}else{
							$sum += $time2;
							$html.= $arr[$num - 1].",$arr[0]过桥;回来个$arr[0];再$arr[0],".$arr[$num - 2]."一起过桥;"."$arr[0]再回来，";
						}
						$num -= 2;
					}
					$sum +=$arr[1];
					$html.= "最后$arr[1],$arr[0]一起过桥";
					break;
			}


			$this->showmessage('答案是：'.$sum.';走法：'.$html,'',10);
		}
		$this->load->view('api/q1');
	}
	public function gt(){
		include_once BASEPATH.'sdk/gt-php-sdk/lib/class.geetestlib.php';
		require_once BASEPATH.'sdk/gt-php-sdk/config/config.php';
		$GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
		$user_id = "test";
		$status = $GtSdk->pre_process($user_id);
		$_SESSION['gtserver'] = $status;
		$_SESSION['user_id'] = $user_id;
		echo $GtSdk->get_response_str();
	}
	public function gtverify(){
		include_once BASEPATH.'sdk/gt-php-sdk/lib/class.geetestlib.php';
		require_once BASEPATH.'sdk/gt-php-sdk/config/config.php';
		$GtSdk = new GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
		$user_id = $_SESSION['user_id'];
		if ($_SESSION['gtserver'] == 1) {
			$result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
			if ($result) {
				echo 'Yes!';
			} else{
				echo 'No';
			}
		}else{
			if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
				echo "yes";
			}else{
				echo "no";
			}
		}
	}
}

