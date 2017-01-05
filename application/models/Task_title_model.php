<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Task_title_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'task_title';
		$this->page_size = 20;
		parent::__construct();
	}
	public function progress_time($v){
		//统计所占日期百分比
		$proportion = 0 ;//时间所占百分比
		$differtime = strtotime($v['deadtime'])-strtotime($v['posttime']);
		if( (strtotime($v['deadtime'])-time()) >0 ){//未到时间
			$proportion = round( (time()-strtotime($v['posttime']))/$differtime ,1);
		}else{
			$proportion = 100;
		}
		return $proportion;
	}
	/*
	 * 输出到head中的task
	 */
	public function head_task_html($group_id){
		$before_priv = $this->select('','','','posttime DESC');//权限筛选前
		//权限筛选
		foreach($before_priv as $a){
			unset($arr);
			$arr=explode(',',$a['group_id']);
			if($group_id == SUPERADMIN_GROUP_ID){
				$r=$before_priv;
				break;
			}
			foreach($arr as $b){
				if($b == $group_id){
					$r[]= $a;
				}
			}
		}
//		if(count($r)>5){array_slice($r,0,5);}
//		$this->progress_color[array_rand($this->progress_color,1)];
		$html  = '';
		$html .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<span class="label label-danger">'.count($r).'</span>
							</a>';
		$html .= '<ul class="dropdown-menu">
							<li class="header">你有 '.count($r).' 个任务</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
								';
		foreach($r as $v){
			$proportion = $this->progress_time($v);
			$html .= '
									<li><!-- Task item -->
										<a href="'.base_url('task/detail/task_id/'.$v['task_id']).'">
											<h3>
												'.$v['title'].'
												<small class="pull-right">'.$proportion.'%</small>
											</h3>
											<div class="progress xs">
												<div class="progress-bar progress-bar-'.$this->progress_color[array_rand($this->progress_color,1)].'" style="width: '.$proportion.'%" role="progressbar" aria-valuenow="'.$proportion.'" aria-valuemin="0" aria-valuemax="100">
													<span class="sr-only">'.$proportion.'% Complete</span>
												</div>
											</div>
										</a>
									</li><!-- end task item -->';
		}
		$html .= '
								</ul>
							</li>
							<li class="footer">
								<a href="'.base_url('task').'">浏览所有的待办事项</a>
							</li>
						</ul>';
		return $html;
	}
	/*
	 * 输出到dashboard的task_list 根据权限显示
	 */
	public function dashboard_html($group_id){
		$before_priv = $this->select('','','','posttime DESC');//权限筛选前
		foreach($before_priv as $a){
			unset($arr);
			$arr=explode(',',$a['group_id']);
			if($group_id == SUPERADMIN_GROUP_ID){
				$r=$before_priv;
				break;
			}
			foreach($arr as $b){
				if($b == $group_id){
					$r[]= $a;
				}
			}
		}
		if(count($r)>5){array_slice($r,0,5);}

		$html  = '';
		$html .= '<table class="table no-margin">
								<thead>
								<tr>
									<th>名称</th>
									<th>截止时间</th>
									<th>状态</th>
									<th>操作</th>
								</tr>
								</thead>
								<tbody>';
		foreach($r as $v){
			$html .= '<tr>';
			$html .= '
								<td><a href="'.base_url('task').'/detail/task_id/'.$v['task_id'].'">'.$v['title'].'</a></td>
								<td><i class="fa fa-clock-o"></i>&nbsp; '.date("y年n月d日 - H:s",strtotime($v['deadtime'])).' </td>
								<td><span class="label label-';
								if(time()-strtotime($v['deadtime']) <0){
									$html.='danger';
								}else{
									$html.='success';
								}
			$html .= '">';
								if(time()-strtotime($v['deadtime']) <0){
									$html.='进行中';
								}else{
									$html.='已完成';
								}
			$html .= '</span></td>
								<td>-</td>';
			$html .= '</tr>';
		}

		$html .='</tbody>
						 </table>';
		return $html;
	}
	/*
	 * 输出到public中的task_list
	 */
	public function task_list_html($group_id){
		$before_priv = $this->select('','','','posttime DESC');//权限筛选前
		foreach($before_priv as $a){
			unset($arr);
			$arr=explode(',',$a['group_id']);
			if($group_id == SUPERADMIN_GROUP_ID){
				$r=$before_priv;
				break;
			}
			foreach($arr as $b){
				if($b == $group_id){
					$r[]= $a;
				}
			}
		}
		if(count($r)>5){array_slice($r,0,5);}

		$html  = '';
		$html .= '<table class="table table-hover"><tbody>';
		foreach($r as $v){
			$proportion = $this->progress_time($v);
			$html .= '<tr>';
			$html .= '<td class="project-status">
        <span class="label label-';
			if(time()-strtotime($v['deadtime']) <0){
				$html.='danger';
			}else{
				$html.='success';
			}
			$html .= '">';
			if(time()-strtotime($v['deadtime']) <0){
				$html.='进行中';
			}else{
				$html.='已完成';
			}
			$html .= '</span></td>';
			$html .= '<td class="project-title">
									<a href="'.base_url('task').'/detail/task_id/'.$v['task_id'].'">'.$v['title'].'</a>
									<br>
									<small>创建于 '.$v['deadtime'].'</small>
								</td>';
			$html .= '<td class="project-completion">
									<small>当前进度： '.$proportion.'%</small>
									<div class="progress progress-xs active">
										<div class="progress-bar progress-bar-'.$this->progress_color[array_rand($this->progress_color,1)].' progress-bar-striped" role="progressbar" aria-valuenow="'.$proportion.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$proportion.'%">
											<span class="sr-only">'.$proportion.'% Complete (warning)</span>
										</div>
									</div>
								</td>';
			$html .= '<td class="project-people">
									<small>用户组：</small><br/>
									<small>'.$this->User_group_model->get_user_gruop_name($v['group_id']).'</small>
								</td>';
			$html .= '<td class="project-actions">
									<a href="'.base_url('task').'/detail/task_id/'.$v['task_id'].'" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
								</td>';
			$html .= '</tr>';
		}

		$html .='</tbody></table>';
		return $html;
	}
	/*
	 * 输出到管理页面的task_list
	 *
	 */
	public function admin_task_list_html($page_now = 1)
	{
		$html = '';
		$list = $this->listinfo('','*','posttime DESC' , $page_now, $this->page_size,'',$this->page_size,page_list_url('admin/task_list',true));
		foreach($list as $key=>$val){
			$proportion = $this->progress_time($val);
			$html.='<tr>';
			$html.='<td>'.$key.'.</td>';
//			$html.='<td>'.$val['list_order'].'</td>';
			$html.='<td><a href="'.base_url('task').'/detail/task_id/'.$val['task_id'].'">'.$val['title'].'</a></td>';
			$html.='<td><div class="progress progress-xs active">
										<div class="progress-bar progress-bar-'.$this->progress_color[array_rand($this->progress_color,1)].' progress-bar-striped" role="progressbar" aria-valuenow="'.$proportion.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$proportion.'%">
										</div>
									</div>'.$proportion.'%</td>';
			$html.='<td>'.$this->User_group_model->get_user_gruop_name($val['group_id']).'</td>';
			$html.='<td>'.$val['cate'].'</td>';
			$html.='<td>'.date("y年n月d日 - H:s",strtotime($val['posttime'])).'</td>';
			$html.='<td>'.date("y年n月d日 - H:s",strtotime($val['deadtime'])).'</td>';
			$html .= '<td>
        <span class="label label-';
			if(time()-strtotime($val['deadtime']) <0){
				$html.='danger';
			}else{
				$html.='success';
			}
			$html .= '">';
			if(time()-strtotime($val['deadtime']) <0){
				$html.='进行中';
			}else{
				$html.='已完成';
			}
			$html .= ' </span></td>';
			$html.='<td><a href="'.base_url('admin/task_list_edit').'/task_id/'.$val['task_id'].'" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a> ';
			$html .= '<a href="javascript:if(confirm(\'确定要删除吗\'))window.location.href=\''.base_url('admin/task_list').'_delete/task_id/'.$val['task_id'].'\';" class="btn btn-white btn-sm"><span class="glyphicon glyphicon-edit"></span> 删除</a></td>';
		}
		return $html;
	}
	/**
	 * 输出到统计页面的selected
	 */
	function statistic_option($cate = '',$task_id='',$group_id){
		$before_priv = $this->select(array('cate'=>$cate),'','','posttime DESC');//权限筛选前
		foreach($before_priv as $a){
			unset($arr);
			$arr=explode(',',$a['group_id']);
			if($group_id == SUPERADMIN_GROUP_ID){
				$list=$before_priv;
				break;
			}
			foreach($arr as $b){
				if($b == $group_id){
					$list[]= $a;
				}
			}
		}
		$html = '<div class="form-group">
	            <label>事项选择</label>
	            <select class="form-control cateoption">
	            <option value="'.current_url().'">===选择需要查看的事项===</option>
            ';
		foreach($list as $v){
			$html .= '<option value="'.base_url('statistic/'.$cate.'/task_id/'.$v['task_id']).'"';
			if($task_id == $v['task_id']) $html .= 'selected';
			$html .= '>'.$v['title'].'</option>';
		}
		$html .= '</select>
           	 </div>';
		return $html;
	}
}
