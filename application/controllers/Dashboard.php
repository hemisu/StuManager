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
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/dashboard',$this->page_data);
	}
}
