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
				<img class="profile-user-img img-responsive img-circle" src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" alt="User profile picture">
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
				</ul>

				<a href="<?echo base_url('user/profile#settings')?>" class="btn btn-primary btn-block"><b>修改资料</b></a>
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

<!-- pace.js -->
<script>
	var SITE_URL = "<?echo SITE_BASE?>";//require.js
	window.paceOptions = {
		ajax: {
			trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
		}
	};
</script>
<script src="<?php echo base_url('/public/AdminLTE2/plugins/pace/pace.js');?>"></script>
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/dist/js/demo.js"></script>
<script>
	$(function () {
		$(".announcecontent").each(function () {
			var maxwidth = 100;
			if ($(this).text().length > maxwidth) {
				var myid= $(this).data('announceid'); console.log(myid);
				$(this).html($(this).html().substring(0, maxwidth));
				$(this).html($(this).html() + "<a href='<?echo base_url('dashboard/announce/announce_id');?>"+"/"+myid+"' >查看更多</a>");
			}
		});
	});
</script>
</body>
</html>
