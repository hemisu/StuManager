<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/29
 * Time: 下午6:46
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
					<h3 class="box-title">用户组修改</h3>
					<div class="box-tools pull-right">

					</div>
				</div><!-- /.box-header -->
				<div class="box-body pad">
					<?//跨站请求伪造
					$csrf = array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					);
					?>
					<form id="groupForm" action="<?echo base_url('admin/user_group_edit');?>" method="post">
					<div class="form-group">
						<label>用户组ID</label>
						<input type="text" class="form-control" name="group_id" value="<?=(isset($group_info['group_id']))?$group_info['group_id']:'Data Error:@param:group_info';?>">
					</div>
					<div class="form-group">
						<label>用户组名</label>
						<input type="text" class="form-control" name="group_name" value="<?=($group_info['group_name'])?:'Data Error:@param:group_info';?>">
					</div>
					<div class="form-group">
						<label>用户组名</label>
						<textarea class="form-control" rows="3" name="description"><?=($group_info['description'])?:'';?></textarea>
					</div>
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
