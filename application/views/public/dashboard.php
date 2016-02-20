<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">
<!-- Info boxes -->
<div class="row">
	<div class="col-md-9 col-sm-12 col-xs-12">
		<!-- Newlist -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">系统公告</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="box-group" id="accordion">
					<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
					<?
					echo $announcelist;
					?>
				</div>
			</div><!-- ./box-body -->
		</div><!-- /.box -->
		<!-- TABLE: LATEST ORDERS -->
		<div class="box box-info animated fadeInUp">
			<div class="box-header with-border">
				<h3 class="box-title">最新待办事项</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<?
					echo $tasklist;
					?>
				</div><!-- /.table-responsive -->
			</div><!-- /.box-body -->
			<div class="box-footer clearfix">
				<a href="<?=base_url('admin/task_list_add')?>" class="btn btn-sm btn-info btn-flat pull-left">发布新的待办事项</a>
				<a href="<?=base_url('task/index')?>" class="btn btn-sm btn-default btn-flat pull-right">查看所有待办事项</a>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->

	</div><!-- /.col -->
	<div class="col-md-3 hidden-xs hidden-sm animated fadeInRight">
		<!-- Userinfo -->
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" alt="User profile picture" data-toggle="modal" data-target="#avatarModal">
				<h3 class="profile-username text-center"><?echo isset($userinfo['username']) ? $userinfo['username']: "Data Error:@param:userinfo";?></h3>
				<p class="text-muted text-center"><?=$this->User_group_model->get_user_gruop_name($userinfo['group_id']);?></p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>学号</b> <a class="pull-right"><?echo isset($userinfo['student_id']) ? $userinfo['student_id']: "Data Error:@param:userinfo";?></a>
					</li>
					<li class="list-group-item">
						<b>学院</b> <a class="pull-right"><?echo isset($userinfo['college']) ? $userinfo['college']: "Data Error:@param:userinfo";?></a>
					</li>
					<li class="list-group-item">
						<b>班级</b> <a class="pull-right"><?echo isset($userinfo['classes']) ? $userinfo['classes']: "Data Error:@param:userinfo";?></a>
					</li>
					<li class="list-group-item">
						<b>最后登录时间</b> <a class="pull-right"><?echo isset($userinfo['lastLoginTime']) ? $userinfo['lastLoginTime']: "Data Error:@param:userinfo";?></a>
					</li>
				</ul>

				<a href="<?echo base_url('user/profile#settings')?>" class="btn btn-primary btn-block"><b>修改资料</b></a>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
		<!-- About Me Box -->
		<!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->
	<!-- avatar Modal -->
	<div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title">更换头像</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-3">
							<a class="media-left" href="#" target="_blank">
								<img id="previewpic" src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" width="100">
							</a>
						</div>
						<div class="col-lg-9">
							<h4 class="media-heading">允许上传类型：gif|jpg|jpeg|png|bmp</h4>
							<form method="post" action="<?=base_url('file/avatar_upload/'.$userinfo['student_id'])?>" enctype="multipart/form-data">
								<input name="avatar" type="file" size="15">
								<br/>
								<input type="submit" name="submitavatar" value="上传头像" class="btn btn-info">
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->
<!-- control -->
<script src="<?php echo base_url();?>public/js/public/<?php echo $controller_name.'_'.$method_name?>.js"></script>
</body>
</html>
