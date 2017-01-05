<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$this->showmessage('一片荒芜。。');
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
		if($this->input->is_ajax_request()){
			$data=array();
			$data['title'] = $title = $this->input->post('title');
			$data['level'] = $level = $this->input->post('level');
			$data['date'] = $level = $this->input->post('date');
			$data['content'] = $content = $this->input->post('content');
			$this->Announce_model->insert($data);

			exit(json_encode(array('title'=>$title,'level'=>$level,'content'=>$content,'next_url'=>base_url('admin/announce'))));
		}
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_announce_add');
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
		if($this->input->is_ajax_request()){
			$data=array();
			$data['title'] = $title = $this->input->post('title');
			$data['level'] = $level = $this->input->post('level');
			$data['date'] = $level = $this->input->post('date');
			$data['content'] = $content = $this->input->post('content');
			$this->Announce_model->update($data,"`id`=$announce_id");

			exit(json_encode(array('title'=>$title,'level'=>$level,'content'=>$content,'next_url'=>base_url('admin/announce'))));
		}
		$this->page_data['announce'] = $this->Announce_model->get_one("`id`=$announce_id");
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_announce_edit');
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
	 * 内容管理-事项
	 * task_list
	 */
	public function task_list($page_now=1)
	{
		$page_now = max(intval($page_now),1);

		$this->page_data['task_list']=$this->Task_title_model->admin_task_list_html($page_now);
		$this->page_data['task_list_page']=$this->Task_title_model->pages;

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_task_list',$this->page_data);
	}
	/**
	 * 内容管理-事项-添加
	 * task_list_add
	 *
	 */
	public function task_list_add()
	{
		if($this->input->is_ajax_request()){
//			$data=array();
//			$this->Announce_model->insert($data);
			$data['title'] = $title = $this->input->post('title');
			$data['group_id'] = $this->input->post('group_id');
			$data['cate'] = $this->input->post('cate');
			$data['posttime'] = $this->input->post('posttime');
			$data['deadtime'] = $this->input->post('deadtime');
			$data['progress'] = $this->input->post('progress');
			$data['status'] = $this->input->post('status');
			$data['author'] = $this->input->post('author');
			$data['description'] = $description = $this->input->post('description');

			$insert_id = $this->Task_title_model->insert($data);

			if($this->input->post('sent_mail_to')){
				if(isset($data['group_id'])){
					$arr=explode(',',$data['group_id']);
					foreach($arr as $group_id){
						$userlist[]=$this->User_model->select(array('group_id'=>$group_id),'`student_id`,`email`,`group_id`');
					}
				}
				$email = '';
				foreach($userlist as $c){
					foreach($c as $d) {
						if(empty($email)){
							$email = $d['email'];
						}else{
							$email .= ','.$d['email'];
						}
					}
				}

//				print_r($userlist);
//echo $email;
				$response = $this->sent_email($email, "【StuManager】新事项：$title", "$description 查看<a href='".base_url('task/detail/task_id/'.$insert_id)."'>点击链接</a>", base_url('admin/task_list'));
			}
			exit(json_encode(array('next_url'=>base_url('admin/task_list'),'response'=> $response)));
		}
		$this->page_data['group_select']=$this->User_group_model->get_user_gruop_select();
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_task_list_add');
	}
	/**
	 * 内容管理-事项-修改
	 * task_list_edit
	 *
	 */
	public function task_list_edit()
	{
		$array = $this->uri->uri_to_assoc(3);
		$task_id=$array['task_id'];
		if($this->input->is_ajax_request()){
			$data=$this->input->post();
			unset($data['_wysihtml5_mode']);

			$this->Task_title_model->update($data,"`task_id`=$task_id");

			exit(json_encode(array($data,'next_url'=>base_url('admin/task_list'))));
		}
		$this->page_data['task'] = $this->Task_title_model->get_one("`task_id`=$task_id");
		$this->page_data['group_select']=$this->User_group_model->get_user_gruop_selected($this->page_data['task']['group_id']);
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_task_list_edit');
	}
	/**
	 * 内容管理-事项-删除
	 * task_list_delete
	 *
	 */
	public function task_list_delete()
	{
		$array = $this->uri->uri_to_assoc(3);
		$task_id=$array['task_id'];
		$this->Task_title_model->delete("`task_id`=$task_id");
		redirect(base_url('admin/task_list'));
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
			if(empty($parent_info['arr_childid'])) {
				$parent_info['arr_childid'] = $newid;
			}else{
				$parent_info['arr_childid'] .= ','.$newid;
			}
			$this->Module_menu_model->update($parent_info,"`menu_id`=$menu_id");


			exit(json_encode(array('data'=>$parent_info,'next_url'=>base_url('admin/modulemenu'))));
		}
		$array = $this->uri->uri_to_assoc(3);
		$menu_id=$array['menu_id'];
		$this->page_data['menu_info']=$this->Module_menu_model->select();
		$this->page_data['father_menu_info']=$this->Module_menu_model->select("`menu_id`=$menu_id")[0];
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_modulemenu_add',$this->page_data);
	}
	/**
	 * 系统管理-侧栏-修改
	 * modulemenu
	 *
	 */
	public function modulemenu_edit()
	{
		if($this->input->is_ajax_request()) {
			$array = $this->uri->uri_to_assoc(3);
			$menu_id = $array['menu_id'];
			$data = array();
			$data['menu_name'] = $this->input->post('menu_name');
			$data['css_icon'] = $this->input->post('css_icon');
			$data['is_parent'] = $this->input->post('is_parent');
			$data['is_display'] = $this->input->post('is_display');
			$data['show_alone'] = $this->input->post('show_alone');
			$data['is_header'] = $this->input->post('is_header');
			$data['arr_childid'] = $this->input->post('arr_childid');
			$data['controller'] = $this->input->post('controller');
			$data['method'] = $this->input->post('method');
			$this->Module_menu_model->update($data, "`menu_id`=$menu_id");

			exit(json_encode(array('next_url' => base_url('admin/modulemenu'))));
		}
		$array = $this->uri->uri_to_assoc(3);
		$menu_id=$array['menu_id'];
		$this->page_data['menu_info']=$this->Module_menu_model->select();
		$this->page_data['father_menu_info']=$this->Module_menu_model->select("`menu_id`=$menu_id")[0];
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_modulemenu_edit',$this->page_data);
	}

	/**
	 * 用户管理-默认页
	 */
	public function user(){
		redirect(base_url('admin/user_library'));
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
		$userinfo = $this->User_model->select('','`username`,`student_id`,`email`,`qq`,`classes`,`long_phone`,`short_phone`,`card_id`,`zzmm`,`mz`,`jg`,`qinshi`,`address`,`group_id`,`lastLoginTime_temp`');
		foreach($userinfo as $v){
			$v['group_name']=$this->User_group_model->get_user_gruop_name($v['group_id']);
			$userinfos[]=$v;
		}
		echo json_encode($userinfos);
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
		if($this->input->is_ajax_request()){
			$data=array();
			$data['group_id']  = $this->input->post('group_id');
			$data['group_name']  = $this->input->post('group_name');
			$data['description']  = $this->input->post('description');

			$this->User_group_model->insert($data);

			exit(json_encode(array('next_url'=> base_url('admin/user_group_list'))));
		}
		$this->page_data['group_list_html']=$this->User_group_model->return_group_list_html();

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_group_add',$this->page_data);
	}
	/**
	 * 系统管理-用户管理-用户组管理-用户组修改
	 */
	public function user_group_edit()
	{
		if($this->input->is_ajax_request()){
			$data=array();
			$group_id  = $this->input->post('group_id');
			$data['group_name']  = $this->input->post('group_name');
			$data['description']  = $this->input->post('description');

			$this->User_group_model->update($data,"`group_id`=$group_id");

			exit(json_encode(array('next_url'=> base_url('admin/user_group_list'))));
		}
		$array = $this->uri->uri_to_assoc(3);
		$group_id=$array['group_id'];
		$this->page_data['group_info']=$this->User_group_model->get_one("`group_id`=$group_id");
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_group_edit',$this->page_data);
	}
	public function user_group_edit_post()
	{

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
		if($this->input->is_ajax_request()){
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
			exit(json_encode(array('next_url'=> base_url('admin/user_group_list'))));
		}

		$array = $this->uri->uri_to_assoc(3);
		$group_id=$array['group_id'];
		$this->page_data['group_priv_list']=$this->User_group_model->return_user_group_priv_html($group_id);

		$this->page_data['group_priv_info']=$this->User_group_priv_model->select("`group_id`=$group_id");

		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_group_priv',$this->page_data);
	}
	/**
	 * 用户管理-添加新用户
	 * user_add
	 *
	 */
	public function user_add(){
		if($this->input->is_ajax_request()){
			$data=$this->input->post();
			$data['password']=md5($data['password'].$data['salt']);
			$this->User_model->insert($data);
			exit(json_encode(array('data'=> $data,'next_url'=> base_url('admin/user_library')))) ;
		}
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_add',$this->page_data);
	}
	/**
	 * 用户管理-编辑用户
	 * user_edit
	 *
	 */
	public function user_edit($student_id = ''){
		if($this->input->is_ajax_request()){
			$data=$this->input->post();
			if($data['password']==$this->User_model->get_one("`student_id`='$student_id'")['password']){//如果密码未改变
				unset($data['password']);//弹出密码
			}else{
				$data['password']=md5($data['password'].$data['salt']);
			}
			$this->User_model->update($data,"`student_id`='$student_id'");
			exit(json_encode(array('data'=> $data,'next_url'=> base_url('admin/user_library')))) ;
		}
		$this->page_data['edituserinfo'] = $this->User_model->get_one("`student_id`='$student_id'");//获取被编辑的用户信息
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_user_edit',$this->page_data);
	}
//	public function saltpass(){
//		$password = '888888';
//		for($i=371;$i<=410;$i++){
//			$r=$this->User_model->get_one("`id`=$i");
//			$p=md5($password.$r['salt']);
//			echo $p.'<br>';
//			$this->User_model->update(array('password'=>$p),"`id`=$i");
//			echo '<li>'.$salt[$i]=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM)).'</li>';
//		}
//		foreach($salt as $v){
//			echo '<li>'.md5($password.$v).'</li>';
//		}

//	}
	/**
	 * 用户管理-删除用户
	 * user_delete
	 *
	 */
	public function user_delete($student_id = ''){
		if($this->User_model->delete("`student_id`='$student_id'")){
			echo json_encode(array('student_id'=> $student_id));
		}else{
			echo json_encode(array('response'=> false));
		}
	}
	/*
	 * 邮件发送
	 */
	public function sent_email($email,$title,$content){
//		$config_email_126 = $this->config->item('email_126');//载入邮件配置
//		$config['protocol'] = 'smtp';
//		$config['smtp_host'] = $config_email_126['smtp_host'];
//		$config['smtp_user'] = $config_email_126['smtp_user'];
//		$config['smtp_pass'] = $config_email_126['smtp_pass'];
//		$config['charset'] = 'utf-8';
//		$config['wordwrap'] = TRUE;
//		$config['mailtype'] = 'html';
//		$this -> load -> library('email');
//		$this->email->initialize($config);
//		$this->email->from('hekunyu@126.com');
//		$this->email->to($email);
//		$this->email->subject($title);
//		$this->email->message($content);

		$accesskey=$this->config->item('aliyunAccess');
		include_once BASEPATH.'sdk/aliyun-php-sdk-core/Config.php';
		$iClientProfile = DefaultProfile::getProfile("cn-hangzhou", $accesskey['KeyID'], $accesskey['Secret']);
		$client = new DefaultAcsClient($iClientProfile);
		$request = new Dm\Request\V20151123\SingleSendMailRequest();
		$request->setAccountName("hekunyu@mail.hemisu.com");
		$request->setFromAlias("StuManager");
		$request->setAddressType(1);
		$request->setTagName("forget");
		$request->setReplyToAddress("true");
		$request->setToAddress("$email");
		$request->setSubject("$title");
		$request->setHtmlBody("$content");
		$response = $client->getAcsResponse($request);

//		if( ! $this->email->send()){
//			return false;
//		}else{
//			return true;
//		}
//		print_r($response);
		return $response;

	}
	/*
	 * 数据备份
	 */
	public function database_bak(){
		$this->load->model('Database_bak_model');
		//载入模块
		if($this->input->post('bak')){
			// Load the DB utility class
			$this->load->dbutil();
			$tables = $this->db->list_tables();
			$prefs = array(
				'tables'    => $tables,   // Array of tables to backup.
				'ignore'    => array(),         // List of tables to omit from the backup
				'format'    => 'zip',           // gzip, zip, txt
				'filename'  => 'StuManager_backup_'.date('Y_m_d H_i_s',time()).'.sql',      // File name - NEEDED ONLY WITH ZIP FILES
				'add_drop'  => TRUE,            // Whether to add DROP TABLE statements to backup file
				'add_insert'    => TRUE,            // Whether to add INSERT data to backup file
				'newline'   => "\n"             // Newline character used in backup file
			);
// Backup your entire database and assign it to a variable
			$backup = $this->dbutil->backup($prefs);

// Load the file helper and write the file to your server
			$this->load->helper('file');
			write_file(FCPATH.'public/bak/StuManager_backup_'.date('Y_m_d H_i_s',time()).'.zip', $backup);
			$this->Database_bak_model->insert(array('bakname'=>'StuManager_backup_'.date('Y_m_d H_i_s',time()).'.zip','bakdate'=>date('Y-m-d H:i:s',time()),'valid'=>md5(time())));
			redirect(current_url());
		}

		// Load the download helper and send the file to your desktop
//		$this->load->helper('download');
//		force_download('mybackup.zip', $backup);
//
//$tables = $this->db->list_tables();
//
//foreach ($tables as $table)
//{
//	echo $table.'<br />';
//}
		$this->page_data['database_bak_table'] = $this->Database_bak_model->html_database_bac_list();
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_database_bak',$this->page_data);
	}
	/*
	 * 数据备份删除
	 */
	public function database_bak_del($id = '',$valid = ''){
		$this->load->model('Database_bak_model');
		//载入模块
		$this->load->helper('file');

		//载入文件模块
		if(empty($id)||empty($valid))exit($this->showmessage('参数错误'));
		if($r = $this->Database_bak_model->get_one(array('id'=>$id,'valid'=>$valid))){
			if( !unlink(FCPATH."public/bak/".$r['bakname']) ){
				$this->showmessage('删除文件失败');
			}
			$this->Database_bak_model->delete(array('id'=>$id,'valid'=>$valid));

			//查询并删除
		}else{
			$this->showmessage('查询失败');
		}
		redirect(base_url('admin/database_bak'));
	}
	/*
	 * 文件列表
	 */
	public function file_list(){
	    //==模块加载==
		$this->load->model(array('Upload_file_model'));
		
		include_once BASEPATH.'sdk/Qiniu/autoload.php';

		$qiniuAccess = $this->config->item('qiniuAccess');
		$accessKey = $qiniuAccess['accessKey'];
		$secretKey = $qiniuAccess['secretKey'];

		//初始化Auth状态
		$auth = new Qiniu\Auth($accessKey, $secretKey);

		//初始化BucketManager
		$bucketMgr = new Qiniu\Storage\BucketManager($auth);

		// 要列取的空间名称
		$bucket = 'stumanager';

		// 要列取文件的公共前缀
		$prefix = '';

		$marker = '';
		$limit = 100;

		list($iterms, $marker, $err) = $bucketMgr->listFiles($bucket, $prefix, $marker, $limit);
// 		if ($err !== null) {
// 			echo "\n====> list file err: \n<pre>";
// 			print_r($err);
// 		} else {
// 			echo "Marker: $marker\n";
// 			echo "\nList Iterms====>\n<pre>";
// 			print_r($iterms);
// 		}
		$this->page_data['filelist']=$iterms;
		$this->page_data['filelist'] = $this->Upload_file_model->html_admin_file_list();
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('admin/admin_file_list',$this->page_data);
	}
}
