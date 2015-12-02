<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jw extends Base_Controller {

	function __construct()
	{
		parent::__construct();
	}
	private function curl_request($url,$post='',$cookie='', $returnCookie=0){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_REFERER, "http://jwxt.zust.edu.cn/default2.aspx");
    if($post) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
    }
    if($cookie) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    }
    curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    if (curl_errno($curl)) {
        return curl_error($curl);
    }
    curl_close($curl);
    if($returnCookie){
        list($header, $body) = explode("\r\n\r\n", $data, 2);
        preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
        $info['cookie']  = substr($matches[1][0], 1);
        $info['content'] = $body;
        return $info;
    }else{
        return $data;
    }
	}
	//获取__VIEWSTATE值
	private function getView(){
	     $res=array();
	     $url = 'http://jwxt.zust.edu.cn/default2.aspx';
	     $result = $this->curl_request($url);
	     $pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
	     preg_match_all($pattern, $result, $matches);
	     $res[0] = $matches[1][0];
		   $pattern = '/<input type="hidden" name="__VIEWSTATEGENERATOR" value="(.*?)" \/>/is';
	     preg_match_all($pattern, $result, $matches);
	     if(isset($matches[1][0])){
		     $res[1] = $matches[1][0];
	     };
	     return $res;
//		print_r($res);
	}

	/**
	 * 个人信息查询
	 * @param string $xh
	 * @param string $pwd
	 * @return mixed
	 */
	private function major($xh = "",$pwd = ""){

		$result = $this->information($xh, $pwd);
		preg_match_all('/<span id="Label\d">([\w\W]*?)<\/span>/', $result, $out);

		if(!empty($out[0][2])){
			$tempStudentId=explode('：',$out[0][2]);
			$data['student_id']=end($tempStudentId);//学号
			$tempName=explode('：',$out[0][3]);
			$data['name']=end($tempName);//姓名
			$tempXy=explode('：',$out[0][4]);
			$data['xy']=end($tempXy);//学院 自动化与电气工程学院
			$tempMajor=explode('：',$out[0][5]);
			$data['major']=end($tempMajor);//专业 电气工程及其自动化
			$tempMajorClass=explode('：',$out[0][6]);
			preg_match('/\d+/', end($tempMajorClass), $classnum);
			$data['classnum']=$classnum[0];
//		print_r($data);

			return $data;
//		print_r($data);
		}

	}

	/**
	 * 课表页面 用于获取专业
	 * @param string $xh
	 * @param string $pwd
	 * @return mixed
	 */
	private function information($xh = "",$pwd = ""){

		header("Content-Type:text/html;charset=utf-8");
		$cookie = $this->login($xh,$pwd);
		$url = "http://jwxt.zust.edu.cn/xskbcx.aspx?xh=$xh";
		$result = $this->curl_request($url,'',$cookie);  //保存的cookies
		// print($result);
		return $result;

	}
	public function binding(){

		$jwinfo['student_id'] = $student_id = $this->security->xss_clean($this->input->post('student_id'));
		$jwinfo['password'] = $this->security->xss_clean($this->input->post('password'));
		$jwget = $this->major($jwinfo['student_id'] ,$jwinfo['password']);
		//无权限时访问路径
		if(!empty($_SESSION['url_forward'])){$next_url=$_SESSION['url_forward'];}else{$next_url=base_url('dashboard');}

		if(!empty($jwget['student_id'])){
			$jwUserInfo=array(
				'student_id' => $jwget['student_id'],
				'username' => $jwget['name'],
				'xy' => $jwget['xy'],
				'majorclassnum' => $jwget['major'].$jwget['classnum'],
				'next_url' => $next_url
			);
			$savejwinfo['jw_password']=base64_encode($jwinfo['password']);
			$this->User_model->update($savejwinfo,"`student_id`=$student_id");
			echo json_encode($jwUserInfo);
			$this->session->set_userdata($jwUserInfo);
		}else{
			echo json_encode(array('response' => 'error'));
		}
	}
	public function getViewchengji(){
		$res=array();
		$url = "http://jwxt.zust.edu.cn/xscj_gc.aspx?xh=1130320108";
		$cookie = $this->login();
		$result = $this->curl_request($url,'',$cookie);
		$pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
		preg_match_all($pattern, $result, $matches);
		$res[0] = $matches[1][0];
		return $res[0];
//		print_r($result);
	}
	public  function login($xh,$pwd){
	     $url = 'http://jwxt.zust.edu.cn/default2.aspx';
	     $viewState = $this->getView();
	     $post['__VIEWSTATE'] = $viewState[0];
	     $post['__VIEWSTATEGENERATOR'] = isset($viewState[1])?$viewState[1]:null;
	     $post['TextBox1'] = $xh;
	     $post['TextBox2'] = $pwd;
	     $post['txtSecretCode'] = '';
	     $post['lbLanguage'] = '';
	     $post['RadioButtonList1'] = iconv('utf-8', 'gb2312', '学生');
	     $post['Button1'] = iconv('utf-8', 'gb2312', '登录');
	     $results = $this->curl_request($url,$post,'', 1);
	     return $results['cookie'];
//			echo $results['cookie'];
	}

	public function mainpage(){
		$cookie = $this->login();
	     $url = 'http://jwxt.zust.edu.cn/xs_main.aspx?xh=1130320108';
	   $result = $this->curl_request($url,'',$cookie);  //我们保存的cookies
		 print_r($result);
	}
	public function kebiao(){
		$cookie = $this->login();
		$url = "http://jwxt.zust.edu.cn/xskbcx.aspx?xh=1130320108";
		$result = $this->curl_request($url,'',$cookie);
		// print_r($result);
		preg_match_all('/<table id="Table1"[\w\W]*?>([\w\W]*?)<\/table>/',$result,$out);
			$table = $out[0][0]; //获取整个课表

			preg_match_all('/<td [\w\W]*?>([\w\W]*?)<\/td>/',$table,$out);
		  	 $td = $out[1];
		     $length = count($td);

	    	//获得课程列表
	    	for ($i=0; $i < $length; $i++) { 
	    		$td[$i] = str_replace("<br>", "", $td[$i]);

	    		$reg = "/{(.*)}/";
	    	
	    		if (!preg_match_all($reg, $td[$i], $matches)) {
	    			unset($td[$i]);
	    		}
			}

			$td = array_values($td); //将课程列表数组重新索引
			$tdLength = count($td);
			

			print_r($td);
	}
	public function chengji(){
		$cookie = $this->login();
		$url = "http://jwxt.zust.edu.cn/xscj_gc.aspx?xh=1130320108";
		$post['ddlXN'] = '';
		$post['ddlXQ'] = '';
		$post['Button2'] = '在校学习成绩查询';
		$post['__VIEWSTATE'] = $this->getViewchengji();

		$result = $this->curl_request($url,$post,$cookie);
		// $result = iconv('gbk', 'utf-8', $result);
		// print_r($result);
		$code = str_replace("\n",'',$result) ;
		$code = strstr($code, '<table id="TabTj" width="100%">',true);
//		preg_match("/<tr.*?<\/tr>/iUs",$code,$newcode);
//		print_r($newcode);

		$tmp="/<tr.*>(.*)<\/tr>/iUs";
		preg_match_all($tmp,$code,$macthes);

		$tmp="/<td.*>(.*)<\/td>/iUs";
		$arr=Array();
		foreach($macthes[1] as $tr)
		{
		preg_match_all($tmp,$tr,$td);
		$arr[]=$td[1];
		}

			echo '<pre>';
//		print_r($macthes);
			print_r($arr);
	}
  public function roomsearch(){
    $xh = "1130320108"; //设置学号
	$pwd = "woshidiandian";  //学号对应的密码

    //登录教室查询页面，获取可选的日期
    $cookie = $this->login($xh,$pwd);
      $url = "http://jwxt.zust.edu.cn/xxjsjy.aspx?xh=1130320108";
      $result = $this->curl_request($url,'',$cookie);  //保存的cookies

      preg_match_all('/<select[\w\W]*?id="kssj">([\w\W]*?)<\/select>/',$result,$out);
      $option = trim($out[1][0]);

      // return $option;
      echo $option;
  }
  public  function getViewJs(){
      $url = "http://jwxt.zust.edu.cn/xxjsjy.aspx?xh=1130320108";
      $cookie = $this->login('1130320108','woshidiandian');
      $result = $this->curl_request($url,'',$cookie);
      $pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
      preg_match_all($pattern, $result, $matches);
      $res[0] = $matches[1][0];
      echo $res[0] ;
	}
	public function index()
	{

		echo '- -';
	}
}
