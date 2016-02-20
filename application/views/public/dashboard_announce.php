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
	<div class="col-xs-12">
		<!-- Newlist -->
		<div class="box box-<?echo $announce['level'];?>">
			<div class="box-header with-border">
				<h3 class="box-title"><?echo $announce['title']?></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="box-group" id="accordion">
					<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
					<?
						echo $announce['content'];
					?>
				</div>
			</div><!-- ./box-body -->
			<div class="box-footer">
				<div class="pull-right">
					<a class="btn btn-default" href="<?echo base_url('dashboard')?>"><i class="fa fa-times"></i> 返回</a>
				</div>
			</div><!-- /.box-footer-->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->
</body>
</html>
