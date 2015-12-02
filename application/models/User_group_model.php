<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_group_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'user_group';
		parent::__construct();
		//======载入模块======
		$this->load->model(array('User_model',
			'Announce_model','Module_menu_model',
			'User_group_priv_model','User_group_model'));

	}

	/**
	 * 返回用户组列表
	 * @return string
	 */
	public function return_group_list_html(){
		$html = '';
		$groupinfo=$this->select();
		foreach($groupinfo as $k=>$v){
			$html .= '<tr>';
			$html .= '<td>'.$k.'</td>';
			$html .= '<td>'.$v['group_id'].'</td>';
			$html .= '<td>'.$v['group_name'].'</td>';
			$html .= '<td>'.$v['description'].'</td>';
			$html .= '<td><a href="'.base_url('admin/user_group').'_edit/group_id/'.$v['group_id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-wrench"></span> 修改</a> ';
			if($v['group_id']!=SUPERADMIN_GROUP_ID){//不是超级管理员
				$html .= '<a href="'.base_url('admin/user_group').'_priv/group_id/'.$v['group_id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-wrench"></span> 分配权限</a> ';
			}
			$html .= '<a href="javascript:if(confirm(\'确定要删除吗\'))window.location.href=\''.base_url('admin/user_group').'_delete/group_id/'.$v['group_id'].'\';" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> 删除</a></td>';
			$html .= '</tr>';
		}
		return $html;

	}
	/**
	 *  模块修改 table html
	 * 					Array
	(
	[0] => Array
	(
	[group_id] => 2
	[folder] =>
	[controller] => user
	[method] => profile
	[priv_id] => 4
	)

	)
	 */
	public function return_user_group_priv_html($group_id){
		$html = '';
		$siderinfo=$this->Module_menu_model->select();
		$list_order_arr=$this->arr_ksort($siderinfo,'list_order');//按照list_order排序后
		foreach($list_order_arr as $v){
			if($v['is_header']){
				$html .='<tr><b>';
				$html .='<td>'.$v['menu_id'].'</td>';
				$html .='<td><i class="fa '.$v['css_icon'].'" style="padding-right: 6px;"></i>'.$v['menu_name'].'</td>';
				$html .='<td></td>';
				$html .='</b></tr>';
			}
			if($v['is_parent']){
				$html .='<tr>';
				$html .='<td>'.$v['menu_id'].'</td>';
				$html .='<td style="padding-left: 25px"><i class="fa '.$v['css_icon'].'" style="padding-right: 6px;"></i>'.$v['menu_name'].'</td>';
				$html .='<td><input type="checkbox" name="prv['.$v['menu_id'].']" ';
				foreach($this->User_group_priv_model->select("`group_id`=$group_id") as $check){
					if($check['menu_id']==$v['menu_id']) $html .='checked';
				}
				$html .=' value="'.$v['menu_id'].'"></td>';
				$html .='</tr>';

				if( !empty($v['arr_childid']) ){
					$html .=$this->get_child_user_group_priv_html($v,$siderinfo,25,$group_id);
				}
			}
		}
		return $html;

	}
	/**
	 * 得到模块子级
	 * @param array 正在被遍历的一条内容数组
	 * @param array 总数组
	 * @param int 缩进padding
	 * @return array
	 */
	public function get_child_user_group_priv_html($v,$siderinfo,$tab =25,$group_id){
		$html ='';
		$tab += 20;
		$v['child_id']=explode(',',$v['arr_childid']);
		foreach($v['child_id'] as $child_id){
			foreach($siderinfo as $child_info){
				if($child_id == $child_info['menu_id']){
					$html .='<tr>';
					$html .='<td>'.$child_info['menu_id'].'</td>';
					$html .='<td style="padding-left: '.$tab.'px"><i class="fa '.$child_info['css_icon'].'" style="padding-right: 5px;"></i>'.$child_info['menu_name'].'</td>';
					$html .='<td><input type="checkbox" name="prv['.$child_info['menu_id'].']" ';
					foreach($this->User_group_priv_model->select("`group_id`=$group_id") as $check){
						if($check['menu_id']==$child_info['menu_id'])$html .='checked';
					}
					$html .=' value="'.$child_info['menu_id'].'"></td>';
					$html .='</tr>';
					if( !empty($child_info['arr_childid']) ) {
						$html .=$this->get_child_user_group_priv_html($child_info,$siderinfo,$tab,$group_id);
					}
				}
			}
		}
		return $html;
	}
	/**
	 * ARRAY KEY排序
	 * @param $array
	 * @param $key
	 * @param string $order
	 * @return array
	 */
	function arr_ksort($array,$key,$order="asc"){//asc是升序 desc是降序
		$arr_nums=$arr=array();
		foreach($array as $k=>$v){
			$arr_nums[$k]=$v[$key];
		}
		if($order=='asc'){
			asort($arr_nums);
		}else{
			arsort($arr_nums);
		}
		foreach($arr_nums as $k=>$v){
			$arr[$k]=$array[$k];
		}

		return $arr;
	}
}
