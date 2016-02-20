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

	/**
	 * 根据task_id和classes拉出用户信息
	 * @param $task_id
	 * @param $classes
	 * @param $group_id
	 * @return array
	 */
	public function class_userinfo($task_id,$classes,$group_id){
		$class_userinfo=array();
		$stu_id = $this->select("`task_id`='$task_id'");//获取改task_id下的所有用户学号
		if($this->group_id == SUPERADMIN_GROUP_ID) {//如果是管理员，搜索全局
			$stu_info = $this->User_model->select("","`college`,`classes`,`sex`,`student_id`,`username`,`long_phone`,`short_phone`,`qinshi`");//获取classes下的所有用户信息
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
	public function delete_class($task_id,$classes){
		$stu_id = $this->select("`task_id`='$task_id'");//获取改task_id下的所有用户学号
		$stu_info = $this->User_model->select("`classes`='$classes'","`classes`,`student_id`,`username`");//获取classes下的所有用户信息
		$class_userinfo=array();
		foreach($stu_id as $k=>$v){
			foreach($stu_info as $i){
				if($i['student_id']==$v['student_id']){//同classes下寻找student_id相同的用户信息
					$class_userinfo[$k]=$i;//将用户信息放入
					$class_userinfo[$k]['taskinfo']=$v;//将用户返校信息放入
				}
			}
		}
		if(empty($class_userinfo))return false;
		foreach($class_userinfo as $b){
			$this->delete(array('task_id'=>$task_id, 'student_id'=>$b['student_id']));
		}
		return true;
	}
	/*
	 * 返校统计表格
	 */
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
	/*
	 * 离校统计表格
	 */
	public function leave_html_task_return_statistic($task_id,$classes,$group_id){
		$class_userinfo =$this->class_userinfo($task_id,$classes,$group_id);
		$html  = '';
		$html .= '<table class="table table-bordered">
								<tbody><tr>
									<th style="width: 10px">#</th>
									<th>学号</th>
									<th>姓名</th>
									<th>班级</th>
									<th>离校目的地</th>
									<th>家庭第一联系人</th>
									<th>离校时间段</th>
									<th>分管辅导员</th>
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
			$html .= '<td>'.date('m月d日',strtotime($v['taskinfo']['begin_date'])).' 至 '.date('m月d日',strtotime($v['taskinfo']['end_date'])).'</td>';
			$html .= '<td>'.$v['taskinfo']['instructor'].'</td>';
			$html .= '<td><a href="javascript:void(0);" data-statistic-id="'.$v['taskinfo']['id'].'" data-statistic-username="'.$v['username'].'" class="btn btn-white btn-sm del"><span class="glyphicon glyphicon-edit"></span> 删除</a>'.'</td>';
			$html .= '</tr>';
		}
		$html .= '</tbody></table>';

		return $html;
	}
	/*
	 * 留校统计表格
	 */
	public function leave_html_task_stay_statistic($task_id,$classes,$group_id){
		$class_userinfo =$this->class_userinfo($task_id,$classes,$group_id);
		$html  = '';
		$html .= '<table class="table table-bordered">
								<tbody><tr>
									<th style="width: 10px">#</th>
									<th>学号</th>
									<th>姓名</th>
									<th>班级</th>
									<th>联系电话</th>
									<th>寝室</th>
									<th>留校原因</th>
									<th>负责人</th>
									<th>离校时间段</th>
									<th>分管辅导员</th>
									<th style="width: 40px">操作</th>
								</tr>';
		$index = 0;//# 计数
		foreach($class_userinfo as $v){
			$html .= '<tr>';
			$html .= '<td>'.++$index.'</td>';
			$html .= '<td>'.$v['student_id'].'</td>';
			$html .= '<td>'.$v['username'].'</td>';
			$html .= '<td>'.$v['classes'].'</td>';
			$html .= '<td>'.$v['long_phone'].'</td>';
			$html .= '<td>'.$v['qinshi'].'</td>';
			$html .= '<td>'.$v['taskinfo']['reason'].'</td>';
			$html .= '<td>'.$v['taskinfo']['remark'].'</td>';
			$html .= '<td>'.date('m月d日',strtotime($v['taskinfo']['begin_date'])).' 至 '.date('m月d日',strtotime($v['taskinfo']['end_date'])).'</td>';
			$html .= '<td>'.$v['taskinfo']['instructor'].'</td>';
			$html .= '<td><a href="javascript:void(0);" data-statistic-id="'.$v['taskinfo']['id'].'" data-statistic-username="'.$v['username'].'" class="btn btn-white btn-sm del"><span class="glyphicon glyphicon-edit"></span> 删除</a>'.'</td>';
			$html .= '</tr>';
		}
		$html .= '</tbody></table>';

		return $html;
	}
	/*
	 * 返校统计
	 * statistic
	 */
	public function html_return_statistic($task_id,$classes,$group_id){
		$class_userinfo =$this->class_userinfo($task_id,$classes,$group_id);
		$classeslist=$this->User_model->classes();
		$html  = '';
		$html .= '<table class="table table-bordered">
								<tr>
									<th rowspan="2" style="width: 10px">#</th>
									<th rowspan="2">专业班级</th>
									<th rowspan="2" >应到人数</th>
									<th rowspan="2" >已到人数</th>
									<th colspan="3">未到人数</th>
									<th rowspan="2">备注</th>
								</tr>
								<tr>
									<th>途中人数</th>
									<th>未联系上</th>
									<th>请假</th>
								</tr>
								<tbody>';
		$index = 0;//# 计数
		foreach($classeslist as $b){
			$b['all']=count($this->User_model->select(array('classes'=>$b['classes']),'`id`'));
			$b['tz']=$b['wlxs']=$b['qj']=$b['yidao']=0;
			$b['remarks']='';
			foreach($class_userinfo as $v){
				if($v['classes'] == $b['classes']){//存在此班级成员
					switch($v['taskinfo']['reason']){
						case '正在途中':
							$b['tz']++;
							$b['remarks'].=$v['username'].'正在途中,原因：'.$v['taskinfo']['remark'].';<br/>';
							break;
						case '未联系上':
							$b['wlxs']++;
							$b['remarks'].=$v['username'].'未联系上,原因：'.$v['taskinfo']['remark'].';<br/>';
							break;
						case '请假':
							$b['qj']++;
							$b['remarks'].=$v['username'].'请假,原因：'.$v['taskinfo']['remark'].';<br/>';
							break;
						default:break;
					}
				}
			}
			$b['yidao'] = $b['all']-$b['tz']-$b['wlxs']-$b['qj'];
			$html .= '<tr>';
			$html .= '<td>'.++$index.'</td>';
			$html .= '<td>'.$b['classes'].'</td>';
			$html .= '<td>'.$b['all'].'</td>';
			$html .= '<td>'.$b['yidao'].'</td>';
			$html .= '<td>'.$b['tz'].'</td>';
			$html .= '<td>'.$b['wlxs'].'</td>';
			$html .= '<td>'.$b['qj'].'</td>';
			$html .= '<td>'.$b['remarks'].'</td>';
			$html .= '<tr>';
		}
		$html .= '</tbody></table>';

		return $html;
	}
	/*
	 * 离校统计
	 */
	public function html_leave_statistic($task_id,$classes,$group_id){
		$class_userinfo =$this->class_userinfo($task_id,$classes,$group_id);
		$html  = '';
		$html .= '<table class="table table-bordered">
								<tbody><tr>
									<th style="width: 10px">#</th>
									<th>学院</th>
									<th>学号</th>
									<th>姓名</th>
									<th>性别</th>
									<th>寝室</th>
									<th>长号</th>
									<th>短号</th>
									<th>离校目的地</th>
									<th>家庭第一联系人</th>
									<th>离校时间段</th>
									<th>分管辅导员</th>
								</tr>';
		$index = 0;//# 计数
		foreach($class_userinfo as $v){
			$html .= '<tr>';
			$html .= '<td>'.++$index.'</td>';
			$html .= '<td>'.$v['college'].'</td>';
			$html .= '<td>'.$v['student_id'].'</td>';
			$html .= '<td>'.$v['username'].'</td>';
			$html .= '<td>';
			if($v['sex']){$html .='男';}else{$html .='女';}
			$html .= '</td>';
			$html .= '<td>'.$v['qinshi'].'</td>';
			$html .= '<td>'.$v['long_phone'].'</td>';
			$html .= '<td>'.$v['short_phone'].'</td>';
			$html .= '<td>'.$v['taskinfo']['reason'].'</td>';
			$html .= '<td>'.$v['taskinfo']['remark'].'</td>';
			$html .= '<td>'.date('m月d日',strtotime($v['taskinfo']['begin_date'])).' 至 '.date('m月d日',strtotime($v['taskinfo']['end_date'])).'</td>';
			$html .= '<td>'.$v['taskinfo']['instructor'].'</td>';
			$html .= '</tr>';
		}
		$html .= '</tbody></table>';

		return $html;
	}
	/*
	 * 留校统计表格
	 */
	public function html_stay_statistic($task_id,$classes,$group_id){
		$class_userinfo =$this->class_userinfo($task_id,$classes,$group_id);
		$html  = '';
		$html .= '<table class="table table-bordered">
								<tbody><tr>
									<th style="width: 10px">#</th>
									<th>学号</th>
									<th>姓名</th>
									<th>班级</th>
									<th>联系电话</th>
									<th>寝室</th>
									<th>留校原因</th>
									<th>负责人</th>
									<th>离校时间段</th>
									<th>分管辅导员</th>
									<th style="width: 40px">操作</th>
								</tr>';
		$index = 0;//# 计数
		foreach($class_userinfo as $v){
			$html .= '<tr>';
			$html .= '<td>'.++$index.'</td>';
			$html .= '<td>'.$v['student_id'].'</td>';
			$html .= '<td>'.$v['username'].'</td>';
			$html .= '<td>'.$v['classes'].'</td>';
			$html .= '<td>'.$v['long_phone'].'</td>';
			$html .= '<td>'.$v['qinshi'].'</td>';
			$html .= '<td>'.$v['taskinfo']['reason'].'</td>';
			$html .= '<td>'.$v['taskinfo']['remark'].'</td>';
			$html .= '<td>'.date('m月d日',strtotime($v['taskinfo']['begin_date'])).' 至 '.date('m月d日',strtotime($v['taskinfo']['end_date'])).'</td>';
			$html .= '<td>'.$v['taskinfo']['instructor'].'</td>';
			$html .= '<td><a href="javascript:void(0);" data-statistic-id="'.$v['taskinfo']['id'].'" data-statistic-username="'.$v['username'].'" class="btn btn-white btn-sm del"><span class="glyphicon glyphicon-edit"></span> 删除</a>'.'</td>';
			$html .= '</tr>';
		}
		$html .= '</tbody></table>';

		return $html;
	}
}
