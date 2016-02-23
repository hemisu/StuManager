<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Base_Controller {
	function __construct()
	{
		parent::__construct();
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
		$request->setToAddress("370874047@qq.com,2456391886@qq.com,602971674@qq.com,mrzhaoly@163.com,673781215@qq.com,1907594675@qq.com,1587583937@qq.com,408838130@qq.com,244262171@qq.com,1045636917@qq.com,343124851@qq.com,865616788@qq.com,2500860526@qq.com,hemisu@qq.com,630448204@qq.com");
		$request->setSubject("aliyun mail test");
		$request->setHtmlBody("test");
		$response = $client->getAcsResponse($request);
		print_r($response);
	}
	public function qiniuyun(){
		include_once BASEPATH.'sdk/Qiniu/autoload.php';

		$qiniuAccess = $this->config->item('qiniuAccess');
		$accessKey = $qiniuAccess['accessKey'];
		$secretKey = $qiniuAccess['secretKey'];
		// 要上传的空间
		$bucket = 'stumanager';
		$auth = new Qiniu\Auth($accessKey, $secretKey);
		// 生成上传 Token
		$policy = array(
			'scope' => 'stumanager',
//			'insertOnly'=> 1,
			'callbackUrl' => 'http://zust.hemisu.com/StuManager/api/upload/callback',
			'callbackBody' => '{"fname":"$(fname)", "fkey":"$(key)", "desc":"$(x:desc)","stage":"$(x:stage)", "uid":' . '1' . '}',
			'returnBody' => '{"fname":"$(fname)", "fkey":"$(key)", "desc":"$(x:desc)", "stage":"$(x:stage)","uid":'. '1' .'}'
		);

		$upToken = $auth->uploadToken($bucket, null, 3600, $policy);

		print_r($upToken) ;
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
}

