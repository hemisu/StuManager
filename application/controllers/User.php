<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model(array('Times_model'));
		$this->load->helper('url');
	}
	public function multilist(){
		$data['controller_name']= trim($this->router->class);
		$data['method_name']= trim($this->router->method);
		$this->load->view('head');
		$this->load->view('siderbar',$data);
		$this->load->view('public/table',$data);
	}
	public function profile(){
		$data['controller_name']= trim($this->router->class);
		$data['method_name']= trim($this->router->method);
		$this->load->view('head');
		$this->load->view('siderbar',$data);
		$this->load->view('public/profile',$data);
	}
	public function userjson(){
		$userinfo = $this->Times_model->select('','`username`,`student_id`,`email`,`qq`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`');
		echo json_encode($userinfo);

	}
}
