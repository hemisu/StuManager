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
					<h3 class="box-title">模块列表</h3>
					<div class="box-tools pull-right">
					</div>
				</div><!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="table-responsive">
						<table class="table table-striped">
							<tr>
								<th>#</th>
								<th>模块名</th>
								<th>排序</th>
								<th>控制器</th>
								<th>方式</th>
								<th>侧栏显示</th>
								<th>单独显示</th>
								<th>操作</th>
							</tr>
							<?print_r($modulelist);?>
						</table>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
				</div><!-- /.box-booter -->
			</div><!-- /.box -->
		</div><!-- /.col-->
	</div><!-- ./row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->
</body>
</html>
