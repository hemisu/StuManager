<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 16/2/18
 * Time: 下午3:49
 */
class Statistic extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		//======载入模块======
		$this->load->model(array('Task_title_model',//任务列表模块
			'User_action_log','Task_statistic_returnleave',//用户行为日志模块,返校_离校统计模块
		));
	}

	/*
	 * 返校
	 */
	function return_statistic()
	{
		$urlarray = $this->uri->uri_to_assoc(3);
		$task_id = '';
		if(isset($urlarray['task_id'])){
			$task_id=$urlarray['task_id'];
			$this->page_data['statistictable']=$this->Task_statistic_returnleave->html_return_statistic($task_id,'*',$this->group_id);//已输入信息
		}

		$this->page_data['cateoption'] = $this->Task_title_model->statistic_option('return_statistic',$task_id,$this->group_id);
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/returnleave_statistic',$this->page_data);
	}
	/*
	 * 离校
   */
	function leave_statistic()
	{
		$urlarray = $this->uri->uri_to_assoc(3);
		$task_id = '';
		if(isset($urlarray['task_id'])){
			$task_id=$urlarray['task_id'];
			$this->page_data['statistictable']=$this->Task_statistic_returnleave->html_leave_statistic($task_id,'*',$this->group_id);//已输入信息
		}
		$this->page_data['cateoption'] = $this->Task_title_model->statistic_option('leave_statistic',$task_id,$this->group_id);

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/returnleave_statistic',$this->page_data);
	}
	/*
	 * 留校
   */
	function stay_statistic()
	{
		$urlarray = $this->uri->uri_to_assoc(3);
		$task_id = '';
		if(isset($urlarray['task_id'])){
			$task_id=$urlarray['task_id'];
			$this->page_data['statistictable']=$this->Task_statistic_returnleave->html_stay_statistic($task_id,'*',$this->group_id);//已输入信息
		}
		$this->page_data['cateoption'] = $this->Task_title_model->statistic_option('stay_statistic',$task_id,$this->group_id);

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/returnleave_statistic',$this->page_data);
	}
}