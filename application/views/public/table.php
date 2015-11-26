<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/22
 * Time: 下午5:23
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		用户列表
		<small>用户详细信息</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
		<li><a href="#">用户</a></li>
		<li class="active">用户详细信息</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">用户列表</h3>
				<div class="box-tools" id="box-tools">
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<table class="table table-hover"
				       data-toggle="table"
				       data-url="<?php echo base_url('/welcome/userjson');?>"
				       data-pagination="true"
				       data-page-size="10"
				       data-page-list="[10, 25, 50, 100, ALL]"
				       data-search="true"
				       data-detail-view="true"
				       data-detail-formatter="detailFormatter"
				       data-show-columns="true"
				       data-show-export="true"
				       data-show-refresh="true"
				       data-show-toggle="true"
				       data-search-align="left"
					>
					<thead>
					<tr>
						<th data-field="student_id" data-sortable="true">学号</th>
						<th data-field="username">姓名</th>
						<th data-field="classes" data-sortable="true">行政班</th>
						<th data-field="long_phone" data-sortable="true">长号</th>
						<th data-field="short_phone" data-sortable="true">短号</th>
						<th data-field="qinshi" data-sortable="true">寝室</th>
						<th data-field="email" data-sortable="true">email</th>
						<th data-field="qq" data-sortable="true">qq</th>
						<th data-field="card_id" data-sortable="true" data-visible="false">身份证号</th>
						<th data-field="zzmm" data-sortable="true" data-visible="false">政治面貌</th>
						<th data-field="mz" data-sortable="true" data-visible="false">民族</th>
						<th data-field="jg" data-sortable="true" data-visible="false">籍贯</th>
						<th data-field="address" data-sortable="true" data-visible="false">家庭地址</th>
					</tr>
					</thead>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</div>
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
<!-- Bootstrap-table -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<!-- put your locale files after bootstrap-table.js -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<script>
	function detailFormatter(index, row) {
		console.log(row);
		var html = [];
		html.push('<table class="table table-condensed">');
		$.each(row, function (key, value) {
			html.push('<tr><td>' + key + '</td><td> ' + value + '</td></tr>');
		});
		html.push('</table>');
		return html.join('');
	}
</script>
</body>
</html>
