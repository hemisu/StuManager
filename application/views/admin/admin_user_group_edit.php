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
					<h3 class="box-title">公告列表</h3>
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
					<div class="form-group">
						<label>用户组ID</label>
						<input type="text" class="form-control" name="group_id" placeholder="输入用户组ID">
					</div>
					<div class="form-group">
						<label>用户组名</label>
						<input type="text" class="form-control" name="group_name" placeholder="输入用户组名">
					</div>
					<div class="form-group">
						<label>用户组名</label>
						<textarea class="form-control" rows="3" name="description" placeholder="用户组介绍"></textarea>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
					<div class="pull-right">
						<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> 提交</button>
					</div>
					<a class="btn btn-default" href="<?echo base_url('admin/user_group_list')?>"><i class="fa fa-times"></i> 返回</a>
				</div><!-- /.box-booter -->
			</div><!-- /.box -->
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
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<?//跨站请求伪造
$csrf = array(
	'name' => $this->security->get_csrf_token_name(),
	'hash' => $this->security->get_csrf_hash()
);
?>
<script>
	$(".bg-red").each(function(){
		$(this).click(function(){
			id=$(this).data('deleteid');
			t=$(this).parent().parent();
			$.ajax({
				type: "post",
				url: "<?=base_url('admin/announce_delete')?>",
				data: {announce_id:id,<?=$csrf['name']?>:'<?=$csrf['hash']?>'},
				dataType: "json",
				success: function(data){
					console.log(data);
					$.scojs_message('删除成功', $.scojs_message.TYPE_OK);
					t.remove();
				}
			});
		})
	})
</script>
</body>
</html>
