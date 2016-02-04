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
					<h3 class="box-title">新事项<small>使用Bootstrap WYSIHTML5 编辑器</small></h3>
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
					<form id="taskForm" action="<?echo base_url('admin/task_list_add');?>" method="post">
<!--						<th>标题</th>-->
<!--						<th>进度</th>-->
<!--						<th>用户组</th>-->
<!--						<th>发布日期</th>-->
<!--						<th>截止日期</th>-->
<!--						<th>状态</th>-->
						<div class="form-group">
							<label>标题</label>
							<input type="text" class="form-control" name="title" placeholder="请输入事项标题">
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>用户组</label>
									<select class="form-control select2" name="group_id" multiple="multiple" data-placeholder="完成这项事项的用户组">
										<?=$group_select;?>
									</select>
								</div><!-- /.form-group -->
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>类别</label>
									<select class="form-control" name="cate">
										<?
										foreach($this->stu_task as $val=>$opt){
											echo '<option value="'.$val.'">'.$opt.'</option>';
										}
										?>
									</select>
<!--									<select class="form-control" name="cate">-->
<!--										<option value="return_statistic">返校统计</option>-->
<!--										<option value="leave_statistic">离校统计</option>-->
<!--										<option value="evaluate">学业综合评定</option>-->
<!--										<option value="completedata">资料补全</option>-->
<!--										<option value="scholarship">奖学金评定</option>-->
<!--										<option value="identify_poor">贫困生认定</option>-->
<!--										<option value="work_study">勤工助学</option>-->
<!--										<option value="work_study_hours">勤工工时填写</option>-->
<!--									</select>-->
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>发布日期</label>
									<input type="text" class="form-control datetimepicker1" name="posttime" value="<?echo date("Y-m-d H:i")?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>截止日期</label>
									<input type="text" class="form-control datetimepicker2" name="deadtime" value="<?echo date("Y-m-d H:i")?>">
								</div>
							</div>
						</div>
						<div class="form-group">
						<textarea class="textarea" name="description" placeholder="请输入介绍" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
						<input type="hidden" name="progress" value="0" />
						<input type="hidden" name="status" value="进行中" />
						<input type="hidden" name="author" value="<?=$userinfo['username']?>" />
				</div><!-- /.box-body-->
				<div class="box-footer">
					<div class="pull-right">
						<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> 提交</button>
					</div>
					<a class="btn btn-default" href="<?echo base_url('admin/task_list')?>"><i class="fa fa-times"></i> 返回</a>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Bootstrap datetimepicker -->
<script type="text/javascript" src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/select2/select2.full.min.js"></script>
<!-- control -->
<script src="<?php echo base_url();?>public/js/<?php echo $controller_name.'_'.$method_name?>.js"></script>
<script>
	$(function () {
		$(".select2").select2({
			theme: "classic"
		});
	});
</script>
</body>
</html>
