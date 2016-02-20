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
					<h3 class="box-title">事项修改<small>使用Bootstrap WYSIHTML5 编辑器</small></h3>
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
					<form id="taskForm" action="<?echo base_url('admin/task_list_edit').'/task_id/'.$task['task_id'];?>" method="post">
<!--						<th>标题</th>-->
<!--						<th>进度</th>-->
<!--						<th>用户组</th>-->
<!--						<th>发布日期</th>-->
<!--						<th>截止日期</th>-->
<!--						<th>状态</th>-->
						<div class="form-group">
							<label>标题</label>
							<input type="text" class="form-control" name="title" value="<?=$task['title'];?>">
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>用户组</label>
									<select class="form-control select2" name="group_id" multiple="multiple" value="<?=$task['group_id'];?>" data-placeholder="完成这项事项的用户组">
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
											echo '<option value="'.$val.'"';
											if($task['cate']==$val)echo 'selected="selected"';
											echo '>'.$opt.'</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>状态</label>
									<select class="form-control" name="status">
										<option <?if($task['status']=='进行中')echo 'selected="selected"';?>>进行中</option>
										<option <?if($task['status']=='已完成')echo 'selected="selected"';?>>已完成</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>作者</label>
									<input type="text" class="form-control" name="author" value="<?=$task['author'];?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>发布日期</label>
									<input type="text" class="form-control datetimepicker1" name="posttime" value="<?=$task['posttime'];?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>截止日期</label>
									<input type="text" class="form-control datetimepicker2" name="deadtime" value="<?=$task['deadtime'];?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label>进度</label>
									<input type="text" value="<?=$task['progress'];?>" name="progress" class="slider form-control" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?=$task['progress'];?>" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="aqua">
								</div>
							</div>
						</div>
						<div class="form-group">
						<textarea class="textarea" name="description" placeholder="请输入介绍" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$task['description'];?></textarea>
						</div>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

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


<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Bootstrap datetimepicker -->
<script type="text/javascript" src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/select2/select2.full.min.js"></script>
<!-- Bootstrap slider -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-slider/bootstrap-slider.js"></script>
<!-- control -->
<script src="<?php echo base_url();?>public/js/admin/<?php echo $controller_name.'_'.$method_name?>.js"></script>
</body>
</html>
