<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_file_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'upload_file';
		parent::__construct();
		//======载入模块======
	}

	/**
	 * 公共页面 filelist
	 * @param string $resultarr
	 * @return string
	 */
	public function html_public_file_list($resultarr = ''){
		$html = '';
		if($resultarr == ''){
			$files = $this->select();
		}else{
			$files = $resultarr;
		}
		foreach($files as $f){
			$html .= '<div class="file-box">
										<div class="file">
												<a href="'.base_url("file/delete_file/$f[key_orignal]").'"><span class="corner"></span></a>
											';
												if($f['preview'] == null){
													$html .='<div class="icon">
                                      <a href="'.$this->Qiniu_privateDownloadUrl($this->qiniubaseurl.$f['key_orignal']).'"><i class="fa fa-file"></i></a>
                                  </div>';
												}else{
													$html .='	<div class="image">
													<a href="'.$this->Qiniu_privateDownloadUrl($this->qiniubaseurl.$f['preview']).'" class="fancybox" rel="group">
													<img alt="image" class="img-responsive" src="'.$this->Qiniu_privateDownloadUrl($this->qiniubaseurl.$f['thumb']).'">
													</a>
												</div>';
												}

			$html .='				<div class="file-name">
													<span limit="20">'.$f['file_name'].'</span>
													<br>
													<small>添加时间：'.date('Y-m-d',strtotime($f['create_time'])).'</small>
												</div>
										</div>
									</div>';
		}

		return $html;
	}
	public function html_admin_file_list($resultarr){
		//==模块加载==
		$this->load->model(array('User_model'));
		$html = '';
		if($resultarr == ''){
			$files = $this->select();
		}else{
			$files = $resultarr;
		}
		$index = 0;
		foreach($files as $f){
			$html .= '<tr>';
			$html .= '<td>'.$index++.'</td>';
			$html .= '<td>';
			if($f['preview'] == null){
				$html .='<div class="icon">
	                  <a href="'.$this->Qiniu_privateDownloadUrl($this->qiniubaseurl.$f['key_orignal']).'"><i class="fa fa-file"></i></a>
	              </div>';
			}else{
				$html .='<div class="image">
									<a href="'.$this->Qiniu_privateDownloadUrl($this->qiniubaseurl.$f['preview']).'" class="fancybox" rel="group">
									<img alt="image" class="img-responsive" src="'.$this->Qiniu_privateDownloadUrl($this->qiniubaseurl.$f['thumb']).'" style="max-height: 150px;">
									</a>
								</div>';
			}
			$html .= '</td>';
			$upuser = $this->User_model->username_classes($f['student_id']);
			$html .= '<td>'.$f['file_name'].'</td>';
			$html .= '<td>'.$upuser['username'].'</td>';
			$html .= '<td>'.$f['student_id'].'</td>';
			$html .= '<td>'.$upuser['classes'].'</td>';
			$html .= '<td><a class="btn btn-block btn-default btn-xs" href="'.base_url("file/delete_file/$f[key_orignal]").'">删除</a></td>';
			$html .= '</tr>';
		}
		return $html;
	}
	/*
	 * Qiniu_privateDownloadUrl 私有连接生成
	 */
	private function Qiniu_privateDownloadUrl($baseurl){
		include_once BASEPATH.'sdk/Qiniu/autoload.php';

		$qiniuAccess = $this->config->item('qiniuAccess');
		$accessKey = $qiniuAccess['accessKey'];
		$secretKey = $qiniuAccess['secretKey'];
		$auth = new Qiniu\Auth($accessKey, $secretKey);

		$privateurl = $auth->privateDownloadUrl($baseurl);
		return $privateurl;
	}

}
