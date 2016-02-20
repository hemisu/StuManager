<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends Login_Controller {

	function __construct()
	{
		parent::__construct();
		//======载入模块======
		$this->load->model(array(
			'Task_title_model',//任务列表模块
			'User_action_log',
			'Task_statistic_returnleave',//用户行为日志模块,返校_离校统计模块

		));
		$this->load->library('email');
	}
	/**
	 * 事项-列表
	 */
	public function index(){
		$this->page_data['tasklist']=$this->Task_title_model->task_list_html($this->group_id);//获取任务列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/task_list',$this->page_data);
	}

	/**
	 * 事项-详细内容
	 */
	public function detail(){
		$array = $this->uri->uri_to_assoc(3);
		if(!isset($array['task_id']))return redirect(base_url('task'));
		$task_id=$array['task_id'];
		$this->page_data['taskinfo']=$this->Task_title_model->get_one("`task_id`=$task_id");//获取任务列表
		$this->page_data['actionlist']=$this->User_action_log->html_return_statistic($task_id);//获取用户行为列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/task_detail',$this->page_data);
	}

	/**
	 * 返校统计
	 */
	public function return_statistic(){
		$array = $this->uri->uri_to_assoc(3);
		if(!isset($array['task_id']))return redirect(base_url('task'));
		$task_id=$array['task_id'];

		if($this->input->is_ajax_request()){
			$data=$this->input->post('info');//获取array(student_id,reason,remark)
			if(empty($data[0]['student_id'])){exit(json_encode(array('response'=> false,'tips'=>'啥都没填,请刷新页面重新填写')));}
			foreach($data as $v){
				$v['task_id'] = $task_id;
				$v['cate'] = 'return_statistic';
				if($r=$this->Task_statistic_returnleave->get_one(array('task_id'=>"$task_id", 'cate'=>'return_statistic', 'student_id'=>"$v[student_id]"))) {
					//如果已经存在
					$this->Task_statistic_returnleave->update($v,"`id`=$r[id]");
					$this->User_model->update(array('atschool'=>0),array('student_id'=>$v['student_id']));
				}else{
					//不存在
					if($this->Task_statistic_returnleave->insert($v)){
						//插入成功
						$this->User_model->update(array('atschool'=>0),array('student_id'=>$v['student_id']));
					}else{
						exit(json_encode(array('response'=> false,'tips'=>'未知插入表错误')));
					}
				}
			}
//			$this->Task_statistic_returnleave->insert($data);

			$this->User_action_log->action_log($task_id,'提交了返校统计');//用户行为记录
			exit(json_encode(array('data'=> $data,'next_url'=>current_url())));
		}
		$classes = $this->page_data['userinfo']['classes'];//获取登陆用户的班级数据
//		$this->page_data['statisticinfo']=$this->Task_statistic_returnleave->class_userinfo($task_id,$classes);//已输入信息
		$this->page_data['statistictable']=$this->Task_statistic_returnleave->return_html_task_return_statistic($task_id,$classes,$this->group_id);//已输入信息
		$this->page_data['taskinfo']=$this->Task_title_model->get_one("`task_id`=$task_id");//获取任务列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/task_return_statistic',$this->page_data);
	}
	/**
	 * 离校统计
	 */
	public function leave_statistic(){
		$array = $this->uri->uri_to_assoc(3);
		$task_id=$array['task_id'];
		if($this->input->is_ajax_request()){
			$data=$this->input->post('info');//获取array(student_id,reason,remark)
			if(empty($data[0]['student_id'])){exit(json_encode(array('response'=> false,'tips'=>'啥都没填,请刷新页面重新填写')));}
			foreach($data as $v){
				$v['task_id'] = $task_id;
				$v['cate'] = 'leave_statistic';
				if($r=$this->Task_statistic_returnleave->get_one(array('task_id'=>"$task_id", 'cate'=>'leave_statistic', 'student_id'=>"$v[student_id]"))) {
					//如果已经存在
					$this->Task_statistic_returnleave->update($v,"`id`=$r[id]");
				}else{
					//不存在
					if($this->Task_statistic_returnleave->insert($v)){
						//插入成功
					}else{
						exit(json_encode(array('response'=> false,'tips'=>'未知插入信息到表错误')));
					}
				}
			}
//			$this->Task_statistic_returnleave->insert($data);

			$this->User_action_log->action_log($task_id,'提交了离校统计');//用户行为记录
			exit(json_encode(array('data'=> $data,'next_url'=>current_url())));
		}
		$classes = $this->page_data['userinfo']['classes'];//获取登陆用户的班级数据
//		$this->page_data['statisticinfo']=$this->Task_statistic_returnleave->class_userinfo($task_id,$classes);//已输入信息
		$this->page_data['statistictable']=$this->Task_statistic_returnleave->leave_html_task_return_statistic($task_id,$classes,$this->group_id);//已输入信息
		$this->page_data['taskinfo']=$this->Task_title_model->get_one("`task_id`=$task_id");//获取任务列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/task_leave_statistic',$this->page_data);
	}
	/**
	 * 留校统计
	 */
	public function stay_statistic(){
		$array = $this->uri->uri_to_assoc(3);
		$task_id=$array['task_id'];
		if($this->input->is_ajax_request()){
			$data=$this->input->post('info');//获取array(student_id,reason,remark)
			if(empty($data[0]['student_id'])){exit(json_encode(array('response'=> false,'tips'=>'啥都没填,请刷新页面重新填写')));}
			foreach($data as $v){
				$v['task_id'] = $task_id;
				$v['cate'] = 'leave_statistic';
				if($r=$this->Task_statistic_returnleave->get_one(array('task_id'=>"$task_id", 'cate'=>'leave_statistic', 'student_id'=>"$v[student_id]"))) {
					//如果已经存在
					$this->Task_statistic_returnleave->update($v,"`id`=$r[id]");
				}else{
					//不存在
					if($this->Task_statistic_returnleave->insert($v)){
						//插入成功
					}else{
						exit(json_encode(array('response'=> false,'tips'=>'未知插入信息到表错误')));
					}
				}
			}
//			$this->Task_statistic_returnleave->insert($data);

			$this->User_action_log->action_log($task_id,'提交了留校统计');//用户行为记录
			exit(json_encode(array('data'=> $data,'next_url'=>current_url())));
		}
		$classes = $this->page_data['userinfo']['classes'];//获取登陆用户的班级数据
//		$this->page_data['statisticinfo']=$this->Task_statistic_returnleave->class_userinfo($task_id,$classes);//已输入信息
		$this->page_data['statistictable']=$this->Task_statistic_returnleave->leave_html_task_stay_statistic($task_id,$classes,$this->group_id);//已输入信息
		$this->page_data['taskinfo']=$this->Task_title_model->get_one("`task_id`=$task_id");//获取任务列表
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/task_stay_statistic',$this->page_data);
	}
	/*
	 * 返校统计 删除
	 */
	public function returnleave_statistic_delete()
	{
		if(!$this->input->is_ajax_request())exit('走开!');

		$id = $this->input->get('id');
		$task_id = $this->input->get('task_id');
		$username = $this->input->get('username');
		$stay=$this->input->get('stay');

		$r=$this->Task_statistic_returnleave->get_one(array('id'=>$id));
		if($this->Task_statistic_returnleave->delete("`id`='$id'")){
//			if($stay){$atschool = 0;}else{$atschool = 1;}//如果是留校统计 删除即为离校
			if($this->User_model->update(array('atschool'=>!$stay),array('student_id'=>$r['student_id']))){
				$this->User_action_log->action_log($task_id,"删除了 $username 的信息");//用户行为记录
				echo json_encode(array('id'=> $id));
			}else{
				echo json_encode(array('response'=> false,'tips'=>'修改用户在校情况失败'));
			}

		}else{
			echo json_encode(array('response'=> false));
		}
	}
	/*
	 * 返校统计 删除本班所有同学信息
	 */
	public function returnleave_statistic_delete_classall()
	{
		$task_id = $this->input->get('task_id');
		$classes = $this->page_data['userinfo']['classes'];//获取登陆用户的班级数据
		if(!$this->input->is_ajax_request())exit('走开!');

		if($this->Task_statistic_returnleave->delete_class($task_id,$classes)){
			$this->User_action_log->action_log($task_id,"$classes 人员已经到齐");//用户行为记录
			echo json_encode(array('task_id'=> $task_id));
		}else{
			$this->User_action_log->action_log($task_id,"$classes 人员已经到齐");//用户行为记录
			echo json_encode(array('task_id'=> $task_id));
		}
	}
	/**
	 * 用户姓名列表-信息以json格式输出
	 * 判断task only_selfclass
	 */
	public function user_username_json(){
//		echo "[{ id: 0, text: 'enhancement' }, { id: 1, text: 'bug' }, { id: 2, text: 'duplicate' }, { id: 3, text: 'invalid' }, { id: 4, text: 'wontfix' }]";
		if(!$this->input->is_ajax_request()) exit('what are you 弄撒嘞?');
		$username = $this->input->get('q');
		$classes = $this->page_data['userinfo']['classes'];//获取登陆用户的班级数据
		if($this->group_id == SUPERADMIN_GROUP_ID){//如果是管理员，搜索全局
			$userinfo = $this->User_model->select("`username` like '%$username%'",'`student_id`,`username`');
		}else{
			$userinfo = $this->User_model->select("`username` like '%$username%' AND `classes` = '$classes' ",'`student_id`,`username`');
		}

		foreach($userinfo as $k=>$v){
			$u[$k]['id']=$v['student_id'];
			$u[$k]['text']=$v['username'].'[学号:'.$v['student_id'].']';
		}
		echo json_encode($u);
	}
	/**
	 * 测试提交接口
	 */
	public function testposting(){
		$information = $_POST;
		echo "<pre>";
		print_r($information);
	}
}
