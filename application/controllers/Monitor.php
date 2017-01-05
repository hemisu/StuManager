<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends Login_Controller {
	function __construct()
	{
		parent::__construct();
		//======载入模块======

	}
	public function index()
	{
		$this->page_data['announcelist']=$this->Announce_model->announce_dashboard_html();//获取公告
		$this->page_data['tasklist']=$this->Task_title_model->dashboard_html($this->group_id);//获取任务列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/monitor',$this->page_data);
	}
	/**
	 * 班级用户信息以json格式输出
	 */
	public function user_library_json(){
		if(!$this->input->is_ajax_request())exit('access allowed!');
		$userinfo = $this->User_model->select(array('classes'=>$this->page_data['userinfo']['classes']),'`username`,`student_id`,`email`,`qq`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`,`group_id`,`lastLoginTime`,`atschool`');
		foreach($userinfo as $v){
			$v['group_name']=$this->User_group_model->get_user_gruop_name($v['group_id']);
			$userinfos[]=$v;
		}
		echo json_encode($userinfos);
	}
	/**
	 * 用户管理-添加新同学
	 * user_add
	 *
	 */
	public function user_add(){
		if($this->input->is_ajax_request()){
			$data=$this->input->post();
			$data['password']=md5($data['password'].$data['salt']);
			if(isset($data['group_id']))unset($data['group_id']);
			$this->User_model->insert($data);
			exit(json_encode(array('data'=> $data,'next_url'=> base_url('monitor')))) ;
		}
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/monitor_user_add',$this->page_data);
	}
	/**
	 * 用户管理-编辑用户
	 * user_edit
	 *
	 */
	public function user_edit($student_id = ''){
		if(!isset($student_id))return redirect(base_url('monitor'));
		if($this->input->is_ajax_request()){
			$data=$this->input->post();
			if(isset($data['group_id']))unset($data['group_id']);
			if(isset($data['password']))unset($data['password']);
//			if($data['password']==$this->User_model->get_one("`student_id`='$student_id'")['password']){//如果密码未改变
//				unset($data['password']);//弹出密码
//			}else{
//				$data['password']=md5($data['password'].$data['salt']);
//			}
			$this->User_model->update($data,"`student_id`='$student_id'");
			exit(json_encode(array('data'=> $data,'next_url'=> base_url('monitor')))) ;
		}
		$this->page_data['edituserinfo'] = $this->User_model->get_one("`student_id`='$student_id'");//获取被编辑的用户信息
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/monitor_user_edit',$this->page_data);
	}
	/**
	 * 用户管理-删除用户
	 * user_delete
	 *
	 */
	public function user_delete($student_id = ''){
		if($this->User_model->delete("`student_id`='$student_id'")){
			echo json_encode(array('student_id'=> $student_id));
		}else{
			echo json_encode(array('response'=> false));
		}
	}
}
