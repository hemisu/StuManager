<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announce_model extends Base_Model {
	public function __construct()
	{
		$this->table_name = 'announce';
		$this->page_size = 20;
		parent::__construct();
	}
	public function announce_dashboard_html()
	{
		$html = '';
		$list = $this->select('','*','5','list_order ASC, date DESC');
		foreach($list as $key=>$val){
			$html.='<div class="panel box box-'.$val['level'].'">';
			$html.='<div class="box-header with-border">';
			$html.='<h4 class="box-title">';
			$html.='<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$key.'">';
			$html.=$val['title'];
			$html.='</a></h4></div>';
			$html.='<div id="collapse'.$key.'" class="panel-collapse collapse ';
			if(!$key)$html.='in';
			$html.='">';
			$html.='<div class="box-body">';
			$html.=$val['content'];
			$html.='</div></div></div>';
		}
		return $html;
	}
	public function announce_list_html($page_now = 1)
	{
		$html = '';
		$list = $this->listinfo('','*','date DESC' , $page_now, $this->page_size,'',$this->page_size,page_list_url('admin/announce',true));
		foreach($list as $key=>$val){
			$html.='<tr>';
			$html.='<td>'.$key.'.</td>';
//			$html.='<td>'.$val['list_order'].'</td>';
			$html.='<td>'.$val['title'].'</td>';
			$html.='<td>'.$val['date'].'</td>';
			$html.='<td><span class="btn btn-xs btn-'.$val['level'].'">'.$val['level'].'</span></td>';
			$html.='<td><a href="'.base_url('admin/announce_edit').'/announce_id/'.$val['id'].'" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
			<a data-deleteid="'.$val['id'].'" class="btn bg-red color-palette btn-sm"><i class="fa fa-trash"></i> 删除 </a></td>';
		}
		return $html;
	}

}
?>