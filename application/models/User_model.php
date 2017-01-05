<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends Base_Model {

	var $page_size = 10;
	public function __construct() {
		$this->table_name = 'user';
		parent::__construct();
	}
	/*
	 * 判断$student_id是否存在
	 * return num
	 */
	function check_student_exists($student_id)
	{
		$c = $this->count("`student_id` ='".$student_id."'");
		return $c;
	}
	/*
	 * 判断$student_id是否存在
	 * return bool
	 */
	function check_student_id($student_id)
	{
		$c = $this->count("`student_id` ='".$student_id."'");
		if(!$c){return false;}
		else{return true;}
	}
	function check_password($student_id,$password){
		$r = $this->User_model->get_one("`student_id`=$student_id");
		$password = md5($password.$r['salt']);
		if($r['password']==$password){
			$isAvailable = true;
		}else{
			$isAvailable = false;
		}
		return $isAvailable;
	}
	function salt_password($student_id,$password){
		$r = $this->User_model->get_one("`student_id`=$student_id");
		$password = md5($password.$r['salt']);
		return $password;
	}
	function classes(){
		$classesarr=$this->select('','`classes`','','','classes');
		return $classesarr;
	}
	/*
	 * 根据ID返回姓名、班级
	 */
	function username_classes($student_id){
		$username=$this->get_one(array('student_id'=>$student_id),'`username`,`classes`');
		return $username;
	}

	
}
