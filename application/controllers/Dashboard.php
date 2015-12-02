<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->model(array('Times_model','Announce_model'));
		$this->load->helper('url');
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function binding()
	{
//		print_r($this->page_data);
		$data['controller_name']= trim($this->router->class);
		$data['method_name']= trim($this->router->method);
		$this->load->view('public/binding',$data);
	}
	public function dashboard()
	{
		$page_data['controller_name']= trim($this->router->class);
		$page_data['method_name']= trim($this->router->method);
		$sqlwhere = array('student_id' => intval($_SESSION['student_id']));//查询
		$page_data['userinfo'] = $this->Times_model->select($sqlwhere,'`student_id`,`username`,`student_id`,`email`,`qq`,`college`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`,`status`,`remarks`')[0];
//		print_r($page_data['userinfo']);
		$page_data['announcelist']=$this->Announce_model->announce_dashboard_html();
		$this->load->view('head',$page_data);
		$this->load->view('siderbar',$page_data);
		$this->load->view('public/dashboard',$page_data);
	}
	public function t(){
		$username="1130320108";
		$rtime = $this->Times_model->get_one(array('student_id'=>$username));
		print_r($rtime);
	}
	public function pass(){
		$salt = '06893a84b88498922f4e5c00117f7855';
		echo 'salt:'.$salt."<br>";
		$password = '888888';
		echo hash('md5',$password.$salt);
		$userinfo = $this->Times_model->select('','`student_id`,`salt`,`password`');
		$newarr = array();
//		echo "<pre>";
//		foreach($userinfo as $k=>$v){
//			foreach($v as $key=>$val){
////				echo $key.':'.$val.'<br />';
//				$newarr["$key"]=$val;
//				if($key=='salt'){
//					$newarr["salt"]=hash('md5',microtime());
//				}
//				if($key=='password'){
//					$newarr["password"]=hash('md5',$val.$newarr["salt"]);
//				}
//
//			}
//			$this->db->update('stu_user', $newarr, array('student_id' => $newarr['student_id']));
//		}

	}
	public function user(){
		$data['controller_name']= trim($this->router->class);
		$data['method_name']= trim($this->router->method);
		$username="1130320108";
		$userinfo = $this->Times_model->select('');
		$this->load->view('head');
		$this->load->view('siderbar');
		$this->load->view('public/table',$data);
	}
	public function userjson(){
		$userinfo = $this->Times_model->select('','`username`,`student_id`,`email`,`qq`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`');
		echo json_encode($userinfo);

	}
	public function editor(){
		$textarea = html_escape($this->input->post('textarea'));
		print_r($textarea);
		echo "<hr>";
		echo htmlspecialchars_decode($textarea);

	}

}
