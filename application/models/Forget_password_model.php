<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forget_password_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'forget_password';
		parent::__construct();
		//======载入模块======
	}

}
