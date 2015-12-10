<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_ranktest_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'user_ranktest';
		parent::__construct();
	}
}
