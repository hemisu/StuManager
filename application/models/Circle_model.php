<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Circle_model extends Base_Model {

	public function __construct() {
		$this->table_name = 'circle';
//		$this->page_size = 20;
		parent::__construct();
		//======载入模块======
		$this->load->model(array('User_model'//用户数据模块
		));
	}
	/*
	 * 评论生成页
	 */
	public function html_circle_class(){
		$html = '';
		$circle = $this->select(array('parent_id'=>'0'),'','','date DESC');
		foreach($circle as $b){
			$b['userinfo'] = $this->User_model->get_one(array('student_id'=>$b['student_id']),'`student_id`,`avatar`,`username`');
			$html .= '';
			$html .= '
			<div class="social-feed-box">
				<div class="pull-right social-action dropdown">
					<button data-toggle="dropdown" class="dropdown-toggle btn-white" aria-expanded="false">
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu m-t-xs">
						<li><a href="#">设置</a></li>
					</ul>
				</div>
				<div class="social-avatar">
					<a href="" class="pull-left">
						<img alt="image" src="'.base_url('/public/avatar/');
						if($b['anonymous']){
							$html.= '/default.png';
						}else{
							$html.= '/'.$b['userinfo']['avatar'];
						}
			$html .='">
					</a>

					<div class="media-body">
						<a href="#">
							';
							if($b['anonymous']){
								$html .= '匿名用户';
							}else{
								$html .= $b['userinfo']['username'];
							}
							$html .='
						</a>
						<small class="text-muted">'.date('m月d日 H:i',strtotime($b['date'])).' 来自 '.$b['user_agent'].'</small>
					</div>
				</div>
				<div class="social-body">
					'.$b['content'].'
					<div class="btn-group">
						<button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> 赞</button>
						<button class="btn btn-white btn-xs commentbtn" data-circle-commentid="'.$b['id'].'"><i class="fa fa-comments"></i> 评论</button>
						<button class="btn btn-white btn-xs"><i class="fa fa-share"></i> 分享</button>
					</div>
				</div>';
			if(!empty($b['child_id'])){
				$child_arr=explode(',',$b['child_id']);
				arsort($child_arr);
				foreach($child_arr as $v){
					$r = $this->get_one(array('id'=>$v));
					$c['userinfo'] = $this->User_model->get_one(array('student_id'=>$r['student_id']),'`student_id`,`avatar`,`username`');
					$html .='
					<div class="social-footer">
						<div class="social-comment">
							<a href="" class="pull-left">
								<img alt="image" src="'.base_url('/public/avatar/');
							if($r['anonymous']){
								$html .= '/default.png';
							}else{
								$html .= '/'. $c['userinfo']['avatar'];
							}
					$html .='">
							</a>

							<div class="media-body">
								<a href="#">
									';
								if($r['anonymous']){
									$html .= '匿名用户';
								}else{
									$html .= $c['userinfo']['username'];
								}
								$html .='
								</a> '.$r['content'].'
								<br>
								<a href="#" class="small"><i class="fa fa-thumbs-up"></i> '.$r['praise'].'</a> -
								<small class="text-muted">'.date('m月d日 H:i',strtotime($r['date'])).'</small>
							</div>
						</div>
					</div>';
				}
			}
			$html .='</div>';


		}


		return $html;
	}
}
