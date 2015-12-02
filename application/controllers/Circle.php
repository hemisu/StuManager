<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Circle extends Login_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/circle',$this->page_data);
	}
}
