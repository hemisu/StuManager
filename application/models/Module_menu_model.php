<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Module_menu_model extends Base_Model
{

	public function __construct()
	{
		$this->table_name = 'module_menu';
		parent::__construct();

	}

	/**
	 * 侧栏输出
	 * @param int
	 * @return string
	 */
	public function sider_html($group_id)
	{
//		$exparr = explode('_','announce_edit_add');
//		print_r($exparr);
		$siderinfo = $this->select('`is_display`=1');//获取module_menu数据 条件搜索
		$html = '';
		$html .= '<ul class="sidebar-menu">'."\n";
		$list_order_arr = $this->arr_ksort($siderinfo, 'list_order');//按照list_order排序后
		foreach ($list_order_arr as $v) {
			/*======先显示头部======*/
			if ($v['is_header']) {//显示分割栏
				$html .= '<li class="header">' . $v['menu_name'] . '</li>'."\n";
				continue; // 当为头时，跳出本次循环
			}
			/*======判断权限再显示======*/
			if ($group_id != SUPERADMIN_GROUP_ID) {//避开最高管理员
				if ($v['menu_id'] != 1) {//避开主页 dashboard的menu_id=1
					// 用户组权限数据库中搜索权限
					$priv = $this->User_group_priv_model->count(array('menu_id' => $v['menu_id'], 'group_id' => $group_id));
					if (!$priv) continue;//不存在 跳过本次循环
				}
			}
			/*======侧栏html代码生成======*/
			if ($v['show_alone']) {//独立显示为一栏
				if ($v['is_parent']) {//是父元素
					if (empty($v['arr_childid'])) {//父元素但无子元素 => 单独显示，无下拉菜单
						$html .= '<li';
						if (trim($this->router->class) == $v['controller'] && trim($this->router->method) == $v['method'])
							$html .= ' class="active"';
						$html .= '><a href="' . base_url('') . $v['controller'] . '/' . $v['method'] . '">';
						$html .= '<i class="fa ' . $v['css_icon'] . '"></i><span>' . $v['menu_name'] . '</span>';//显示css_icon和栏目名
					} else {//父元素有子元素 => 下拉菜单样式

						unset($r);//清空子集数组
						foreach (explode(',', $v['arr_childid']) as $whereid) {
							$r[] = $this->get_one("`menu_id`=$whereid");
						}//搜索子集放入$r

						$v['child_display'] = 0;//声明 子集display

						foreach ($r as $rs) {
							if (!empty($rs)) {
								if ($rs['is_display'] == 1) $v['child_display']++;//子集display==1 累加
							}
						}

						if ($v['child_display']) {//子元素 有显示
							$html .= '<li class="treeview';
							if (trim($this->router->class) == $v['controller']) $html .= ' active';
							$html .= '">'."\n".'<a href="#">';
							$html .= '<i class="fa ' . $v['css_icon'] . '"></i><span>' . $v['menu_name'] . '</span>';//显示css_icon和栏目名
							$html .= '<i class="fa fa-angle-left pull-right"></i></a>'."\n";
							$html .= $this->get_child_menu_html($v, $siderinfo, $group_id);
						} else {//子元素都不显示
							$html .= '<li';
							if (trim($this->router->class) == $v['controller'] && trim($this->router->method) == $v['method'])
								$html .= ' class="active"';
							$html .= '>' . '<a href="' . base_url() . $v['controller'] . '/' . $v['method'] . '">';
							$html .= '<i class="fa ' . $v['css_icon'] . '"></i><span>' . $v['menu_name'] . '</span>';
							$html .= '</a></li>'."\n";
						}

					}
					$html .= "\n";
				} else {//不是父元素但独立显示为一栏 无下拉菜单
					$html .= '<li';
					if (trim($this->router->class) == $v['controller'] && trim($this->router->method) == $v['method'])
						$html .= ' class="active"';
					$html .= '>' . '<a href="' . base_url() . $v['controller'] . '/' . $v['method'] . '">';
					$html .= '<i class="fa ' . $v['css_icon'] . '"></i> <span>' . $v['menu_name'] . '</span>';
					$html .= '</a></li>'."\n";
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
	public function get_child_menu_html($v, $siderinfo, $group_id)
	{
		$html = '';
		$html .= '<ul class="treeview-menu">'."\n";
		$v['child_id'] = explode(',', $v['arr_childid']);
		foreach ($v['child_id'] as $child_id) {//{1,2}
			foreach ($siderinfo as $childinfo) {//sideinfo遍历与child_id碰撞
				if ($child_id == $childinfo['menu_id'] && !$childinfo['show_alone']) {
					unset($r);
					foreach (explode(',', $childinfo['arr_childid']) as $whereid) {
						$r[] = $this->get_one("`menu_id`=$whereid");
					}//搜索子集放入$r
					$childinfo['child_display'] = 0;//声明 子集display
					foreach ($r as $rs) {
						if (!empty($rs)) {
							if ($rs['is_display'] == 1) $childinfo['child_display']++;//子集display==1 累加
						}
					}

					if (empty($childinfo['arr_childid']) || !$childinfo['child_display']) {//无子元素|子集不显示 => 单独显示，无下拉菜单
						$html .= '<li';
						if (trim($this->router->class) == $childinfo['controller'] && trim($this->router->method) == $childinfo['method']) $html .= ' class="active"';
						$html .= '>' . '<a href="' . base_url() . $childinfo['controller'] . '/' . $childinfo['method'] . '">';
						$html .= '<i class="fa ' . $childinfo['css_icon'] . '"></i><span>' . $childinfo['menu_name'] . '</span></a>';//显示css_icon和栏目名
					} else {//有子元素 => 下拉菜单样式
						$html .= '<li class="treeview"><a href="#">';
						$html .= '<i class="fa ' . $childinfo['css_icon'] . '"></i><span>' . $childinfo['menu_name'] . '</span>';//显示css_icon和栏目名
						$html .= '<i class="fa fa-angle-left pull-right"></i></a>';
						$html .= $this->get_child_menu_html($childinfo, $siderinfo);
					}
					$html .= '</li>'."\n";

				}
			}
		}
		$html .= '</ul>'."\n";
		return $html;
	}

	/**
	 * ARRAY KEY排序
	 * @param $array
	 * @param $key
	 * @param string $order
	 * @return array
	 */
	function arr_ksort($array, $key, $order = "asc")
	{//asc是升序 desc是降序
		$arr_nums = $arr = array();
		foreach ($array as $k => $v) {
			$arr_nums[$k] = $v[$key];
		}
		if ($order == 'asc') {
			asort($arr_nums);
		} else {
			arsort($arr_nums);
		}
		foreach ($arr_nums as $k => $v) {
			$arr[$k] = $array[$k];
		}

		return $arr;
	}

	/**
	 *  模块修改 table html
	 */
	public function return_menu_html()
	{
		$html = '';
		$siderinfo = $this->select();
		$list_order_arr = $this->arr_ksort($siderinfo, 'list_order');//按照list_order排序后
		foreach ($list_order_arr as $v) {
			if ($v['is_header']) {
				$html .= '<tr><b>';
				$html .= '<td>' . $v['menu_id'] . '</td>';
				$html .= '<td><i class="fa ' . $v['css_icon'] . '" style="padding-right: 6px;"></i>' . $v['menu_name'] . '</td>';
				$html .= '<td>' . $v['list_order'] . '</td>';
				$html .= '<td>' . $v['controller'] . '</td>';
				$html .= '<td>' . $v['method'] . '</td>';
				$html .= '<td>';
				if ($v['is_display']) {
					$html .= '<span class="glyphicon glyphicon-ok text-light-blue" aria-hidden="true"></span>';
				} else {
					$html .= '<span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span>';
				}
				$html .= '</td>';
				$html .= '<td>';
				if ($v['show_alone']) {
					$html .= '<span class="glyphicon glyphicon-ok text-light-blue" aria-hidden="true"></span>';
				} else {
					$html .= '<span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span>';
				}
				$html .= '</td>';
				$html .= '<td><a href="' . base_url('admin/modulemenu') . '_add/menu_id/' . $v['menu_id'] . '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> 添加子栏目</a>
<a href="' . base_url('admin/modulemenu') . '_edit/menu_id/' . $v['menu_id'] . '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-wrench"></span> 修改</a></td>';
				$html .= '</b></tr>';
			}
			if ($v['is_parent']) {
				$html .= '<tr>';
				$html .= '<td>' . $v['menu_id'] . '</td>';
				$html .= '<td style="padding-left: 25px"><i class="fa ' . $v['css_icon'] . '" style="padding-right: 6px;"></i>' . $v['menu_name'] . '</td>';
				$html .= '<td>' . $v['list_order'] . '</td>';
				$html .= '<td>' . $v['controller'] . '</td>';
				$html .= '<td>' . $v['method'] . '</td>';
				$html .= '<td>';
				if ($v['is_display']) {
					$html .= '<span class="glyphicon glyphicon-ok text-light-blue" aria-hidden="true"></span>';
				} else {
					$html .= '<span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span>';
				}
				$html .= '</td>';
				$html .= '<td>';
				if ($v['show_alone']) {
					$html .= '<span class="glyphicon glyphicon-ok text-light-blue" aria-hidden="true"></span>';
				} else {
					$html .= '<span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span>';
				}
				$html .= '</td>';
				$html .= '<td><a href="' . base_url('admin/modulemenu') . '_add/menu_id/' . $v['menu_id'] . '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> 添加子栏目</a>
<a href="' . base_url('admin/modulemenu') . '_edit/menu_id/' . $v['menu_id'] . '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-wrench"></span> 修改</a></td>';
				$html .= '</tr>';

				if (!empty($v['arr_childid'])) {
					$html .= $this->get_child_module_html($v, $siderinfo);
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
	public function get_child_module_html($v, $siderinfo, $tab = 25)
	{
		$html = '';
		$tab += 20;
		$v['child_id'] = explode(',', $v['arr_childid']);
		foreach ($v['child_id'] as $child_id) {
			foreach ($siderinfo as $child_info) {
				if ($child_id == $child_info['menu_id']) {
					$html .= '<tr>';
					$html .= '<td>' . $child_info['menu_id'] . '</td>';
					$html .= '<td style="padding-left: ' . $tab . 'px"><i class="fa ' . $child_info['css_icon'] . '" style="padding-right: 5px;"></i>' . $child_info['menu_name'] . '</td>';
					$html .= '<td>' . $child_info['list_order'] . '</td>';
					$html .= '<td>' . $child_info['controller'] . '</td>';
					$html .= '<td>' . $child_info['method'] . '</td>';
					$html .= '<td>';
					if ($child_info['is_display']) {
						$html .= '<span class="glyphicon glyphicon-ok text-light-blue" aria-hidden="true"></span>';
					} else {
						$html .= '<span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span>';
					}
					$html .= '</td>';
					$html .= '<td>';
					if ($child_info['show_alone']) {
						$html .= '<span class="glyphicon glyphicon-ok text-light-blue" aria-hidden="true"></span>';
					} else {
						$html .= '<span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span>';
					}
					$html .= '</td>';
					$html .= '<td><a href="' . base_url('admin/modulemenu') . '_add/menu_id/' . $child_info['menu_id'] . '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> 添加子栏目</a>
<a href="' . base_url('admin/modulemenu') . '_edit/menu_id/' . $child_info['menu_id'] . '" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-wrench"></span> 修改</a></td>';
					$html .= '</tr>';
					if (!empty($child_info['arr_childid'])) {
						$html .= $this->get_child_module_html($child_info, $siderinfo, $tab);
					}
				}
			}
		}
		return $html;
	}

	/**
	 * 获取页面信息
	 */
	public function get_current_page_info()
	{
		$page_data['controller'] = trim($this->router->class);
		$page_data['method'] = trim($this->router->method);
		$current_pageinfo = $this->get_one($page_data);
		if (!empty($current_pageinfo)) {//模块未录入时不加载
			$arr = '';
			$arr .= $current_pageinfo['menu_name'] . ',';
			$arr .= $current_pageinfo['description'] . ',';
			$arr .= $current_pageinfo['controller'] . ',';
			$arr .= $current_pageinfo['method'] . ',';
			$arr .= $current_pageinfo['parent_id'];
			//检测父ID是否为本身
			if ($current_pageinfo['parent_id'] == $current_pageinfo['menu_id']) {

			} else {
				$arr .= $this->get_current_page_info_child($current_pageinfo);
			}

			$newarr = explode('|', $arr);
			foreach ($newarr as $v) {
				$arr_pageinfo[] = explode(',', $v);
			}

			return $arr_pageinfo;
		}


	}

	/**
	 * 获取页面信息 子集
	 */
	public function get_current_page_info_child($current_pageinfo)
	{
		$arr = '';
		if ($current_pageinfo['parent_id'] == $current_pageinfo['menu_id']) {

		} else {
			foreach ($this->select() as $v) {
				if ($v['menu_id'] == $current_pageinfo['parent_id']) {//碰撞父元素
					$arr .= '|';
					$arr .= $v['menu_name'] . ',';
					$arr .= $v['description'] . ',';
					$arr .= $v['controller'] . ',';
					$arr .= $v['method'] . ',';
					$arr .= $v['parent_id'];
					if ($v['parent_id'] == $v['menu_id']) {

					} else {
						$arr .= $this->get_current_page_info_child($v);
					}

				}
			}
			return $arr;
		}
	}

	/**
	 * Page header html输出
	 */
	public function get_page_header_html()
	{
		$current_page_info = $this->get_current_page_info();
		if (isset($current_page_info)) {//模块未录入时不加载
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

			$html .= '</ol>';
			$html .= '</section>';
			return $html;
		}
		return false;
	}

}
