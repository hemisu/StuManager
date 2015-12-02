<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends Login_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('User_model'));
		$this->load->helper('url');
	}
	public function index(){
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/file_manager',$this->page_data);
	}
}
