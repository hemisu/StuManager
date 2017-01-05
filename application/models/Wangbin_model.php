<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wangbin_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'wangbin';
		parent::__construct();

		//======载入模块======
	}
	public function overview_html($where = ''){
		$html = '';
		if(isset($where)){
			$info = $this->select($where);
		}else{
			$info = $this->select();
		}

//		$INDEX = 1;
		foreach($info as $v){
			$html .= '<tr>';
			$html .= '<td>'.$v['student_id'].'</td>';
			$html .= '<td>'.$v['username'].'</td>';
			$html .= '<td>'.$v['classes'].'</td>';
			$html .= '<td>'.$v['l_phone'].'</td>';
			$html .= '<td>'.$v['s_phone'].'</td>';
			$html .= '<td>'.$v['instructor'].'</td>';
			$html .= '<td>'.$v['signdate'].'</td>';
			$html .= '<td>'.$v['company'].'</td>';
			$html .= '<td>'.$v['remarks'].'</td>';
			$html .= '</tr>';
		}
		return $html;
	}
	public function byteacher($where){
		$html = '';
		$teacherinfo = $this->select($where , $data = '`instructor`', $limit = '', $order = '', $group = '`instructor`', $key='');
//		$INDEX = 1;
//		print_r($teacherinfo);
		foreach($teacherinfo as $v){
			$info = $this->select(array("instructor"=>$v['instructor']));
//			print_r($info);
			$v['count'] = $v['company_count'] = $v['persent'] = 0;//总人数、就业人数、就业率
			foreach($info as $b){
				$v['count'] = count($info);
				if(!empty($b['company'])){
					$v['company_count'] = $v['company_count'] + 1 ;
				}else{

				}
			}
			$v['persent'] = $v['company_count']/$v['count'];
			$html .= '<tr>';
			$html .= '<td><a href="'.base_url('wangbin/byteacher?teacher='.$v['instructor']).'"> '.$v['instructor'].'</a></td>';
			$html .= '<td>'.$v['count'].'</td>';
			$html .= '<td>'.$v['company_count'].'</td>';
			$html .= '<td>'.round($v['persent']*100, 2).'%</td>';
			$html .= '</tr>';
		}
		return $html;
	}
	public function byclasses($where){
		$html = '';
		$teacherinfo = $this->select($where , $data = '`classes`', $limit = '', $order = '', $group = '`classes`', $key='');
//		$INDEX = 1;
//		print_r($teacherinfo);
		foreach($teacherinfo as $v){
			$info = $this->select(array("classes"=>$v['classes']));
//			print_r($info);
			$v['count'] = $v['company_count'] = $v['persent'] = 0;//总人数、就业人数、就业率
			foreach($info as $b){
				$v['count'] = count($info);
				if(!empty($b['company'])){
					$v['company_count'] = $v['company_count'] + 1 ;
				}else{

				}
			}
			$v['persent'] = $v['company_count']/$v['count'];
			$html .= '<tr>';
			$html .= '<td>'.$v['classes'].'</td>';
			$html .= '<td>'.$v['count'].'</td>';
			$html .= '<td>'.$v['company_count'].'</td>';
			$html .= '<td>'.round($v['persent']*100, 2).'%</td>';
			$html .= '</tr>';
		}
		return $html;
	}
}
