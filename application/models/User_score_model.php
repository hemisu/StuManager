<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_score_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'user_score';
		parent::__construct();
	}
}
