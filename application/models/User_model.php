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
	
	function quick_register($username,$password,$encrypt='',$mobileno='')
	{
		if(!$this->check_username_exists($username))
		{
			$password = md5(md5($password.$encrypt));
			$newid = $this->insert(array('group_id'=>REGISTER_GROUP_ID,'mobile'=>$mobileno,'username'=>$username,'password'=>$password,'reg_ip'=>$this->input->ip_address(),'reg_time'=>date('Y-m-d H:i:s'),'encrypt'=>$encrypt,'last_login_ip'=>$this->input->ip_address(),'last_login_time'=>date('Y-m-d H:i:s'),'created'=>date('Y-m-d H:i:s'),'modified'=>date('Y-m-d H:i:s'),'is_seller'=>0));
			
			return $newid;
		}
		return 0;
	}
	
	function quick_changpwd($username,$password,$encrypt='',$mobileno='')
	{
		if($this->check_username_exists($username))
		{
			$password = md5(md5($password.$encrypt));
			$status = $this->update(array('encrypt'=>$encrypt,'password'=>$password,'modified'=>date('Y-m-d H:i:s')),array('username'=>$username));
			
			return $status;
		}
		return 0;
	}
	
	function default_info(){
		return array(
					'user_id'=>0,
					'username'=>'',
					'email'=>'',
					'password'=>'',
					'mobile'=>'',
					'fullname'=>'',
					'avatar'=>'nopic.gif',
					'group_id'=>0,
					'is_lock'=>false,
					);
	}
	
}
