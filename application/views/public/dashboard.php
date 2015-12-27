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
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">最新待办事项</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">
					<table class="table no-margin">
						<thead>
						<tr>
							<th>名称</th>
							<th>截止时间</th>
							<th>剩余时间</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td><a href="pages/examples/invoice.html">2015暑假留校统计</a></td>
							<td><i class="fa fa-clock-o"></i>&nbsp; 2015.7.4 </td>
							<td>已截止</td>
							<td><span class="label label-success">已完成</span></td>
							<td>
								<div class="sparkbar">
									<a href="#" class="table-link">
                    <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                    </span>
									</a>
								</div>
							</td>
						</tr>
						<tr>
							<td><a href="pages/examples/invoice.html">2015秋季返校统计	</a></td>
							<td><i class="fa fa-clock-o"></i>&nbsp; 2015.9.5</td>
							<td>已截止</td>
							<td><span class="label label-success">已完成</span></td>
							<td>
								<div class="sparkbar">
									<a href="#" class="table-link">
                    <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                    </span>
									</a>
								</div>
							</td>
						</tr>
						<tr>
							<td><a href="pages/examples/invoice.html">13级15学年奖学金评定</a></td>
							<td><i class="fa fa-clock-o"></i>&nbsp; 2015.9.14</td>
							<td>已截止</td>
							<td><span class="label label-success">已完成</span></td>
							<td>
								<div class="sparkbar">
									<a href="#" class="table-link">
                    <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                    </span>
									</a>
								</div>
							</td>
						</tr>
						<tr>
							<td><a href="pages/examples/invoice.html">寝室信息完善</a></td>
							<td><i class="fa fa-clock-o"></i>&nbsp; 2015.11.2</td>
							<td>已截止</td>
							<td><span class="label label-success">已完成</span></td>
							<td>
								<div class="sparkbar">
									<a href="#" class="table-link">
                    <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                    </span>
									</a>
								</div>
							</td>
						</tr>
						<tr>
							<td><a href="pages/examples/invoice.html">毕业库资料完善</a></td>
							<td><i class="fa fa-clock-o"></i>&nbsp; 2015.12.1</td>
							<td>未开始</td>
							<td><span class="label label-warning">未开始</span></td>
							<td>
								<div class="sparkbar">
									<a href="#" class="table-link">
                    <span class="fa-stack">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                    </span>
									</a>
								</div>
							</td>
						</tr>
						</tbody>
					</table>
				</div><!-- /.table-responsive -->
			</div><!-- /.box-body -->
			<div class="box-footer clearfix">
				<a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">发布新的待办事项</a>
				<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">查看所有待办事项</a>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->

	</div><!-- /.col -->
	<div class="col-md-3 hidden-xs hidden-sm">
		<!-- Userinfo -->
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" alt="User profile picture">
				<h3 class="profile-username text-center"><?echo isset($userinfo['username']) ? $userinfo['username']: "Data Error:@param:userinfo";?></h3>
				<p class="text-muted text-center">Web Developer</p>

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
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">详细信息</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<strong><i class="fa fa-qq margin-r-5"></i>  QQ</strong>
				<p class="text-muted">
					<?echo isset($userinfo['qq']) ? $userinfo['qq']: "Data Error:@param:userinfo";?>
				</p>

				<hr>

				<strong><i class="fa fa-envelope margin-r-5"></i>  Mail（未验证）</strong>
				<p class="text-muted">
					<?echo isset($userinfo['email']) ? $userinfo['email']: "Data Error:@param:userinfo";?>
				</p>

				<hr>

				<strong><i class="fa fa-phone margin-r-5"></i>  短号</strong>
				<p class="text-muted">
					<?echo isset($userinfo['short_phone']) ? $userinfo['short_phone']: "Data Error:@param:userinfo";?>
				</p>

				<hr>

				<strong><i class="fa fa-mobile-phone margin-r-5"></i>  长号</strong>
				<p class="text-muted">
					<?echo isset($userinfo['long_phone']) ? $userinfo['long_phone']: "Data Error:@param:userinfo";?>
				</p>

				<hr>

				<strong><i class="fa fa-map-marker margin-r-5"></i> 寝室</strong>
				<p class="text-muted"><?echo isset($userinfo['qinshi']) ? $userinfo['qinshi']: "Data Error:@param:userinfo";?></p>

				<hr>

				<strong><i class="fa fa-pencil margin-r-5"></i> 状态</strong>
				<p>
					<span class="label label-success"><?echo isset($userinfo['status']) ? $userinfo['status']: "Data Error:@param:userinfo";?></span>
				</p>

				<hr>

				<strong><i class="fa fa-file-text-o margin-r-5"></i> 简介</strong>
				<p><?echo isset($userinfo['remarks']) ? (empty($userinfo['remarks'])?"这个人很懒，什么都没说。":$userinfo['remarks']): "Data Error:@param:userinfo";?></p>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
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
