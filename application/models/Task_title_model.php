<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Task_title_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'task_title';
		$this->page_size = 20;
		parent::__construct();
	}
	/*
	 * 输出到dashboard的task_list
	 */
	public function dashboard_html(){
		$r = $this->select('','',5,'posttime DESC');
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
								<td><i class="fa fa-clock-o"></i>&nbsp; '.date("Y年n月d日 - g:s a",strtotime($v['deadtime'])).' </td>
								<td><span class="label label-';
								switch($v['status']){
									case '进行中' : $html.='danger';break;
									case '已完成' : $html.='success';break;
									default:break;
								}
			$html .= '">'.$v['status'].'</span></td>
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
	public function task_list_html(){
		$r = $this->select('','','','posttime DESC');
		$html  = '';
		$html .= '<table class="table table-hover"><tbody>';
		foreach($r as $v){
			$html .= '<tr>';
			$html .= '<td class="project-status">
        <span class="label label-';
			switch($v['status']){
				case '进行中' : $html.='danger';break;
				case '已完成' : $html.='success';break;
				default:break;
			}
			$html .= '">'.$v['status'].' </span></td>';
			$html .= '<td class="project-title">
									<a href="'.base_url('task').'/detail/task_id/'.$v['task_id'].'">'.$v['title'].'</a>
									<br>
									<small>创建于 '.$v['deadtime'].'</small>
								</td>';
			$html .= '<td class="project-completion">
									<small>当前进度： '.$v['progress'].'%</small>
									<div class="progress progress-xs active">
										<div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="'.$v['progress'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$v['progress'].'%">
											<span class="sr-only">'.$v['progress'].'% Complete (warning)</span>
										</div>
									</div>
								</td>';
			$html .= '<td class="project-people">
									<a href="projects.html"><img alt="image" class="img-circle" src="'.base_url("/public/AdminLTE2/dist/img").'/user6-128x128.jpg"></a>
									<a href="projects.html"><img alt="image" class="img-circle" src="'.base_url("/public/AdminLTE2/dist/img").'/user5-128x128.jpg"></a>
									<a href="projects.html"><img alt="image" class="img-circle" src="'.base_url("/public/AdminLTE2/dist/img").'/user1-128x128.jpg"></a>
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
			$html.='<tr>';
			$html.='<td>'.$key.'.</td>';
//			$html.='<td>'.$val['list_order'].'</td>';
			$html.='<td>'.$val['title'].'</td>';
			$html.='<td><div class="progress progress-xs active">
										<div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="'.$val['progress'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$val['progress'].'%">
										</div>
									</div>'.$val['progress'].'%</td>';
			$html.='<td>'.$this->User_group_model->get_user_gruop_name($val['group_id']).'</td>';
			$html.='<td>'.date("Y年n月d日 - g:s A",strtotime($val['posttime'])).'</td>';
			$html.='<td>'.date("Y年n月d日 - g:s A",strtotime($val['deadtime'])).'</td>';
			$html .= '<td>
        <span class="label label-';
			switch($val['status']){
				case '进行中' : $html.='danger';break;
				case '已完成' : $html.='success';break;
				default:break;
			}
			$html .= '">'.$val['status'].' </span></td>';
			$html.='<td><a href="'.base_url('admin/task_list_edit').'/task_id/'.$val['task_id'].'" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a> ';
			$html .= '<a href="javascript:if(confirm(\'确定要删除吗\'))window.location.href=\''.base_url('admin/task_list').'_delete/task_id/'.$val['task_id'].'\';" class="btn btn-white btn-sm"><span class="glyphicon glyphicon-edit"></span> 删除</a></td>';
		}
		return $html;
	}
}
