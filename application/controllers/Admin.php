<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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

	/**
	 * 内容管理-公告-列表
	 * announce
	 *
	 */
	public function announce($page_now = 1)
	{
		$page_now = max(intval($page_now),1);
		$page_data['controller_name']= trim($this->router->class);
		$page_data['method_name']= trim($this->router->method);
		$sqlwhere = array('student_id' => intval($_SESSION['student_id']));//查询
		$page_data['userinfo'] = $this->Times_model->select($sqlwhere,'`student_id`,`username`,`student_id`,`email`,`qq`,`college`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`,`status`,`remarks`')[0];
		$page_data['announcelist']=$this->Announce_model->announce_list_html($page_now);
		$page_data['announcelistpage']=$this->Announce_model->pages;
		$this->load->view('head',$page_data);
		$this->load->view('siderbar',$page_data);
		$this->load->view('admin/admin_announce',$page_data);
	}
	/**
	 * 内容管理-公告-添加
	 * announce_add
	 *
	 */
	public function announce_add()
	{
		$page_data['controller_name']= trim($this->router->class);
		$page_data['method_name']= trim($this->router->method);
		$sqlwhere = array('student_id' => intval($_SESSION['student_id']));//查询
		$page_data['userinfo'] = $this->Times_model->select($sqlwhere,'`student_id`,`username`,`student_id`,`email`,`qq`,`college`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`,`status`,`remarks`')[0];

		$this->load->view('head',$page_data);
		$this->load->view('siderbar',$page_data);
		$this->load->view('admin/admin_announce_add');
	}
	public function announce_add_post(){
		if($this->input->is_ajax_request()){
			$data=array();
			$data['title'] = $title = $this->input->post('title');
			$data['level'] = $level = $this->input->post('level');
			$data['date'] = $level = $this->input->post('date');
			$data['content'] = $content = $this->input->post('content');
			$this->Announce_model->insert($data);

				echo json_encode(array('title'=>$title,'level'=>$level,'content'=>$content,'next_url'=>base_url('admin/announce')));

		}else{
			redirect(base_url('admin/announce'));
		}
	}
	/**
	 * 内容管理-公告-修改
	 * announce_edit
	 *
	 */
	public function announce_edit()
	{
		$array = $this->uri->uri_to_assoc(3);
		$announce_id=$array['announce_id'];
		$page_data['controller_name']= trim($this->router->class);
		$page_data['method_name']= trim($this->router->method);
		$sqlwhere = array('student_id' => intval($_SESSION['student_id']));//查询
		$page_data['userinfo'] = $this->Times_model->select($sqlwhere,'`student_id`,`username`,`student_id`,`email`,`qq`,`college`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`,`status`,`remarks`')[0];
		$page_data['announce'] = $this->Announce_model->select("`id`=$announce_id")[0];
		$this->load->view('head',$page_data);
		$this->load->view('siderbar',$page_data);
		$this->load->view('admin/admin_announce_edit');
	}
	public function announce_edit_post()
	{
		if($this->input->is_ajax_request()){
			$array = $this->uri->uri_to_assoc(3);
			$announce_id=$array['announce_id'];
			$data=array();
			$data['title'] = $title = $this->input->post('title');
			$data['level'] = $level = $this->input->post('level');
			$data['date'] = $level = $this->input->post('date');
			$data['content'] = $content = $this->input->post('content');
			$this->Announce_model->update($data,"`id`=$announce_id");

			echo json_encode(array('title'=>$title,'level'=>$level,'content'=>$content,'next_url'=>base_url('admin/announce')));

		}else{
			redirect(base_url('admin/announce'));
		}
	}
	/**
	 * 内容管理-公告-删除
	 * announce_delete
	 *
	 */
	public function announce_delete()
	{
		if($this->input->is_ajax_request()){
			$id = $this->input->post('announce_id');
			$this->Announce_model->delete("`id`=$id");

			echo json_encode(array('announce_id'=>$id,'next_url'=>base_url('admin/announce')));

		}else{
			redirect(base_url('admin/announce'));
		}
	}
}
