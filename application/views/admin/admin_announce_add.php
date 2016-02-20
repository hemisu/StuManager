<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/25
 * Time: 下午2:29
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
					<h3 class="box-title">公告内容<small>使用Bootstrap WYSIHTML5 编辑器</small></h3>
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
					<form id="announceForm" action="<?echo base_url('admin/announce_add');?>" method="post">
						<div class="form-group">
							<label>标题</label>
							<input type="text" class="form-control" name="title" placeholder="请输入公告标题">
						</div>
						<div class="form-group">
							<label>标签颜色</label>
							<select class="form-control" name="level">
								<option value="primary">蓝色</option>
								<option value="success">绿色</option>
								<option value="info">青色</option>
								<option value="warning">黄色</option>
								<option value="danger">红色</option>
							</select>
						</div>
						<div class="form-group">
							<label>发布日期</label>
							<input type="text" class="form-control" name="date" value="<?echo date("Y-m-d H:i")?>" id="datetimepicker">
						</div>
						<div class="form-group">
						<textarea class="textarea" name="content" placeholder="请输入公告内容" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				</div><!-- /.box-body-->
				<div class="box-footer">
					<div class="pull-right">
						<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> 提交</button>
					</div>
					<a class="btn btn-default" href="<?echo base_url('admin/announce')?>"><i class="fa fa-times"></i> 返回</a>
				</div><!-- /.box-footer-->
				</form>
			</div>
		</div><!-- /.col-->
	</div><!-- ./row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<? require_once(dirname(__FILE__) . "/" . "../footer.php");?>

<!-- ./wrapper -->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Bootstrap datetimepicker -->
<script type="text/javascript" src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<!-- control -->
<script src="<?php echo base_url();?>public/js/admin/<?php echo $controller_name.'_'.$method_name?>.js"></script>
</body>
</html>
