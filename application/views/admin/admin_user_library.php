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
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">用户列表</h3>
				<div class="box-tools pull-right">
					<a href="<?echo base_url('admin/user_add')?>" class="btn btn-primary btn-sm">添加新用户</a>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body table-responsive">
				<table
					id="user_library"
					class="table table-hover"
					data-toggle="table"
					data-url="<?php echo base_url('/admin/user_library_json');?>"
					data-pagination="true"
					data-page-size="20"
					data-page-list="[25, 50, 100, ALL]"
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
						<th data-field="student_id" data-align="center" data-sortable="true">学号</th>
						<th data-field="username" data-align="center" >姓名</th>
						<th data-field="classes" data-align="center" data-sortable="true">行政班</th>
						<th data-field="long_phone" data-align="center" data-sortable="true">长号</th>
						<th data-field="short_phone" data-align="center" data-sortable="true">短号</th>
						<th data-field="qinshi" data-align="center" data-sortable="true">寝室</th>
						<th data-field="email" data-align="center" data-sortable="true">email</th>
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
	</div>
</div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<? require_once(dirname(__FILE__) . "/" . "../footer.php");?>

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
<!-- sco.message -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/sco/js/sco.message.js"></script>
<!-- put your locale files after bootstrap-table.js -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<script>
	function detailFormatter(index, row) {
//		console.log(row);
		var html = [];
		html.push('<table style="background-color: #f4f4f4;">');
		$.each(row, function (key, value) {
			if(key == 'long_phone'){
				html.push('<tr style="border-top: 1px solid #dddddd;"><td width="80">' + key + '</td><td> <a href="tel:'+value+'">' + value + '</a></td></tr>');

			}else if(key == 'short_phone'){
				html.push('<tr style="border-top: 1px solid #dddddd;"><td width="80">' + key + '</td><td> <a href="tel:'+value+'">' + value + '</a></td></tr>');
			}else{
				html.push('<tr style="border-top: 1px solid #dddddd;"><td width="80">' + key + '</td><td> ' + value + '</td></tr>');
			}

		});
		html.push('</table>');
		return html.join('');
	}
	function operateFormatter(value, row, index) {
		return [
			'<a class="like" href="<?=base_url('admin/user_edit').'/';?>'+row.student_id+'" title="Like">',
			'<i class="glyphicon glyphicon-edit"></i>',
			'</a>  ',
			'<a class="remove" href="javascript:void(0)" onclick="if(confirm(\'确定删除?\')==false)return false;" title="Remove">',
			'<i class="glyphicon glyphicon-remove"></i>',
			'</a>'
		].join('');
	}
	window.operateEvents = {
		'click .remove': function (e, value, row, index) {
			$.ajax({
				type: 'get',
				url: '<?=base_url('admin/user_delete');?>'+'/'+row.student_id,
				data: {student_id : row.student_id} ,
				dataType:'json',
				success:function(result) {
					if (result.response == false ) {
						$.scojs_message('删除失败', $.scojs_message.TYPE_ERROR);
					} else {
						console.log(result);
						$.scojs_message('删除成功', $.scojs_message.TYPE_OK);
					}
				}
			});
			$('#user_library').bootstrapTable('remove', {
				field: 'student_id',
				values: [row.student_id]
			});

		}
	};

</script>
</body>
</html>
