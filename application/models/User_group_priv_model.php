<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_role_priv_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'user_role_priv';
		parent::__construct();

	}
}
