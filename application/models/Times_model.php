<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Times_model extends Base_Model {
	public function __construct()
	{
		$this->table_name = 'stu_user';
		parent::__construct();
	}
}