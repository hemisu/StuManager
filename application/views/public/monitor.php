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
		<!-- Info boxes -->
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">

				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="ion ion-android-person"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">在校人数</span>
						<span class="info-box-number"><?=$this->User_model->count(array('classes'=>$userinfo['classes'],'atschool'=>'1'));?><small>人</small></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa ion-android-people"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">班级人数</span>
						<span class="info-box-number"><?=$this->User_model->count(array('classes'=>$userinfo['classes']));?><small>人</small></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->

			<!-- fix for small devices only -->
			<div class="clearfix visible-sm-block"></div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">硬币剩余</span>
						<span class="info-box-number">-<small>枚</small></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">专业人数</span>
						<span class="info-box-number"><?=$this->User_model->count(array('major'=>$userinfo['major'],'majoryear'=>$userinfo['majoryear']));?><small>人</small></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
		<!-- Classmate Table -->
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">用户列表</h3>
				<div class="box-tools pull-right">
					<a href="<?echo base_url('monitor/user_add')?>" class="btn btn-primary btn-sm">添加新同学</a>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<div id="toolbar">
					<select class="form-control">
						<option value="">导出本页</option>
						<option value="all">导出所有</option>
						<option value="selected">导出选中</option>
					</select>
				</div>
				<table
					id="user_library"
					class="table table-hover"
					data-toggle="table"
					data-url="<?php echo base_url('/monitor/user_library_json');?>"
					data-pagination="true"
					data-page-size="10"
					data-page-list="[25, 50, ALL]"
					data-search="true"
					data-detail-view="true"
					data-detail-formatter="detailFormatter"
					data-show-columns="true"
					data-show-export="true"
					data-show-refresh="true"
					data-show-toggle="true"
					data-search-align="left"
					data-click-to-select="true"
					data-toolbar="#toolbar"
					>
					<thead>
					<tr>
						<th data-field="state" data-checkbox="true"></th>
						<th data-field="student_id" data-align="center" data-sortable="true">学号</th>
						<th data-field="username" data-align="center" >姓名</th>
						<th data-field="classes" data-align="center" data-sortable="true" data-visible="false">行政班</th>
						<th data-field="long_phone" data-align="center" data-sortable="true">长号</th>
						<th data-field="short_phone" data-align="center" data-sortable="true">短号</th>
						<th data-field="qinshi" data-align="center" data-sortable="true">寝室</th>
						<th data-field="email" data-align="center" data-sortable="true" data-visible="false">email</th>
						<th data-field="qq" data-align="center" data-sortable="true">qq</th>
						<th data-field="group_name" data-align="center" data-sortable="true">用户组</th>
						<th data-field="card_id" data-align="center" data-sortable="true" data-visible="false">身份证号</th>
						<th data-field="zzmm" data-align="center" data-sortable="true" data-visible="false">政治面貌</th>
						<th data-field="mz" data-align="center" data-sortable="true" data-visible="false">民族</th>
						<th data-field="jg" data-align="center" data-sortable="true" data-visible="false">籍贯</th>
						<th data-field="address" data-sortable="true" data-visible="false">家庭地址</th>
						<th data-field="lastLoginTime" data-sortable="true" data-visible="false">最后登录时间</th>
						<th data-field="operate" data-align="center" data-events="operateEvents" data-formatter="operateFormatter">操作</th>
					</tr>
					</thead>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
		<!-- /. Classmate Table -->
	</div><!-- /.col -->
	<div class="col-md-3 hidden-xs hidden-sm animated fadeInRight">
		<!-- Userinfo -->
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" alt="User profile picture" data-toggle="modal" data-target="#avatarModal">
				<h3 class="profile-username text-center"><?echo isset($userinfo['username']) ? $userinfo['username']: "Data Error:@param:userinfo";?></h3>
				<p class="text-muted text-center"><?=$this->User_group_model->get_user_gruop_name($userinfo['group_id']);?></p>
				<?if(!$userinfo['check_email']){
					echo '<p class="text-muted text-center"><a href="'.base_url('user/validmail/'.$userinfo['student_id']).'"> <i class="fa fa-fw fa-circle text-red" ></i>邮箱未验证,点击验证</a></p>';
					}
				?>

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

			</div><!-- /.box-body -->
		</div><!-- /.box -->
		<!-- About Me Box -->
		<!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->


<!-- Bootstrap-table -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<!-- put your locale files after bootstrap-table.js -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/extensions/export/tableExport.min.js"></script>
<!-- control -->
<script src="<?php echo base_url();?>public/js/public/<?php echo $controller_name.'_'.$method_name?>.js"></script>
</body>
</html>
