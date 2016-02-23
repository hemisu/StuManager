<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Database_bak_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'database_bak';
		parent::__construct();
		//======载入模块======
	}
	public function html_database_bac_list(){
		$html = '';
		$r = $this->select();
		$INDEX = 0;
		foreach($r as $v){
			$html .= '<tr>';
			$html .= '<td>'.$INDEX++.'</td>';
			$html .= '<td>'.$v['bakname'].'</td>';
			$html .= '<td>'.$v['bakdate'].'</td>';
			$html .= '<td><a href="' .base_url("public/bak/".$v['bakname']). '" class="btn btn-xs btn-primary">下载</a> <a href="'.base_url("admin/database_bak_del/".$v['id'].'/'.$v['valid']) .'" class="btn btn-xs btn-danger">删除</a></td>';
		}
		return $html;
	}
}
