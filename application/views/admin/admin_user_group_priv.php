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
					<h3 class="box-title">权限分配</h3>
					<div class="box-tools pull-right">
					</div>
				</div><!-- /.box-header -->
				<div class="box-body no-padding">
					<?//跨站请求伪造
					$csrf = array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					);
					?>
					<form id="groupForm" action="<?echo base_url('admin/user_group_priv');?>" method="post">
					<table class="table table-striped table-hover">
						<tr>
							<th style="width: 40px;">#</th>
							<th>模块名</th>
							<th>权限</th>
						</tr>
						<?print_r($group_priv_list);?>
					</table>
						<input type="hidden" name="group_id" value="<?$array = $this->uri->uri_to_assoc(3);echo $array['group_id'];?>">
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
					<div class="pull-right">
						<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> 提交</button>
					</div>
					<a class="btn btn-default" href="<?echo base_url('admin/user_group_list')?>"><i class="fa fa-times"></i> 返回</a>
				</div><!-- /.box-booter -->
				</form>
			</div><!-- /.box -->
		</div><!-- /.col-->
	</div><!-- ./row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->

<!-- control -->
<script src="<?php echo base_url();?>public/js/admin/<?php echo $controller_name.'_'.$method_name?>.js"></script>
</body>
</html>
