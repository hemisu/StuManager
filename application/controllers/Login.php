<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Base_Controller {
	function __construct()
	{
		parent::__construct();

	}
	public function index(){
		$this->load->view('public/login');
	}
	public function login(){
		if(!$this->input->is_ajax_request()) exit('请使用正确方式登陆');
		if(isset($_POST['student_id'])) {
			$student_id = $this->security->xss_clean($this->input->post('student_id'));//xss过滤
			$post_password = $this->security->xss_clean($this->input->post('password'));//xss过滤
			$r = $this->User_model->get_one(array('student_id'=>$student_id));
			if(!$r) exit(json_encode(array('status'=>false,'tips'=>'用户不存在')));

			$this->load->model('Login_times_model');
			//密码错误剩余重试次数
			$rtime = $this->Login_times_model->get_one(array('student_id'=>$student_id));//查到Login_times 有错误记录
			$maxloginfailedtimes = 5;
			if($rtime)
			{
				if($rtime['failure_times'] >= $maxloginfailedtimes) {
					$minute = 60-floor((SYS_TIME-$rtime['login_time'])/60);
					exit(json_encode(array('status'=>false,'tips'=>' 密码尝试次数过多，被锁定'.$minute.'分钟')));
				}
			}
			$ip = $this->input->ip_address();

			$password = md5($post_password.$r['salt']);//加salt后的密码
//			echo $salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));
			if($password != $r['password']){
				if($rtime && $rtime['failure_times'] < $maxloginfailedtimes) {//有错误记录 且 错误次数小于最大错误次数
					$times = $maxloginfailedtimes-intval($rtime['failure_times']);
					$this->Login_times_model->update(array('login_ip'=>$ip,'failure_times'=>'+=1'),array('student_id'=>$student_id));
				} else {
					$this->Login_times_model->delete(array('student_id'=>$student_id));//无错误记录
					$this->Login_times_model->insert(array('student_id'=>$student_id,'login_ip'=>$ip,'login_time'=>SYS_TIME,'failure_times'=>1));
					$times = $maxloginfailedtimes;
				}
				exit(json_encode(array('status'=>false,'tips'=>' 密码错误您还有'.$times.'机会')));
			}

			$this->Login_times_model->delete(array('student_id'=>$student_id));
//			if($r['is_lock'])exit(json_encode(array('status'=>false,'tips'=>' 您的帐号已被锁定，暂时无法登录')));//锁定账号
			$this->User_model->update(array('lastLoginIp'=>$ip,'lastLoginTime'=>date('Y-m-d H:i:s')),array('student_id'=>$r['student_id']));

//无权限时跳转时的访问路径
			if(!empty($_SESSION['url_forward'])){$next_url=$_SESSION['url_forward'];}else{$next_url=base_url('dashboard');}

			$sessionUserInfo=array(
				'student_id' => $r['student_id'],
				'username' => $r['username'],
				'xy' => $r['college'],
				'majorclassnum' => $r['classes'],
				'next_url' => $next_url
			);
			echo json_encode($sessionUserInfo);
			$this->session->set_userdata($sessionUserInfo);
		}
	}
	//		echo "<pre>";
//		foreach($userinfo as $k=>$v){
//			foreach($v as $key=>$val){
////				echo $key.':'.$val.'<br />';
//				$newarr["$key"]=$val;
//				if($key=='salt'){
//					$newarr["salt"]=hash('md5',microtime());
//				}
//				if($key=='password'){
//					$newarr["password"]=hash('md5',$val.$newarr["salt"]);
//				}
//
//			}
//			$this->db->update('stu_user', $newarr, array('student_id' => $newarr['student_id']));
//		}
	public function loginout()
	{
		$this->session->sess_destroy();
		$this->showmessage('请您重新登录',base_url('login'));
//		redirect(base_url('login'));
	}
	public function binding(){
		$data['controller_name']= trim($this->router->class);
		$data['method_name']= trim($this->router->method);
		$this->load->view('public/binding',$data);
	}

}

