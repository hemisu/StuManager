<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_times_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'login_times';
		parent::__construct();
	}
}
