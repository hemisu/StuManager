<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/22
 * Time: 下午9:41
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-3">
	<a href="compose.html" class="btn btn-primary btn-block margin-bottom">发送新消息</a>
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Folders</h3>
			<div class="box-tools">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body no-padding">
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="#"><i class="fa fa-inbox"></i> 收件箱 <span class="label label-primary pull-right">12</span></a></li>
				<li><a href="#"><i class="fa fa-envelope-o"></i> 发件箱</a></li>
				<li><a href="#"><i class="fa fa-file-text-o"></i> 草稿</a></li>
				<li><a href="#"><i class="fa fa-filter"></i> 筛选 <span class="label label-warning pull-right">65</span></a></li>
				<li><a href="#"><i class="fa fa-trash-o"></i> 垃圾箱</a></li>
			</ul>
		</div><!-- /.box-body -->
	</div><!-- /. box -->
	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Labels</h3>
			<div class="box-tools">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body no-padding">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
				<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
				<li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
			</ul>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div><!-- /.col -->
<div class="col-md-9">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Inbox</h3>
			<div class="box-tools pull-right">
				<div class="has-feedback">
					<input type="text" class="form-control input-sm" placeholder="Search Mail">
					<span class="glyphicon glyphicon-search form-control-feedback"></span>
				</div>
			</div><!-- /.box-tools -->
		</div><!-- /.box-header -->
		<div class="box-body no-padding">
			<div class="mailbox-controls">
				<!-- Check all button -->
				<button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
				<div class="btn-group">
					<button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
					<button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
					<button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
				</div><!-- /.btn-group -->
				<button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
				<div class="pull-right">
					1-50/200
					<div class="btn-group">
						<button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
						<button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
					</div><!-- /.btn-group -->
				</div><!-- /.pull-right -->
			</div>
			<div class="table-responsive mailbox-messages">
				<table class="table table-hover table-striped">
					<tbody>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"></td>
						<td class="mailbox-date">5 mins ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">28 mins ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">11 hours ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"></td>
						<td class="mailbox-date">15 hours ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">Yesterday</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">2 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">2 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"></td>
						<td class="mailbox-date">2 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"></td>
						<td class="mailbox-date">2 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"></td>
						<td class="mailbox-date">2 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">4 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"></td>
						<td class="mailbox-date">12 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">12 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">14 days ago</td>
					</tr>
					<tr>
						<td><input type="checkbox"></td>
						<td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
						<td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
						<td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
						<td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
						<td class="mailbox-date">15 days ago</td>
					</tr>
					</tbody>
				</table><!-- /.table -->
			</div><!-- /.mail-box-messages -->
		</div><!-- /.box-body -->
		<div class="box-footer no-padding">
			<div class="mailbox-controls">
				<!-- Check all button -->
				<button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
				<div class="btn-group">
					<button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
					<button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
					<button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
				</div><!-- /.btn-group -->
				<button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
				<div class="pull-right">
					1-50/200
					<div class="btn-group">
						<button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
						<button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
					</div><!-- /.btn-group -->
				</div><!-- /.pull-right -->
			</div>
		</div>
	</div><!-- /. box -->
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
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/dist/js/demo.js"></script>
</body>
</html>
