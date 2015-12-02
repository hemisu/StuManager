<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_group_priv_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'user_group_priv';
		parent::__construct();

	}
}
