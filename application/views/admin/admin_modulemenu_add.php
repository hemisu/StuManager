<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/27
 * Time: 下午9:24
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
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">上级菜单信息<small>不可编辑</small></h3>
						<!-- tools box -->
						<div class="pull-right box-tools">
						</div><!-- /. tools -->
					</div><!-- /.box-header -->

					<div class="box-body pad">
						<div class="form-group">
							<label>上级菜单名称</label>
							<span class="form-control"><?
								$menu_id = $father_menu_info['parent_id'];
								foreach($menu_info as $val){
									if($menu_id==$val['menu_id']){
										$m=$val;
									}
								}
								if(isset($m)) {
									echo '<i class="fa '.$m['css_icon'].'"></i>&nbsp;'.$m['menu_name'];
								}
								?></span>
						</div>
					</div><!-- /.box-body-->
				</div>

				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">菜单属性<small>不了解请勿随意编辑</small></h3>
						<!-- tools box -->
						<div class="pull-right box-tools">
							<button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
							<button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
						</div><!-- /. tools -->
					</div><!-- /.box-header -->

					<div class="box-body pad">
						<?//跨站请求伪造
						$csrf = array(
							'name' => $this->security->get_csrf_token_name(),
							'hash' => $this->security->get_csrf_hash()
						);
						?>
						<form id="moduleForm" action="<?echo base_url("admin/modulemenu_add").'/menu_id/'.$father_menu_info['menu_id'];?>" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>菜单名</label>
									<input type="text" class="form-control" name="menu_name" placeholder="菜单名">
								</div>
								<div class="form-group">
									<label>排序</label>
									<input type="text" class="form-control" name="list_order" value="<?echo $father_menu_info['list_order'];?> ">
								</div>
								<div class="form-group">
									<label>图标CSS</label>
									<div class="input-group">
										<input type="text" class="form-control" name="css_icon" value="fa-circle-o">
									</div>
									<a href="http://fontawesome.dashgame.com/" target="_blank">请输入fontawesome 图标CSS</a>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label>是否是父级元素</label>
											<label class="control-label"><input type="radio" name="is_parent" value="1">
												是</label>&nbsp;&nbsp;
											<label class="control-label"><input type="radio" name="is_parent" value="0" checked>
												否</label>
										</div>
										<div class="col-md-6">
											<label>是否显示</label>
											<label class="control-label"><input type="radio" name="is_display" value="1" checked>
												是</label>&nbsp;&nbsp;
											<label class="control-label"><input type="radio" name="is_display" value="0">
												否</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<label>单独显示</label>
											<label class="control-label"><input type="radio" name="show_alone" value="1">
												是</label>&nbsp;&nbsp;
											<label class="control-label"><input type="radio" name="show_alone" value="0" checked>
												否</label>
										</div>
										<div class="col-md-6">
											<label>分隔栏</label>
											<label class="control-label"><input type="radio" name="is_header" value="1">
												是</label>&nbsp;&nbsp;
											<label class="control-label"><input type="radio" name="is_header" value="0" checked>
												否</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>子级元素</label>
									<input type="text" class="form-control" name="arr_childid" placeholder="输入子级元素">
								</div>
								<div class="form-group">
									<label>控制器</label>
									<input type="text" class="form-control" name="controller" value="<?echo $father_menu_info['controller'];?>">
								</div>
								<div class="form-group">
									<label>方法</label>
									<input type="text" class="form-control" name="method"  placeholder="方法">
								</div>
							</div>
						</div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
					</div><!-- /.box-body-->
					<div class="box-footer">
						<div class="pull-right">
							<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> 提交</button>
						</div>
						<a class="btn btn-default" href="<?echo base_url('admin/modulemenu')?>"><i class="fa fa-times"></i> 返回</a>
					</div><!-- /.box-footer-->
					</form>
				</div>
			</div><!-- /.col-->
		</div><!-- ./row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->

<!-- pace.js -->
<script>
	var SITE_URL = "<?echo SITE_BASE;?>";//require.js
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
<!-- bootstrapValidator -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
<!-- sco.message -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/sco/js/sco.message.js"></script>
<!-- control -->
<script src="<?php echo base_url();?>public/js/<?php echo $controller_name.'_'.$method_name;?>.js"></script>

</body>
</html>
