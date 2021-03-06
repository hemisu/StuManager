<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/25
 * Time: 下午8:33
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">事项列表</h3>
					<div class="box-tools pull-right">
						<a href="<?echo base_url('admin/task_list_add')?>" class="btn btn-primary btn-sm">发布新事项</a>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="table-responsive">
						<table class="table table-striped">
							<tr>
								<th style="width: 10px">#</th>
								<th>标题</th>
								<th>进度</th>
								<th>用户组</th>
								<th>目标类别</th>
								<th>发布日期</th>
								<th>截止日期</th>
								<th>状态</th>
								<th>操作</th>
							</tr>
							<?print_r($task_list);?>
						</table>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
					<?print_r($task_list_page);?>
				</div><!-- /.box-booter -->
			</div><!-- /.box -->
		</div><!-- /.col-->
	</div><!-- ./row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
</body>
</html>
