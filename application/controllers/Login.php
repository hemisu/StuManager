<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Base_Controller {
	function __construct()
	{
		parent::__construct();
	}
	/**
	 * 登录页
	 */
	public function index(){
		$this->page_data['student_id']=$this->input->cookie('stu_student_id');
		$this->load->view('public/login',$this->page_data);
	}
	/*
	 * 密码重设页面
	 */
	public function forget_setpassword($student_id,$forgetvalidate){
		$r=$this->Forget_password_model->get_one(array('student_id'=>$student_id,'forgetvalidate'=>$forgetvalidate));
		if(!$r)exit($this->showmessage('无效操作！',base_url('login'),3));
		if($this->input->is_ajax_request()){
			$newpassword=$this->input->post('password');
			$user = $this->User_model->get_one(array('student_id'=>$student_id));
			$password = md5($newpassword.$user['salt']);//加salt后的密码
			if($this->User_model->update(array('password'=>$password),array('student_id'=>$student_id))){
				$this->Forget_password_model->delete(array('student_id'=>$student_id,'forgetvalidate'=>$forgetvalidate));
				exit (json_encode(array('status'=>true,'tips'=>'密码修改成功','next_url'=>base_url('login'))));
			}else{
				exit (json_encode(array('status'=>false,'tips'=>'密码修改失败','next_url'=>current_url())));
			}
		}
		$this->page_data['student_id'] = $student_id;
		$this->load->view('public/forget_setpassword',$this->page_data);
	}
	/*
	 * 忘记密码页面
	 */
	public function forget(){
		$this->page_data['student_id']=$this->input->cookie('stu_student_id');
		if($this->input->is_ajax_request()){
			$student_id=$this->input->post('student_id');
			$email=$this->input->post('email');
			$r = $this->User_model->get_one(array('student_id'=>$student_id,'email'=>$email));
			if(!$r)exit( json_encode(array('status'=>false,'tips'=>'用户不存在或者邮箱错误','next_url'=>base_url('login/forget'))) );
			$this->sent_forget_email($student_id);
		}

		$this->load->view('public/forget',$this->page_data);
	}
	/*
	 * 邮件发送
	 */
	private function sent_forget_email($student_id){
		$r=$this->Forget_password_model->get_one(array('student_id'=>$student_id));
		if($r){//存在
			if( (time()-strtotime($r['date']))<0 ){
				exit( json_encode(array('status'=>false,'tips'=>'已发送邮件，请勿重复操作','next_url'=>base_url('login/forget'))) );//防止重复提交,保存时间超过现在时间
			}else{
				$this->Forget_password_model->delete(array('student_id'=>$student_id));
			}
		}

		$forgetvalidate= md5(time().$student_id);;
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.126.com';
		$config['smtp_user'] = 'hekunyu@126.com';
		$config['smtp_pass'] = '0gaza14713a';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this -> load -> library('email');
		$this->email->initialize($config);
		$this->email->from('hekunyu@126.com');
		$this->email->to('hemisu@qq.com');
		$this->email->subject('【StuManager】忘记密码重置!');
		$this->email->message('重置你的密码：<a href="'.base_url('login/forget_setpassword/'.$student_id).'/'.$forgetvalidate.'">点击链接</a><br/>请在30分钟内重置。');

		if( ! $this->email->send()){
			exit( json_encode(array('status'=>false,'tips'=>'邮件发送失败,请联系管理员：hemisu@qq.com','netx_url'=>base_url('login'))) );
		}else{
			$this->Forget_password_model->insert(array('student_id'=>$student_id,'forgetvalidate'=>$forgetvalidate,'date'=>date("Y-m-d G:i:s",time()+1800)));
			exit( json_encode(array('tips'=>'邮件已发送到您的邮箱，请查收','netx_url'=>base_url('login'))) );
		}
	}
	/**
	 * 登陆提交页面
	 */
	public function login(){
		if(!$this->input->is_ajax_request()) exit('请使用正确方式登陆');
		//仅接受ajax方式
		if(isset($_POST['student_id'])) {
			$student_id = $this->security->xss_clean($this->input->post('student_id'));//xss过滤
			$post_password = $this->security->xss_clean($this->input->post('password'));//xss过滤
			$remembermyid = $this->security->xss_clean($this->input->post('remembermyid'));//xss过滤
			//进行查找 是否存在用户
			$r = $this->User_model->get_one(array('student_id'=>$student_id));
			if(!$r) exit(json_encode(array('status'=>false,'tips'=>'用户不存在')));

			$this->load->model('Login_times_model');//载入错误次数模块
			//密码错误剩余重试次数
			$rtime = $this->Login_times_model->get_one(array('student_id'=>$student_id));
			//查到Login_times 有错误记录
			$maxloginfailedtimes = 5;
			//最大错误次数
			if($rtime)
			{
				if($rtime['failure_times'] >= $maxloginfailedtimes) {
					$minute = 60-floor((SYS_TIME-$rtime['login_time'])/60);
					exit(json_encode(array('status'=>false,'tips'=>' 密码尝试次数过多，被锁定'.$minute.'分钟')));
				}
			}
			$ip = $this->input->ip_address();
			//获取IP地址

			$password = md5($post_password.$r['salt']);//加salt后的密码
//			echo $salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));
			//密码错误后记录
			if($password != $r['password']){
				if($rtime && $rtime['failure_times'] < $maxloginfailedtimes) {
				//有错误记录 且 错误次数小于最大错误次数
					$times = $maxloginfailedtimes-intval($rtime['failure_times']);
					$this->Login_times_model->update(array('login_ip'=>$ip,'failure_times'=>'+=1'),array('student_id'=>$student_id));
				} else {
					$this->Login_times_model->delete(array('student_id'=>$student_id));
				//无错误记录 删除错误次数
					$this->Login_times_model->insert(array('student_id'=>$student_id,'login_ip'=>$ip,'login_time'=>SYS_TIME,'failure_times'=>1));
					$times = $maxloginfailedtimes;
				}
				exit(json_encode(array('status'=>false,'tips'=>' 密码错误您还有'.$times.'机会')));
			}

			$this->Login_times_model->delete(array('student_id'=>$student_id));
//			if($r['is_lock'])exit(json_encode(array('status'=>false,'tips'=>' 您的帐号已被锁定，暂时无法登录')));//锁定账号
			$this->User_model->update(array('lastLoginIp'=>$ip,'lastLoginTime'=>$r['lastLoginTime_temp'],'lastLoginTime_temp'=>date('Y-m-d H:i:s')),array('student_id'=>$r['student_id']));

//无权限时跳转时的访问路径
			if(!empty($_SESSION['url_forward'])){$next_url=$_SESSION['url_forward'];}else{$next_url=base_url('dashboard');}

			$sessionUserInfo=array(
				'student_id' => $r['student_id'],
				'username' => $r['username'],
				'xy' => $r['college'],
				'majorclassnum' => $r['classes'],
				'next_url' => $next_url
			);
			$this->session->set_userdata($sessionUserInfo);
			//设置SESSION
			if($remembermyid){
				$idcookie = array(
					'name'   => 'student_id',
					'value'  => $student_id,
					'expire' => '604800',
					'domain' => '',
					'path'   => '/',
					'prefix' => 'stu_'
				);

				$this->input->set_cookie($idcookie);
			}
			echo json_encode($sessionUserInfo);
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

