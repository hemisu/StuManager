<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Login_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
	}
	/**
	 * 用户-默认页
	 */
	public function index(){
		redirect(base_url('user/profile'));
	}
	public function multilist(){

	}
	public function profile(){
		if($this->input->is_ajax_request()){
			$data=$this->input->post();
//			print_r($data);
			if(isset($data['newpassword']) || isset($data['password']) || isset($data['confirmPassword'])){//修改密码
				if($this->User_model->check_password($this->student_id,$data['password'])){//验证密码通过
					$updateinfo['password']= $this->User_model->salt_password($this->student_id,$data['newpassword']);
					$this->User_model->update($updateinfo,"`student_id`=$this->student_id");
					exit(json_encode(array('next_url'=> base_url('login/loginout'))));
				}else{
					exit(json_encode(array('response'=>false,'next_url'=> base_url('user/profile'))));
				}
			}else{
				$getinfo=array('sex','email','qq','long_phone','short_phone','mz','jg','fa_name','fa_phone','mo_name','mo_phone','ybh','homephone','address','qinshi','remarks');
				$getinfo=$this->input->post($getinfo,true);
				if($this->User_model->update($getinfo,"`student_id`=$this->student_id")){
					exit(json_encode(array('next_url'=>base_url('user/profile'))));
				}else{
					exit(json_encode(array('response'=>false,'next_url'=> base_url('user/profile')))) ;
				}

			}
		}
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/user_profile',$this->page_data);
	}
	/*
	 * 学分绩点（来自教务系统）
	 */
	public function score(){
		$this->page_data['scoreinfo']=$this->User_score_model->select(array('student_id'=>$this->student_id));
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/user_score',$this->page_data);
//		$this->check_member();
	}
	/*
	 * 等级考试成绩（来自教务系统）
	 */
	public function ranktest(){
		$this->page_data['scoreinfo']=$this->User_ranktest_model->select(array('student_id'=>$this->student_id));
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/user_ranktest',$this->page_data);
	}
	/*
	 * 校验密码是否正确
	 * 用于修改个人资料
	 */
	public function check_password(){
		if(!$this->input->is_ajax_request()) exit('what are you 弄撒嘞?');
		$password = $this->input->get_post('password');
		echo json_encode(array('valid' => $this->User_model->check_password($this->student_id,$password)));
	}
	/*
	 * 校验是否存在学号
	 */
	public function check_student_id(){
		if(!$this->input->is_ajax_request()) exit('what are you 弄撒嘞?');
		$student_id = $this->input->get_post('student_id');
		echo json_encode(array('valid' => !$this->User_model->check_student_id($student_id)));
	}
}
