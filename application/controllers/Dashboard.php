<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Login_Controller {
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->page_data['announcelist']=$this->Announce_model->announce_dashboard_html();//获取公告
		$this->page_data['tasklist']=$this->Task_title_model->dashboard_html($this->group_id);//获取任务列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/dashboard',$this->page_data);
	}
	public function announce()
	{
		$array = $this->uri->uri_to_assoc(3);
		$announce_id=$array['announce_id'];
		$this->page_data['announce']=$this->Announce_model->announce_one($announce_id);//获取公告
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/dashboard_announce',$this->page_data);
	}
}
