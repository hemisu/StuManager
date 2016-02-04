<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_action_log extends Base_Model {

	public function __construct() {
		$this->table_name = 'user_action_log';
//		$this->page_size = 20;
		parent::__construct();
		//======载入模块======
		$this->load->model(array('User_model'//用户数据模块
		));
	}
	/*
	 * 用户行为记录
	 */
	public function action_log($task_id,$str){
		$action_log=array('student_id'=>$this->student_id, 'task_id'=>$task_id,
			'cate'=>'return_statistic', 'description'=>$str,
			'content'=>'' ,'datetime'=>SYS_TIME,
			'ip'=>$this->input->ip_address(), 'user_agent'=>$this->input->user_agent()
		);
		$this->insert($action_log);//用户行为记录
	}
	/*
	 * 返校统计类 html输出
	 */
	public function html_return_statistic($task_id){
		$r=$this->select("`task_id`=$task_id");
		$html = '';
		foreach($r as $k=>$v){
			$u = $this->User_model->get_one("`student_id`=$v[student_id]","`avatar`,`username`");//用户信息
			$t = $this->Task_title_model->get_one("`task_id`=$task_id","`title`");//用户信息
			$html .= '<div class="feed-element">
								<a href="#" class="pull-left">
									<img alt="image" class="img-circle" src="'.base_url("public/avatar/$u[avatar]").'">
								</a>
								<div class="media-body ">
									<small class="pull-right">'.$k.'#</small>
									<strong>'.$u['username'].'</strong> 提交了 <strong>'.$t['title'].'</strong> .
									<br>
									<small class="text-muted"><time class="timeago" datetime="'.date('c',$v['datetime']).'"></time> 来自 '.$this->input->user_agent().'</small>
									<br><p>'.$v['description'].'</p>';
			if(!empty($v['content'])){$html .='<div class="well">'.$v['content'].'</div>';}
			$html .='</div>
							</div>';
		}
		return $html;
	}
}
