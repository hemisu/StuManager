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
					<h3 class="box-title">数据备份</h3>
					<div class="box-tools pull-right">
						<form id="databasebakForm" action="<?echo current_url();?>" method="post">
							<?//跨站请求伪造
							$csrf = array(
								'name' => $this->security->get_csrf_token_name(),
								'hash' => $this->security->get_csrf_hash()
							);
							?>
							<input type="hidden" name="bak" value="1">
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<button type="submit" class="btn btn-primary"><i class="fa fa-database"></i> 备份数据</button>
						</form>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<tr>
								<th style="width: 10px">#</th>
								<th>文件名</th>
								<th>备份日期</th>
								<th>操作</th>
							</tr>
							<?=$database_bak_table;?>
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
<? require_once(dirname(__FILE__) . "/" . "../footer.php");?>

<!-- ./wrapper -->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
</body>
</html>
