<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	public $stu_status;
	public $stu_task;
	protected $page_data = array(
		'module_name' => '',
		'controller_name' => '',
		'method_name' => '',
	);
	function __construct(){
		parent::__construct();
		$this->config->load('stu');
		$this->stu_status = $this->config->item('stu_status');
		$this->stu_task = $this->config->item('stu_task');
	}

}
class Base_Controller extends MY_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('User_model','User_score_model','User_ranktest_model',
			'Announce_model','Module_menu_model'));
		$this->load->helper('url');
		$this->load->library('tree','session');
	}
	/**
	 * 错误信息显示
	 * @param $msg
	 * @param string $url_next
	 * @param string $url_forward
	 * @param int $s
	 * @param string $dialog
	 */
	protected function showmessage($msg, $next_url = '',$s = 2, $dialog = '') {

		if($next_url=='')$next_url=$_SERVER['HTTP_REFERER'];//获取当前链接的上一个连接的来源地址

		$pagedata = array("msg"=>$msg,"next_url"=>$next_url,"s"=>$s,"dialog"=>$dialog);

		echo $this->load->view('errors/html/error_message',$pagedata,true);

		exit;
	}
}
class Login_Controller extends MY_Controller
{
	function __construct(){
		parent::__construct();
		//======载入模块======
		$this->load->model(array('User_model','User_score_model','User_ranktest_model',
			'Announce_model','Module_menu_model',
			'User_group_priv_model','User_group_model'));
		$this->load->helper('url');
		$this->load->library('tree','session');
		//======载入session======
		$this->student_id = $this->session->userdata('student_id');
		//======页面信息======
		$this->page_data['controller_name']= trim($this->router->class);
		$this->page_data['method_name']= trim($this->router->method);

		$this->check_member();//判断登陆并传递当前页面的值
		$this->check_priv();//判断是否有权限

		$this->page_data['sider_ul_list'] = $this->Module_menu_model->sider_html($this->group_id);//侧栏信息
		$this->page_data['pageheader'] = $this->Module_menu_model->get_page_header_html();//本页面信息
		$this->page_data['pageheaderinfo'] = $this->Module_menu_model->get_current_page_info();
//		$this->Module_menu_model->get_menu_active();


	}
	/**
	 * 判断用户是否已经登陆
	 */
	protected function check_member() {

		$userinfo = $this->User_model->get_one(array('student_id'=>"$this->student_id"));
		if(!$userinfo)
		{
			$_SESSION['url_forward'] = 'http://'.$_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
			$this->showmessage('请您重新登录',base_url('login'));
			echo $this->student_id;
			exit(0);
		}else{
			$this->page_data['userinfo'] = $userinfo;//获取用户信息
			$this->group_id = $userinfo['group_id'];
			return $this->group_id;
		}
	}
	/**
	 * 错误信息显示
	 * @param $msg
	 * @param string $msg
	 * @param string $next_url
	 * @param int $s
	 * @param string $dialog
	 */
	protected function showmessage($msg, $next_url = '',$s = 2, $dialog = '') {

		if($next_url=='')$next_url=$_SERVER['HTTP_REFERER'];//获取当前链接的上一个连接的来源地址

		$pagedata = array("msg"=>$msg,"next_url"=>$next_url,"s"=>$s,"dialog"=>$dialog);

		echo $this->load->view('errors/html/error_message',$pagedata,true);

		exit;
	}
	/**
	 * 权限检测
	 */
	protected function check_priv()
	{
		if($this->group_id == SUPERADMIN_GROUP_ID) return true;
		if((strtolower($this->page_data['method_name'])=="index"&&strtolower($this->page_data['controller_name'])=="dashboard")) return true;//控制台

		// 用户组权限数据库中搜索权限
		$r =$this->User_group_priv_model->get_one(array('method'=>$this->page_data['method_name'],
			'controller'=>$this->page_data['controller_name'] ,
			'group_id'=>$this->group_id ));
		if(!$r) $this->showmessage('您没有权限操作该项','');
	}
	/**
	 * 返回group_id
	 */
	public function get_group_id(){
		return $this->group_id;
	}

}