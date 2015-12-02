<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Module_menu_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'module_menu';
		parent::__construct();
	}

	
}
