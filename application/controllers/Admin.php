<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Login_Controller {

	function __construct()
	{
		parent::__construct();
	}
	/**
	 * 内容管理-公告-列表
	 * announce
	 *
	 */
	public function announce($page_now = 1)
	{
		$page_now = max(intval($page_now),1);

		$this->page_data['announcelist']=$this->Announce_model->announce_list_html($page_now);
		$this->page_data['announcelistpage']=$this->Announce_model->pages;

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_announce',$this->page_data);
	}
	/**
	 * 内容管理-公告-添加
	 * announce_add
	 *
	 */
	public function announce_add()
	{
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_announce_add');
	}
	public function announce_add_post(){
		if($this->input->is_ajax_request()){
			$data=array();
			$data['title'] = $title = $this->input->post('title');
			$data['level'] = $level = $this->input->post('level');
			$data['date'] = $level = $this->input->post('date');
			$data['content'] = $content = $this->input->post('content');
			$this->Announce_model->insert($data);

			echo json_encode(array('title'=>$title,'level'=>$level,'content'=>$content,'next_url'=>base_url('admin/announce')));
		}else{
			redirect(base_url('admin/announce'));
		}
	}
	/**
	 * 内容管理-公告-修改
	 * announce_edit
	 *
	 */
	public function announce_edit()
	{
		$array = $this->uri->uri_to_assoc(3);
		$announce_id=$array['announce_id'];
		$this->page_data['announce'] = $this->Announce_model->select("`id`=$announce_id")[0];
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_announce_edit');
	}
	public function announce_edit_post()
	{
		if($this->input->is_ajax_request()){
			$array = $this->uri->uri_to_assoc(3);
			$announce_id=$array['announce_id'];
			$data=array();
			$data['title'] = $title = $this->input->post('title');
			$data['level'] = $level = $this->input->post('level');
			$data['date'] = $level = $this->input->post('date');
			$data['content'] = $content = $this->input->post('content');
			$this->Announce_model->update($data,"`id`=$announce_id");

			echo json_encode(array('title'=>$title,'level'=>$level,'content'=>$content,'next_url'=>base_url('admin/announce')));
		}else{
			redirect(base_url('admin/announce'));
		}
	}
	/**
	 * 内容管理-公告-删除
	 * announce_delete
	 *
	 */
	public function announce_delete()
	{
		$array = $this->uri->uri_to_assoc(3);
		$announce_id=$array['announce_id'];
		$this->Announce_model->delete("`id`=$announce_id");
		redirect(base_url('admin/announce'));
	}

	/**
	 * 系统管理-侧栏-列表
	 * modulemenu
	 *
	 */
	public function moduleMenu()
	{

		$this->page_data['modulelist']=$this->Module_menu_model->return_menu_html();

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_modulemenu',$this->page_data);
	}
	/**
	 * 系统管理-侧栏-添加
	 * modulemenu
	 *
	 */
	public function modulemenu_add()
	{
		$array = $this->uri->uri_to_assoc(3);
		$menu_id=$array['menu_id'];
		$this->page_data['menu_info']=$this->Module_menu_model->select();
		$this->page_data['father_menu_info']=$this->Module_menu_model->select("`menu_id`=$menu_id")[0];
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_modulemenu_add',$this->page_data);
	}
	public function modulemenu_add_post()
	{
		if($this->input->is_ajax_request()){
			$array = $this->uri->uri_to_assoc(3);
			$menu_id=$array['menu_id'];
			$data=array();
			$data['menu_name']  = $this->input->post('menu_name');
			$data['list_order']  = $this->input->post('list_order');
			$data['css_icon']  = $this->input->post('css_icon');
			$data['is_parent']  = $this->input->post('is_parent');
			$data['is_display'] = $this->input->post('is_display');
			$data['show_alone']  = $this->input->post('show_alone');
			$data['is_header'] = $this->input->post('is_header');
			$data['arr_childid'] = $this->input->post('arr_childid');
			$data['controller'] = $this->input->post('controller');
			$data['method']  = $this->input->post('method');
			$data['parent_id']  = $menu_id;


			$this->Module_menu_model->insert($data);
			$newid = $this->Module_menu_model->insert_id();//插入的menu_id

			$parent_info=$this->Module_menu_model->select("`menu_id`=$menu_id")[0];//获取父级信息
			if(!$parent_info['is_parent']){$parent_info['is_parent']=1;}
			if(empty($parent_info['arr_childid'])) {
				$parent_info['arr_childid'] = $newid;
			}else{
				$parent_info['arr_childid'] .= ','.$newid;
			}
			$this->Module_menu_model->update($parent_info,"`menu_id`=$menu_id");


			echo json_encode(array('data'=>$parent_info,'next_url'=>base_url('admin/modulemenu')));
		}else{
			redirect(base_url('admin/modulemenu'));
		}
	}
	/**
	 * 系统管理-侧栏-修改
	 * modulemenu
	 *
	 */
	public function modulemenu_edit()
	{
		$array = $this->uri->uri_to_assoc(3);
		$menu_id=$array['menu_id'];
		$this->page_data['menu_info']=$this->Module_menu_model->select();
		$this->page_data['father_menu_info']=$this->Module_menu_model->select("`menu_id`=$menu_id")[0];
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_modulemenu_edit',$this->page_data);
	}
	public function modulemenu_edit_post()
	{
		if($this->input->is_ajax_request()){
			$array = $this->uri->uri_to_assoc(3);
			$menu_id=$array['menu_id'];
			$data=array();
			$data['menu_name']  = $this->input->post('menu_name');
			$data['css_icon']  = $this->input->post('css_icon');
			$data['is_parent']  = $this->input->post('is_parent');
			$data['is_display'] = $this->input->post('is_display');
			$data['show_alone']  = $this->input->post('show_alone');
			$data['is_header'] = $this->input->post('is_header');
			$data['arr_childid'] = $this->input->post('arr_childid');
			$data['controller'] = $this->input->post('controller');
			$data['method']  = $this->input->post('method');
			$this->Module_menu_model->update($data,"`menu_id`=$menu_id");

			echo json_encode(array('next_url'=> base_url('admin/modulemenu')));
		}else{
			redirect(base_url('admin/modulemenu'));
		}
	}
	/**
	 * 用户管理-基本信息库
	 * user_library
	 *
	 */
	public function user_library(){
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_library',$this->page_data);
	}
	/**
	 * 用户管理-信息以json格式输出
	 */
	public function user_library_json(){
		$userinfo = $this->User_model->select('','`username`,`student_id`,`email`,`qq`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`');
		echo json_encode($userinfo);
	}
	/**
	 * 系统管理-用户管理-用户组管理-用户组列表
	 */
	public function user_group_list()
	{

		$this->page_data['group_list_html']=$this->User_group_model->return_group_list_html();

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_group_list',$this->page_data);
	}
	/**
	 * 系统管理-用户管理-用户组管理-用户组添加
	 */
	public function user_group_add()
	{

		$this->page_data['group_list_html']=$this->User_group_model->return_group_list_html();

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_group_add',$this->page_data);
	}
	public function user_group_add_post()
	{
		if(!$this->input->is_ajax_request()) exit(json_encode(array('response'=>'error')));

		$data=array();
		$data['group_id']  = $this->input->post('group_id');
		$data['group_name']  = $this->input->post('group_name');
		$data['description']  = $this->input->post('description');

		$this->User_group_model->insert($data);

		echo json_encode(array('next_url'=> base_url('admin/user_group_list')));
	}
	/**
	 * 系统管理-用户管理-用户组管理-用户组修改
	 */
	public function user_group_edit()
	{
		$array = $this->uri->uri_to_assoc(3);
		$group_id=$array['group_id'];
		$this->page_data['group_info']=$this->User_group_model->get_one("`group_id`=$group_id");
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_group_edit',$this->page_data);
	}
	public function user_group_edit_post()
	{
		if(!$this->input->is_ajax_request()) exit(json_encode(array('response'=>'error')));

		$data=array();
		$group_id  = $this->input->post('group_id');
		$data['group_name']  = $this->input->post('group_name');
		$data['description']  = $this->input->post('description');

		$this->User_group_model->update($data,"`group_id`=$group_id");

		echo json_encode(array('next_url'=> base_url('admin/user_group_list')));
	}
	/**
	 * 系统管理-用户管理-用户组管理-用户组删除
	 */
	public function user_group_delete()
	{
		$array = $this->uri->uri_to_assoc(3);
		$group_id=$array['group_id'];
		$this->User_group_model->delete("`group_id`=$group_id");
		redirect(base_url('admin/user_group_list'));
	}
	/**
	 * 系统管理-用户管理-用户组管理-用户组权限编辑
	 * modulemenu
	 *
	 */
	public function user_group_priv()
	{
		$array = $this->uri->uri_to_assoc(3);
		$group_id=$array['group_id'];
		$this->page_data['group_priv_list']=$this->User_group_model->return_user_group_priv_html($group_id);

		$this->page_data['group_priv_info']=$this->User_group_priv_model->select("`group_id`=$group_id");

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_group_priv',$this->page_data);
	}
	public function user_group_priv_post()
	{
		$group_id=$this->input->post('group_id');

		$post=$this->input->post('prv');//提交的数组 menu_id
		$exist=array();
		foreach($this->User_group_priv_model->select("`group_id`=$group_id") as $existlist){
			$exist[$existlist['menu_id']]=$existlist['menu_id'];//存在的数组 menu_id
		}

		if(!empty($exist)){//原先存在 删除多余的
			foreach($exist as $ex){
				$i=0;
				foreach($post as $po){
					if($ex==$po)$i++;//对存在的进行轮询 不存在则删除
				}
				if(!$i)$this->User_group_priv_model->delete("`menu_id`=$ex");//删除操作 where menu_id =$ex
			}
		}
		if(!empty($post)){
			foreach($post as $k=>$po){
				$i=0;
				foreach($exist as $ex) {
					if ($ex == $po) $i++;//对提交的进行轮询
				}
				$moduleinfo=$this->Module_menu_model->get_one("`menu_id`=$k");
				$data=array('group_id'=>$group_id,
				'controller'=>$moduleinfo['controller'],
				'method'=>$moduleinfo['method'],
				'menu_id'=>$k
				);
				if(!$i)$this->User_group_priv_model->insert($data);//插入操作
			}
		}

		redirect(base_url('admin/user_group_priv/group_id').'/'.$group_id);
	}


}
