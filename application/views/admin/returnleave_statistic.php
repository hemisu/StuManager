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
					<h3 class="box-title">统计列表</h3>
					<div class="box-tools pull-right">
						<a href="<?echo base_url('admin/announce_add')?>" class="btn btn-primary btn-sm">发布新事项</a>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<?print_r($cateoption);?>
					<div class="table-responsive">

							<?if(isset($statistictable))echo $statistictable;?>

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

<script>
	$(".cateoption").change(function(){
		var url=$(this).val(); //获取选中记录的value值
   console.log(url);
		$.GoUrl(url);
	})  </script>
</body>
</html>
