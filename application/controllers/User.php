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
	public function multilist(){

	}
	public function profile(){
		if($this->input->is_ajax_request()){
			$data=$this->input->post();
//			print_r($data);
			if(isset($data['newpassword'])){//修改密码
				if($this->User_model->check_password($this->student_id,$data['password'])){
					$updateinfo['password']= $this->User_model->salt_password($this->student_id,$data['newpassword']);
					$this->User_model->update($updateinfo,"`student_id`=$this->student_id");
					exit(json_encode(array('next_url'=> base_url('login/loginout'))));
				}else{
					exit(json_encode(array('response'=>false,'next_url'=> base_url('user/profile'))));
				}
			}else{
				if($this->User_model->update($data,"`student_id`=$this->student_id")){
					exit(json_encode(array('next_url'=>base_url('user/profile'))));
				}else{
					exit(json_encode(array('response'=>false,'next_url'=> base_url('user/profile')))) ;
				}

			}
		}
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/profile',$this->page_data);
	}
	public function score(){
		$this->page_data['scoreinfo']=$this->User_score_model->select(array('student_id'=>$this->student_id));
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/user_score',$this->page_data);
//		$this->check_member();
	}
	public function ranktest(){
		$this->page_data['scoreinfo']=$this->User_ranktest_model->select(array('student_id'=>$this->student_id));
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/user_ranktest',$this->page_data);
	}
	public function check_password(){
		if(!$this->input->is_ajax_request()) exit('what are you 弄撒嘞?');
		$password = $this->input->post('password');
		echo json_encode(array('valid' => $this->User_model->check_password($this->student_id,$password)));

	}
}
