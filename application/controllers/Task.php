<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends Login_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/task_list',$this->page_data);
	}
}
