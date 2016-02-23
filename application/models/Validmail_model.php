<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Validmail_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'validmail';
		parent::__construct();
		//======载入模块======
	}

}
