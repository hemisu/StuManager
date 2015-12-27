<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends Login_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/message',$this->page_data);
	}
	public function send(){
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/message_send',$this->page_data);
	}
	public function read(){
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/message_read',$this->page_data);
	}
}
