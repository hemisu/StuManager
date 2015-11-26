<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Circle extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Times_model'));
		$this->load->helper('url');
	}
	public function index(){
		$data['controller_name']= trim($this->router->class);
		$data['method_name']= trim($this->router->method);
		$this->load->view('head');
		$this->load->view('siderbar',$data);
		$this->load->view('public/circle',$data);
	}
}
