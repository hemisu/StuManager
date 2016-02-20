<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Circle extends Login_Controller {

	function __construct()
	{
		parent::__construct();
		//======载入模块======
		$this->load->model(array('Circle_model'));
	}
	public function index(){
		if($this->input->is_ajax_request()){
			$parent_id=$this->input->post('parent_id');
			$postdata['student_id'] = $this->student_id;
			$postdata['date'] = date('Y-m-d H:i:s');
			$postdata['user_agent'] = $this->input->user_agent();//来源
			$postdata['content'] = $this->input->post('content');
			$postdata['child_id'] = '0';//子id
			$postdata['praise'] = '0';//赞同数
			$postdata['anonymous'] = $this->input->post('anonymous');//匿名
			if (isset($parent_id)) {
				$postdata['parent_id'] = $parent_id;//父id
				if ($newid=$this->Circle_model->insert($postdata)) {
					$r = $this->Circle_model->get_one(array('id'=>$parent_id));
					if(empty($r['child_id'])){
						$this->Circle_model->update(array('child_id'=>$newid),array('id'=>$parent_id));
					}else{
						$r['child_id'].=','.$newid;
						$this->Circle_model->update(array('child_id'=>$r['child_id']),array('id'=>$parent_id));
					}

					exit(json_encode(array('tips' => '发布成功', 'next_url' => current_url())));
				} else {
					exit(json_encode(array('tips' => '发布失败', 'next_url' => current_url(), 'status' => false)));
				}
			} else {
				$postdata['parent_id'] = '0';//父id
				if ($this->Circle_model->insert($postdata)) {
					exit(json_encode(array('tips' => '发布成功', 'next_url' => current_url())));
				} else {
					exit(json_encode(array('tips' => '发布失败', 'next_url' => current_url(), 'status' => false)));
				}
			}
		}
		$this->page_data['circle_list'] = $this->Circle_model->html_circle_class();
		$this->load->view('head', $this->page_data);
		$this->load->view('siderbar', $this->page_data);
		$this->load->view('public/circle', $this->page_data);
	}
}
