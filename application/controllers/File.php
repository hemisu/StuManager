<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends Login_Controller{
	var $method_config;
	function __construct()
	{
		parent::__construct();
		//==模块加载==
		$this->load->model(array('Upload_file_model'));
		$this->method_config['upload_avatar'] = array(
			'upload_size'=>1024,'upload_file_type'=>'jpg|png|gif','upload_path'=>'public/avatar','upload_url'=>base_url().'public/avatar/'
		);
	}
	public function index(){
		$where_arr = array();
		$type = $student_id = "";

		if (isset($_GET['type'])) {
			$type =isset($_GET['type'])?safe_replace(trim($_GET['type'])):'';
			if($type!="") $where_arr[] = "`mime_type` like '%{$type}%'";
		}
		if (isset($_GET['student_id'])) {
			$student_id =isset($_GET['student_id'])?safe_replace(trim($_GET['student_id'])):'';
			if($student_id!="") $where_arr[] = "`student_id` = '$student_id'";
		}
		$where = implode(" and ",$where_arr);

		$sqlresult = $this->Upload_file_model->select($where);
		$this->page_data['filelist'] = $this->Upload_file_model->html_public_file_list($sqlresult);
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/file_manager',$this->page_data);
	}
	public function test(){
		echo json_encode(array('status' => 'ok'));
	}
	public function delete_file($key){
		if(empty($key))exit('?');
		$r = $this->Upload_file_model->get_one(array('student_id'=>$this->student_id,'key_orignal'=>$key));
		if(!$r || $this->group_id != SUPERADMIN_GROUP_ID){
			$this->showmessage('不是你的文件，不能进行操作');
			return 0;
		}

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

		//删除$bucket 中的文件 $key
		$err = $bucketMgr->delete($bucket, $key);
		if ($err !== null) {
			var_dump($err);//输出错误信息
		} else {
			$this->Upload_file_model->delete(array('key_orignal'=>$key));
			if(isset($_SERVER['HTTP_REFERER'])){
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	public function list_file(){
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
		$limit = 3;

		list($iterms, $marker, $err) = $bucketMgr->listFiles($bucket, $prefix, $marker, $limit);
		if ($err !== null) {
			echo "\n====> list file err: \n";
			var_dump($err);
		} else {
			echo "Marker: $marker\n";
			echo "\nList Iterms====>\n";
			var_dump($iterms);
		}


	}
	/**
	 * 上传附件
	 * @param string $student_id 学号
	 * @return void
	 */
	public function avatar_upload($student_id='')
	{
		$isImage=true;
		if( isset($this->method_config['upload_avatar']))
		{
				$upload_path = $this->method_config['upload_avatar']['upload_path'];//上传头像路径

				if($upload_path=='')die('缺少上传参数');

				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = $this->method_config['upload_avatar']['upload_file_type'];
				$config['max_size'] = $this->method_config['upload_avatar']['upload_size'];
				$config['overwrite']  = TRUE;
				$config['encrypt_name']= FALSE;
				$config['file_ext_tolower']=FALSE;//文件后缀名将转换为小写
				$config['file_name']=$student_id.'.jpg';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('avatar')) $this->showmessage("上传失败:".$this->upload->display_errors());
				$filedata =  $this->upload->data();

				$file_name = $filedata['file_name'];
				$file_size = $filedata['file_size'];
				$full_path = $filedata['full_path'];
				$image_width = $isImage?$filedata['image_width']:0;
				$image_height =  $isImage?$filedata['image_height']:0;

				$config['image_library'] = 'gd2';
				$config['source_image'] = $full_path;
				$config['new_image'] = $full_path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 100;
				$config['height']   = 100;

				$this->load->library('image_lib', $config);//生成缩略图并替换

				$this->image_lib->resize();
				$this->User_model->update(array('avatar'=>$this->student_id.'.jpg'),"`student_id`=$this->student_id");
				$this->showmessage("上传成功!");
		}else
		{
			die('缺少上传参数');
		}
	}
	/*
	 * Qiniu token生成
	 */
	public function Qiniutoken(){

	}


}
