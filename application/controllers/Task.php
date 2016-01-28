<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends Login_Controller {

	function __construct()
	{
		parent::__construct();
		//======载入模块======
		$this->load->model(array('Task_title_model'));
	}
	public function index(){
		$this->page_data['tasklist']=$this->Task_title_model->task_list_html();//获取任务列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/task_list',$this->page_data);
	}
	public function detail(){
		$array = $this->uri->uri_to_assoc(3);
		$task_id=$array['task_id'];
		$this->page_data['taskinfo']=$this->Task_title_model->get_one("`task_id`=$task_id");//获取任务列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/task_detail',$this->page_data);
	}
}
