<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Module_menu_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'module_menu';
		parent::__construct();

	}
	public function sider_html(){
		$siderinfo=$this->select('`is_display`=1');//获取module_menu数据 条件搜索
		$html ='';
		$html .= '<ul class="sidebar-menu">';
		$list_order_arr=$this->arr_ksort($siderinfo,'list_order');//按照list_order排序后
		foreach($list_order_arr as $v){
			if($v['is_header']){//显示分割栏
				$html.= '<li class="header">'.$v['menu_name'].'</li>';
				continue; // 当为头时，跳出本次循环
			}else if($v['show_alone']){//独立显示为一栏
				if($v['is_parent']){//是父元素
					if(empty($v['arr_childid'])){//父元素但无子元素 => 单独显示，无下拉菜单
						$html.= '<li class="';
						if(trim($this->router->class)==$v['controller'] && trim($this->router->method)==$v['method'])$html.='active';
						$html.=	'"><a href="'.base_url('').$v['controller'].'/'.$v['method'].'">';
						$html.= '<i class="fa '.$v['css_icon'].'"></i><span>'.$v['menu_name'].'</span>';//显示css_icon和栏目名
					}else{//父元素有子元素 => 下拉菜单样式
						$html.= '<li class="treeview';
						$html.='active';
						$html.= '"><a href="#">';
						$html.= '<i class="fa '.$v['css_icon'].'"></i><span>'.$v['menu_name'].'</span>';//显示css_icon和栏目名
						$html.= '<i class="fa fa-angle-left pull-right"></i></a>';
						$html.= $this->get_child_menu_html($v,$siderinfo);
					}
					$html.= '</li>';
				}else{//不是父元素但独立显示为一栏 无下拉菜单
					$html.= '<li class="';
					if(trim($this->router->class)==$v['controller'] && trim($this->router->method)==$v['method'])$html.='active';
					$html.= '">'.'<a href="'.base_url().$v['controller'].'/'.$v['method'].'">';
					$html.= '<i class="fa '.$v['css_icon'].'"></i> <span>'.$v['menu_name'].'</span>';
					$html.= '</a></li>';
				}
			}
		}
		$html .= '</ul>';
		return $html;
	}
	/**
	 * 得到子级
	 * @param array 正在被遍历的一条内容数组
	 * @param array 总数组
	 * @return array
	 */
	public function get_child_menu_html($v,$siderinfo){
		$html ='';
		$html.= '<ul class="treeview-menu">';
		$v['child_id']=explode(',',$v['arr_childid']);
		foreach($v['child_id'] as $child_id){//{1,2}
			foreach($siderinfo as $childinfo){//sideinfo遍历与child_id碰撞
				if($child_id==$childinfo['menu_id'] && !$childinfo['show_alone'] ){

					foreach(explode(',',$childinfo['arr_childid']) as $whereid){
						$r[]= $this->get_one("`menu_id`=$whereid");
					}//搜索子集放入$r
					$childinfo['child_display']=0;//声明 子集display
					foreach($r as $rs){
						if(!empty($rs)){
							if($rs['is_display']==1)	$childinfo['child_display']++;//子集display==1 累加
						}
					}

					if(empty($childinfo['arr_childid']) || !$childinfo['child_display']){//无子元素|子集不显示 => 单独显示，无下拉菜单
						$html.= '<li class="active">';
						$html.= '<a href="'.base_url().$childinfo['controller'].'/'.$childinfo['method'].'">';
						$html.= '<i class="fa '.$childinfo['css_icon'].'"></i><span>'.$childinfo['menu_name'].'</span></a>';//显示css_icon和栏目名
					}else{//有子元素 => 下拉菜单样式
						$html.='<li class="treeview"><a href="#">';
						$html.= '<i class="fa '.$childinfo['css_icon'].'"></i><span>'.$childinfo['menu_name'].'</span>';//显示css_icon和栏目名
						$html.='<i class="fa fa-angle-left pull-right"></i></a>';
						$html.= $this->get_child_menu_html($childinfo,$siderinfo);
					}
					$html.= '</li>';

				}
			}
		}
		$html.= '</ul>';
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
	/**
	 *  模块修改 table html
	 */
	public function return_menu_html(){
		$html = '';
		$siderinfo=$this->select();
		$list_order_arr=$this->arr_ksort($siderinfo,'list_order');//按照list_order排序后
		foreach($list_order_arr as $v){
			if($v['is_header']){
				$html .='<tr><b>';
				$html .='<td>'.$v['menu_id'].'</td>';
				$html .='<td><i class="fa '.$v['css_icon'].'" style="padding-right: 6px;"></i>'.$v['menu_name'].'</td>';
				$html .='<td>'.$v['list_order'].'</td>';
				$html .='<td>'.$v['controller'].'</td>';
				$html .='<td>'.$v['method'].'</td>';
				$html .='<td>'.$v['is_display'].'</td>';
				$html .='<td>'.$v['show_alone'].'</td>';
				$html .='<td><a href="'.base_url('admin/modulemenu').'_add/menu_id/'.$v['menu_id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> 添加子栏目</a>
<a href="'.base_url('admin/modulemenu').'_edit/menu_id/'.$v['menu_id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-wrench"></span> 修改</a></td>';
				$html .='</b></tr>';
			}
			if($v['is_parent']){
				$html .='<tr>';
				$html .='<td>'.$v['menu_id'].'</td>';
				$html .='<td style="padding-left: 25px"><i class="fa '.$v['css_icon'].'" style="padding-right: 6px;"></i>'.$v['menu_name'].'</td>';
				$html .='<td>'.$v['list_order'].'</td>';
				$html .='<td>'.$v['controller'].'</td>';
				$html .='<td>'.$v['method'].'</td>';
				$html .='<td>'.$v['is_display'].'</td>';
				$html .='<td>'.$v['show_alone'].'</td>';
				$html .='<td><a href="'.base_url('admin/modulemenu').'_add/menu_id/'.$v['menu_id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> 添加子栏目</a>
<a href="'.base_url('admin/modulemenu').'_edit/menu_id/'.$v['menu_id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-wrench"></span> 修改</a></td>';
				$html .='</tr>';

				if( !empty($v['arr_childid']) ){
					$html .=$this->get_child_module_html($v,$siderinfo);
				}
			}
		}
		return $html;

	}
	/**
	 * 得到子级
	 * @param array 正在被遍历的一条内容数组
	 * @param array 总数组
	 * @param int 缩进padding
	 * @return array
	 */
	public function get_child_module_html($v,$siderinfo,$tab =25){
		$html ='';
		$tab += 20;
		$v['child_id']=explode(',',$v['arr_childid']);
		foreach($v['child_id'] as $child_id){
			foreach($siderinfo as $child_info){
				if($child_id == $child_info['menu_id']){
					$html .='<tr>';
					$html .='<td>'.$child_info['menu_id'].'</td>';
					$html .='<td style="padding-left: '.$tab.'px"><i class="fa '.$child_info['css_icon'].'" style="padding-right: 5px;"></i>'.$child_info['menu_name'].'</td>';
					$html .='<td>'.$child_info['list_order'].'</td>';
					$html .='<td>'.$child_info['controller'].'</td>';
					$html .='<td>'.$child_info['method'].'</td>';
					$html .='<td>'.$child_info['is_display'].'</td>';
					$html .='<td>'.$child_info['show_alone'].'</td>';
					$html .='<td><a href="'.base_url('admin/modulemenu').'_add/menu_id/'.$child_info['menu_id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> 添加子栏目</a>
<a href="'.base_url('admin/modulemenu').'_edit/menu_id/'.$child_info['menu_id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-wrench"></span> 修改</a></td>';
					$html .='</tr>';
					if( !empty($child_info['arr_childid']) ) {
						$html .=$this->get_child_module_html($child_info,$siderinfo,$tab);
					}
				}
			}
		}
		return $html;
	}
	/**
	 * 获取页面信息
	 */
	public function get_current_page_info(){
		$page_data['controller']= trim($this->router->class);
		$page_data['method']= trim($this->router->method);
		$current_pageinfo=$this->select($page_data);
		$current_pageinfo=array_shift($current_pageinfo);
		$arr='';
		$arr.=$current_pageinfo['menu_name'].',';
		$arr.=$current_pageinfo['description'].',';
		$arr.=$current_pageinfo['controller'].',';
		$arr.=$current_pageinfo['method'].',';
		$arr.=$current_pageinfo['parent_id'];
		//检测父ID是否为本身
		if($current_pageinfo['parent_id']==$current_pageinfo['menu_id']){

		}else {
			$arr.=$this->get_current_page_info_child($current_pageinfo);
		}

		$newarr = explode('|', $arr);
		foreach ($newarr as $v) {
			$arr_pageinfo[] = explode(',', $v);
		}

		return $arr_pageinfo;

	}
	/**
	 * 获取页面信息 子集
	 */
	public function get_current_page_info_child($current_pageinfo)
	{
		if ($current_pageinfo['parent_id'] == $current_pageinfo['menu_id']) {

		} else {
			foreach ($this->select() as $v) {
				if ($v['menu_id'] == $current_pageinfo['parent_id']) {//碰撞父元素
					$arr = '';
					$arr .= '|';
					$arr .= $v['menu_name'] . ',';
					$arr .= $v['description'].',';
					$arr .= $v['controller'] . ',';
					$arr .= $v['method'] . ',';
					$arr .= $v['parent_id'];
					$arr .= $this->get_current_page_info_child($v);

				}
			}
			return $arr;
		}
	}
	/**
	 * Page header html输出
	 */
	public function get_page_header_html(){
		$current_page_info=$this->get_current_page_info();
		$html = '';
		$html .= '<section class="content-header">';
		$html .= '<h1>';
		$html .= $current_page_info[0][0];
		$html .= '<small>' . $current_page_info[0][1] . '</small>';
		$html .= '</h1>';
		$html .= '<ol class="breadcrumb">';
		$html .= '	<li><a href="' . base_url('dashboard') . '"><i class="fa fa-dashboard"></i> 主页</a></li>';
		krsort($current_page_info);
		foreach ($current_page_info as $k => $v) {
			if ($k == 0) {
				$html .= '<li>' . $v[0] . '</li>';
			} else {
				$html .= '<li><a href="' . base_url("$v[2]/$v[3]") . '">' . $v[0] . '</a></li>';
			}

		}

		$html.='</ol>';
		$html.='</section>';
		return $html;

	}

}
