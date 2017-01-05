<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wangbin extends Base_Controller {
	function __construct()
	{
		parent::__construct();
		//加载model
		$this->load->model('Wangbin_model');
		$this->load->helper(array('form', 'url'));
		//加载
		$this->load->library('Excel/Spreadsheet_Excel_Reader');
	}
	public function index(){
		$thispagedata['tablelist'] = $this->Wangbin_model->overview_html();
		$this->load->view('wangbin/index',$thispagedata);
	}
	public function byteacher(){
		$teacher = "";
		$where_arr = array();
		if (isset($_GET['teacher'])) {
			$teacher =isset($_GET['teacher'])?safe_replace(trim($_GET['teacher'])):'';
			if($teacher!="") $where_arr[] = "`instructor` = '$teacher'";

		}
		$thispagedata['tname'] = $teacher;
		$where = implode(" and ",$where_arr);

		$thispagedata['tablelist'] = $this->Wangbin_model->byteacher($where);
		$thispagedata['tablelists'] = $this->Wangbin_model->overview_html($where);
		if($teacher){
			$this->load->view('wangbin/byteacher_detail',$thispagedata);
		}else{
			$this->load->view('wangbin/byteacher',$thispagedata);
		}
	}
	public function byclasses(){
		$classes = "";
		$where_arr = array();
		if (isset($_GET['classes'])) {
			$classes =isset($_GET['classes'])?safe_replace(trim($_GET['classes'])):'';
			if($classes!="") $where_arr[] = "`classes` = '$classes'";

		}

		$where = implode(" and ",$where_arr);

		$thispagedata['tablelist'] = $this->Wangbin_model->byclasses($where);
		$this->load->view('wangbin/byclasses',$thispagedata);
	}
	public function post(){
		$data['student_id'] = $this->input->post('student_id');
		$data['company'] = $this->input->post('company');
		$data['remarks'] = $this->input->post('remarks');
		if($data['company']){
			$data['signdate'] = date('Y-m-d H:i:s',time());
		}
		if($this->Wangbin_model->update( array('company'=>$data['company'],'remarks'=>$data['remarks'],'signdate'=>$data['signdate']),array('student_id'=>$data['student_id']) )){
			exit(json_encode(array('response'=>true)));
		}else{
			exit(json_encode(array('response'=>false)));
		}
	}
	public function postexcel(){
		$this->load->view('wangbin/insertexcel');
	}
	public function exportexcel(){
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=电气学院就业情况-".date('Y_m_d H_i_s',time()).".xls");
//输出内容如下：
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
				<html xmlns='http://www.w3.org/1999/xhtml'>
				<head>
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
				<title>学生就业情况</title>
				</head>

				<body>
				<table border='1'>
				  <tr>
				    <td>学号</td>
				    <td>姓名</td>
				    <td>班级</td>
				    <td>长号</td>
				    <td>短号</td>
				    <td>指导教师</td>
				    <td>就业日期</td>
				    <td>单位</td>
				    <td>备注</td>
				  </tr>".$this->Wangbin_model->overview_html()."
				</table>
				</body>
				</html>
				";
	}
	public function excel()
	{
		$reader = new Spreadsheet_Excel_Reader(); // 实例化解析类Spreadsheet_Excel_Reader
		$reader->setOutputEncoding("utf-8");     // 设置编码方式
		$reader->read("{$_FILES['userfile']['tmp_name']}");
		$ver_data = $reader->sheets[0]['cells'];
		/*
		 * [1] => 学号
            [2] => 姓名
            [3] => 班级
            [4] => 长号
            [5] => 短号
            [6] => 指导教师
            [7] => 就业日期
            [8] => 单位
            [9] => 备注
		 */
		if($ver_data[1][1] == '学号' && $ver_data[1][2] == '姓名' && $ver_data[1][3] == '班级' &&
			$ver_data[1][4] == '长号' && $ver_data[1][5] == '短号' && $ver_data[1][6] == '指导教师' &&
			$ver_data[1][7] == '就业日期' && $ver_data[1][8] == '单位' && $ver_data[1][9] == '备注'){
//			echo "<pre>";
			$log = "";
//			print_r($ver_data);
			foreach(array_slice($ver_data,1) as $v){
				if(!empty($v[1]) && !empty($v[2]) && !empty($v[3]) && !empty($v[4]) && !empty($v[6])){
					$r = $this->Wangbin_model->count(array('student_id'=>$v[1]));
					if($r){//存在
						$updatearr = array(
							'username' => $v[2],
							'classes' => $v[3],
							'l_phone' => $v[4],
							's_phone' => $v[5],
							'instructor' => $v[6],
							'signdate' => isset($v[7])?$v[7]:'',
							'company' => isset($v[8])?$v[8]:'',
							'remarks' => isset($v[9])?$v[9]:'',
						);
						if($this->Wangbin_model->update($updatearr,array('student_id'=>$v[1]))){
							$log .= "更新$v[2]的信息成功<br />";
						}else{
							$log .= "<span style='color:red;'>更新$v[2]的信息失败</span><br />";
						}
					}else{
						$insertarr = array(
							'student_id' => $v[1],
							'username' => $v[2],
							'classes' => $v[3],
							'l_phone' => $v[4],
							's_phone' => $v[5],
							'instructor' => $v[6],
							'signdate' => isset($v[7])?$v[7]:'',
							'company' => isset($v[8])?$v[8]:'',
							'remarks' => isset($v[9])?$v[9]:'',
						);
						if($this->Wangbin_model->insert($insertarr)){
							$log .= "插入$v[2]的信息成功<br />";
						}else{
							$log .= "<span style='color:red;'>插入$v[2]的信息失败</span><br />";
						}
					}
				}
			}
			exit($this->showmessage($log,base_url('wangbin'),5));
		}else{
			exit($this->showmessage('上传数据格式错误'));
		}

	}
	private function curl_request($url,$post='',$cookie='', $returnCookie=0){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_TIMEOUT,10); // 10 seconds
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
		curl_setopt($curl, CURLOPT_REFERER, "$url"); //构造来路
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
		curl_setopt($curl, CURLOPT_REFERER, "$url");
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_SSLVERSION, 3);


		if($post) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
		}
		if($cookie) {
			curl_setopt($curl, CURLOPT_COOKIE, $cookie);
		}

		curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
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
	public function zhuanye($tnum){
		echo "<form action='".current_url()."'></form>";
		$res = array();
		$url = 'http://www.cdgdc.edu.cn/webrms/pages/Ranking/xkpmGXZJ.jsp?yjxkdm='.$tnum;
		$result = $this->curl_request($url,'');//保存的cookies
		$result= iconv('GB2312', 'UTF-8', $result);


		preg_match_all('/<p class=Zmen >[\w\W]*?>([\w\W]*?)<\/a><\/p>/',$result,$leibie);
		$leibie = $leibie[1][0];

		preg_match_all('/<table border="0"[\w\W]*?>([\w\W]*?)<\/table>/',$result,$out);
		preg_match_all('/<P align="center"[\w\W]*?>([\w\W]*?)<\/P>/',$out[0][0],$xueke);
		preg_match_all('/<Strong[\w\W]*?>([\w\W]*?)<\/Strong>/',$xueke[1][0],$xueke);
		$xueke = $xueke[1][0];//学科名


		preg_match_all('/<table  border="0"[\w\W]*?>([\w\W]*?)<\/table>/',$out[0][0],$out2);//获取主要表格

		$tmp="/<tr.*>(.*)<\/tr>/iUs";
		preg_match_all($tmp,$out2[0][0],$macthes);

		$tmp="/<td.*>(.*)<\/td>/iUs";

		$temp = 0;//成绩初始化
		foreach($macthes[1] as $tr)
		{
			preg_match_all($tmp,$tr,$td);
//			substr($str,5);
//			$score[]=$td[1];
			preg_match_all('/<div[\w\W]*?>([\w\W]*?)<\/div>/',$td[0][0],$bianhao_xuexiao);
			$td[0][0]=explode("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$bianhao_xuexiao[1][0]);
//echo strstr($td[0][1], 'rowspan=');

			if(isset($td[0][1]) ){
				preg_match_all('/<td[\w\W]*?>([\w\W]*?)<\/td>/',$td[0][1],$fenshu);
				$temp = $td[0][0][] = explode("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$fenshu[1][0])[0];
			}else{
				$td[0][0][] = $temp;
			}

//			$score[]=$td[1];
//			print_r($td[0]);
			$score[] = $td[0][0];
		}


		echo "<table border='1'>";
		echo "<tr><td>大类</td><td>专业</td><td>学校代码</td><td>学校</td><td>分数</td></tr>";
		foreach($score as $v){
			echo "<tr><td>".$leibie."</td><td>".$xueke."</td><td>".$v[0]."</td><td>".$v[1]."</td><td>".$v[2]."</td></tr>";
		}
		echo "</table>";
	}
	public function urllist(){
		$res = array();
		$url = 'http://www.cdgdc.edu.cn/webrms/pages/Ranking/xkpmGXZJ.jsp?xkdm=01,02,03,04,05,06';
		$result = $this->curl_request($url,'');//保存的cookies

		preg_match_all('/<p class=Zmen([\w\W]*?)class="hei14b">/',$result,$list);

		foreach($list[1] as $v){
			$baseurl[] = explode('"',$v)[1];
//			$arr[] =$temp[1];
		}

		foreach($baseurl as $base){
			$allurl[] = $base;
//			$allurl[] = $this->urllistnum($base);
		}
		echo "<pre>";
		print_r($allurl);

//		return $arr;
	}
	public function urllistnum($base){
		$res = array();
		$url = 'http://www.cdgdc.edu.cn/webrms/pages/Ranking/'.$base;
		$result = $this->curl_request($url,'');//保存的cookies
		preg_match_all('/class="hei12">([\w\W]*?)<\/a>/',$result,$list);
		foreach($list[1] as $v){
			$arr[] =explode(' ',$v)[0];
		}
//		echo json_encode($arr);
		foreach($arr as $b){
			echo $b.'<br>';
		}
//		return $arr;
	}

}

