<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends Login_Controller{
	var $method_config;
	function __construct()
	{
		parent::__construct();
		$this->method_config['upload_avatar'] = array(
			'upload_size'=>1024,'upload_file_type'=>'jpg|png|gif','upload_path'=>'public/avatar','upload_url'=>base_url().'public/avatar/'
		);
	}
	public function index(){
		$this->load->view('head',$this->page_data);
		$this->load->view('siderbar',$this->page_data);
		$this->load->view('public/file_manager',$this->page_data);
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
}
