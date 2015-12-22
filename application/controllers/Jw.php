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

	/**
	 * 登陆获取cookie
	 * @param $xh
	 * @param $pwd
	 * @return mixed
	 */
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
	public function binding(){

		$jwinfo['student_id'] = $student_id = $this->security->xss_clean($this->input->post('student_id'));
		$jwinfo['password'] = $this->security->xss_clean($this->input->post('password'));
		$jwget = $this->major($jwinfo['student_id'] ,$jwinfo['password']);
		//无权限时访问路径
		if(!empty($_SESSION['url_forward'])){$next_url=$_SESSION['url_forward'];}else{$next_url=base_url('dashboard');}
		if(!$this->User_model->check_student_id($student_id)){
			exit(json_encode(array('response'=>false,'recontent'=>$this->User_model->check_student_id($student_id),'next_url'=> base_url('login/binding'))));
		}
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
			//保存成绩
			foreach($this->chengji($jwinfo['student_id'],$jwinfo['password']) as $scoreinfo){
				$r['student_id']=$student_id;$r['classcode']=$scoreinfo['classcode'];//查询条件
				if(!$this->User_score_model->get_one($r)){$this->User_score_model->set_insert($scoreinfo);}

			}
			//保存考证成绩
			unset($r);
			foreach($this->djks($jwinfo['student_id'],$jwinfo['password']) as $secstr){
				$r['student_id']=$student_id;$r['ticket_number']=$secstr['ticket_number'];//查询条件
				if(!$this->User_ranktest_model->get_one($r)){$this->User_ranktest_model->set_insert($secstr);}
			}
			echo json_encode($jwUserInfo);
			$this->session->set_userdata($jwUserInfo);
		}else{
			echo json_encode(array('response' => false,'recontent'=>'用户名或者密码错误'));
		}
	}
	/*
	 * 获取成绩页面viewstate
	 */
	private function getViewchengji($xh,$pwd){
		$res=array();
		$url = "http://jwxt.zust.edu.cn/xscj_gc.aspx?xh=".$xh;
		$cookie = $this->login($xh,$pwd);
		$result = $this->curl_request($url,'',$cookie);
		$pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
		preg_match_all($pattern, $result, $matches);
		$res[0] = $matches[1][0];
		return $res[0];
//		print_r($result);
	}
	public  function sorcedata($xh,$pwd){
		$cookie = $this->login($xh,$pwd);
		$url = "http://jwxt.zust.edu.cn/xscj_gc.aspx?xh=".$xh;
		$post['ddlXN'] = '';
		$post['ddlXQ'] = '';
		$post['Button2'] = '在校学习成绩查询';
		$post['__VIEWSTATE'] = $this->getViewchengji($xh,$pwd);

		$result = $this->curl_request($url,$post,$cookie);
		// $result = iconv('gbk', 'utf-8', $result);
//		 print_r($result);
//		echo '<pre>';
		$code = str_replace("\n",'',$result) ;
		preg_match_all("/(?<=<span id=\"pjxfjd\"><b>)平均学分绩点：(.*?)(?=<\/b><\/span>)/is",$code,$pjxfjd);//平均学分绩点
//		echo $pjxfjd[1][0].'<br/>';//输出平均学分绩点
		$datelist = strstr($code, '<table id="TabTj" width="100%">',true);
//		preg_match("/<tr.*?<\/tr>/iUs",$code,$newcode);
//		print_r($datelist);
		/*
				[0] => 学年
				[1] => 学期
				[2] => 课程代码 1
				[3] => 课程名称
				[4] => 课程性质
				[5] => 课程归属 1
				[6] => 学分
				[7] => 绩点
				[8] => 成绩
				[9] => 辅修标记
				[10] => 补考成绩
				[11] => 重修成绩
				[12] => 学院名称
				[13] => 重修标记

				[0] => 2013-2014
				[1] => 1
				[2] => 02113020
				[3] => C语言程序设计
				[4] => 必修课
				[5] =>
				[6] => 4.0
				[7] => 4.1
				[8] => 91
				[9] => 0
				[10] =>
				[11] =>
				[12] => 信息与电子工程学院
				[13] => 0
		 */
		$tmp="/<tr.*>(.*)<\/tr>/iUs";
		preg_match_all($tmp,$datelist,$macthes);

		$tmp="/<td.*>(.*)<\/td>/iUs";
		$structrue = array('schoolyear','term','classcode','coursename','nature','student_id','credit','points','score','minormark','makeup','rebuild','collegename','rebuildmark');//score数据结构
		foreach($macthes[1] as $tr)
		{
			preg_match_all($tmp,$tr,$td);
			$td[1][5] = $xh;//课程归属改为学号

			switch($td[1][8]){
				case '优秀':$td[1][8]=95;break;//五级制转化为百分制
				case '良好':$td[1][8]=85;break;
				case '中等':$td[1][8]=75;break;
				case '及格':$td[1][8]=65;break;
				case '不及格':$td[1][8]=0;break;
				case '合格':$td[1][8]=85;break;//二级制转化为百分制
				default:break;
			}
			for($i=0;$i<count($structrue);$i++){
				$td[1][$structrue[$i]]=$td[1][$i];
			}
			$td[1]=array_slice($td[1], 14);
			$score[]=$td[1];
		}
		unset($score[0]);
		echo "<pre>";
		print_r($score);

//		echo '<table><tr><td>学年</td><td>学期</td><td>课程代码</td><td>课程名称</td><td>课程性质</td><td>学号</td><td>学分</td><td>绩点</td><td>成绩</td><td>辅修标记</td><td>补考成绩</td><td>重修成绩</td><td>学院名称</td><td>重修标记</td></tr>';
//		foreach($score as $k){
//			echo '<tr>';
//			foreach($k as $v){
//				echo '<td>'.$v.'</td>';
//			}
//			echo '</tr>';
//		}
//		echo '</table>';

	}
	/*
	 * 获取考证页面
	 */
	public  function djks($xh,$pwd){
		$cookie = $this->login($xh,$pwd);
		$url = "http://jwxt.zust.edu.cn/xsdjkscx.aspx?xh=".$xh;
		$post['ddlXN'] = '';
		$post['ddlXQ'] = '';
		$result = $this->curl_request($url,$post,$cookie);
		// $result = iconv('gbk', 'utf-8', $result);
//		 print_r($result);
//		echo '<pre>';
		$tmp="/<tr.*>(.*)<\/tr>/iUs";
		preg_match_all($tmp,$result,$macthes);

		$tmp="/<td.*>(.*)<\/td>/iUs";
		$structrue = array('schoolyear','term','testname','ticket_number','testdate','score','listeningscore','readingscore','writingscore','comprehensivescore','student_id');//score数据结构
		foreach($macthes[1] as $tr)
		{
			preg_match_all($tmp,$tr,$td);
			$td[1][10]=$xh;
			for($i=0;$i<count($structrue);$i++){
				$td[1][$structrue[$i]]=$td[1][$i];
			}
			$td[1]=array_slice($td[1], 11);
			$djks[]=$td[1];
		}
//		$datelist = strstr($code, '',true);
		/**
		 *     [0] => Array
		(
		[0] => 学年
		[1] => 学期
		[2] => 等级考试名称
		[3] => 准考证号
		[4] => 考试日期
		[5] => 成绩
		[6] => 听力成绩
		[7] => 阅读成绩
		[8] => 写作成绩
		[9] => 综合成绩
		)

		[1] => Array
		(
		[0] => 2013-2014
		[1] => 2
		[2] => 计算机二级
		[3] => 141531121103311
		[4] => 2014-4-26
		[5] => 77.00
		[6] =>
		[7] =>
		[8] =>
		[9] =>
		)

		 */
		unset($djks[0]);
		return $djks;
//		echo "<pre>";
//		print_r($djks);
	}


	private function chengji($xh,$pwd){
		$cookie = $this->login($xh,$pwd);
		$url = "http://jwxt.zust.edu.cn/xscj_gc.aspx?xh=".$xh;
		$post['ddlXN'] = '';
		$post['ddlXQ'] = '';
		$post['Button2'] = '在校学习成绩查询';
		$post['__VIEWSTATE'] = $this->getViewchengji($xh,$pwd);

		$result = $this->curl_request($url,$post,$cookie);
		// $result = iconv('gbk', 'utf-8', $result);
//		 print_r($result);
//		echo '<pre>';
		$code = str_replace("\n",'',$result) ;
		preg_match_all("/(?<=<span id=\"pjxfjd\"><b>)平均学分绩点：(.*?)(?=<\/b><\/span>)/is",$code,$pjxfjd);//平均学分绩点
//		echo $pjxfjd[1][0].'<br/>';//输出平均学分绩点
		$datelist = strstr($code, '<table id="TabTj" width="100%">',true);
//		preg_match("/<tr.*?<\/tr>/iUs",$code,$newcode);
//		print_r($datelist);
/*
		[0] => 学年
    [1] => 学期
    [2] => 课程代码 1 =>学号
    [3] => 课程名称
    [4] => 课程性质
    [5] => 课程归属 1 =>课程代码
    [6] => 学分
    [7] => 绩点
    [8] => 成绩
    [9] => 辅修标记
    [10] => 补考成绩
    [11] => 重修成绩
    [12] => 学院名称
    [13] => 重修标记

		[0] => 2013-2014
    [1] => 1
    [2] => 02113020
    [3] => C语言程序设计
    [4] => 必修课
    [5] =>
    [6] => 4.0
    [7] => 4.1
    [8] => 91
    [9] => 0
    [10] =>
    [11] =>
    [12] => 信息与电子工程学院
    [13] => 0

 */
		$tmp="/<tr.*>(.*)<\/tr>/iUs";
		preg_match_all($tmp,$datelist,$macthes);

		$tmp="/<td.*>(.*)<\/td>/iUs";
		$structrue = array('schoolyear','term','classcode','coursename','nature','student_id','credit','points','score','minormark','makeup','rebuild','collegename','rebuildmark');//score数据结构
		foreach($macthes[1] as $tr)
		{
			preg_match_all($tmp,$tr,$td);
			$td[1][5] = $xh;//课程归属改为学号

			switch($td[1][8]){
				case '优秀':$td[1][8]=95;break;//五级制转化为百分制
				case '良好':$td[1][8]=85;break;
				case '中等':$td[1][8]=75;break;
				case '及格':$td[1][8]=65;break;
				case '不及格':$td[1][8]=0;break;
				case '合格':$td[1][8]=85;break;//二级制转化为百分制
				default:break;
			}
			for($i=0;$i<count($structrue);$i++){
				$td[1][$structrue[$i]]=$td[1][$i];
			}
			$td[1]=array_slice($td[1], 14);
			$score[]=$td[1];
		}
		unset($score[0]);
		return $score;
	}

public function preg(){
	$before='<tr>
		<td height="13"><span id="zyzrs"><b>本专业共134人</b></span></td>
		<td height="13"><span id="pjxfjd"><b>平均学分绩点：3.73</b></span></td>
		<td height="13"><span id="xfjdzh"><b>学分绩点总和：452.80</b></span></td>
		<td height="13"><span id="zmc" designtimedragdrop="188"><b></b></span><font face="宋体">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="xfcj"><b></b></span></td>
	</tr>';
	$code = str_replace("\n",'',$before) ;
	preg_match_all("/(?<=<span id=\"pjxfjd\"><b>)平均学分绩点：(.*?)(?=<\/b><\/span>)/is",$code,$pjxfjd);//平均学分绩点
	print_r($pjxfjd) ;
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
