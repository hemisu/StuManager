<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Task_statistic_returnleave extends Base_Model {

	public function __construct() {
		$this->table_name = 'task_statistic_returnleave';
//		$this->page_size = 20;
		parent::__construct();
		//======载入模块======
		$this->load->model(array('User_model'//用户数据模块
		));
	}
	public function class_userinfo($task_id,$classes,$group_id){
		$class_userinfo=array();
		$stu_id = $this->select("`task_id`='$task_id'");//获取改task_id下的所有用户学号
		if($this->group_id == SUPERADMIN_GROUP_ID) {//如果是管理员，搜索全局
			$stu_info = $this->User_model->select("","`classes`,`student_id`,`username`");//获取classes下的所有用户信息
		}else{
			$stu_info = $this->User_model->select("`classes`='$classes'","`classes`,`student_id`,`username`");//获取classes下的所有用户信息
		}

		foreach($stu_id as $k=>$v){
			foreach($stu_info as $i){
				if($i['student_id']==$v['student_id']){//同classes下寻找student_id相同的用户信息
					$class_userinfo[$k]=$i;//将用户信息放入
					$class_userinfo[$k]['taskinfo']=$v;//将用户返校信息放入
				}
			}
		}
		return $class_userinfo;
	}
	public function return_html_task_return_statistic($task_id,$classes,$group_id){
		$class_userinfo =$this->class_userinfo($task_id,$classes,$group_id);
		$html  = '';
		$html .= '<table class="table table-bordered">
								<tbody><tr>
									<th style="width: 10px">#</th>
									<th>学号</th>
									<th>姓名</th>
									<th>班级</th>
									<th>未到原因</th>
									<th>备注</th>
									<th style="width: 40px">操作</th>
								</tr>';
		$index = 0;//# 计数
		foreach($class_userinfo as $v){
			$html .= '<tr>';
			$html .= '<td>'.++$index.'</td>';
			$html .= '<td>'.$v['student_id'].'</td>';
			$html .= '<td>'.$v['username'].'</td>';
			$html .= '<td>'.$v['classes'].'</td>';
			$html .= '<td>'.$v['taskinfo']['reason'].'</td>';
			$html .= '<td>'.$v['taskinfo']['remark'].'</td>';
			$html .= '<td><a href="javascript:void(0);" data-statistic-id="'.$v['taskinfo']['id'].'" data-statistic-username="'.$v['username'].'" class="btn btn-white btn-sm del"><span class="glyphicon glyphicon-edit"></span> 删除</a>'.'</td>';
			$html .= '</tr>';
		}
		$html .= '</tbody></table>';

		return $html;
	}
}
