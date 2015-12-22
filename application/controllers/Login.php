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
			$student_id = $this->security->xss_clean($this->input->post('student_id'));
			$post_password = $this->security->xss_clean($this->input->post('password'));
			$r = $this->User_model->get_one(array('student_id'=>$student_id));
			if(!$r) exit(json_encode(array('status'=>false,'tips'=>'用户名或密码不正确')));
			$password = md5($post_password.$r['salt']);
//			echo $salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));
			if($password != $r['password']) exit(json_encode(array('status'=>false,'tips'=>'用户名或密码不正确')));
//无权限时访问路径
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

