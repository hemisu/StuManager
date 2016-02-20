<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/22
 * Time: 下午10:15
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="ibox">
				<div class="ibox-content">
				<div class="row">
					<div class="col-sm-12">
						<div class="m-b-md">
							<a href="<?=base_url('task/detail/task_id').'/'.$taskinfo['task_id'];?>" class="btn btn-white btn-xs pull-right">返回项目详情</a>
							<h2><?=$taskinfo['title']?></h2>
						</div>
						<dl class="dl-horizontal">
							<dt>状态：</dt>
							<dd><span class="label label-<?
								switch($taskinfo['status']){
									case '进行中' : echo 'danger';break;
									case '已完成' : echo 'success';break;
									default:break;
								}
							?>"><?=$taskinfo['status']?></span>
							</dd>
						</dl>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<dl class="dl-horizontal">
							<dt>发布人：</dt>
							<dd><?=$taskinfo['author']?></dd>
							<dt>用户组：</dt>
							<dd><?=$this->User_group_model->get_user_gruop_name($taskinfo['group_id'])?></dd>
						</dl>
					</div>
					<div class="col-sm-7" id="cluster_info">
						<dl class="dl-horizontal">
							<dt>创建于：</dt>
							<dd><?=$taskinfo['posttime']?></dd>
							<dt>截止于：</dt>
							<dd><?=$taskinfo['deadtime']?></dd>
						</dl>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<dl class="dl-horizontal">
							<dt>当前进度</dt>
							<dd>
								<div class="progress progress-striped active m-b-sm">
									<div style="width: <?=$taskinfo['progress']?>%;" class="progress-bar"></div>
								</div>
								<small>当前已完成总进度的 <strong><?=$taskinfo['progress']?>%</strong></small>
							</dd>
						</dl>
						<strong><h3>内容:</h3></strong>
						<hr />
						<p><?=$taskinfo['description'];?></p>
						<strong><h3>已提交名单:</h3></strong>
						<hr />
						<?=$statistictable;?>
						<hr />
					</div>
				</div>
				<div class="row m-t-sm">
					<div class="col-sm-12">
						<form id="infoForm" method="post" action="<?=current_url();?>" class="form-horizontal">
							<?//跨站请求伪造
							$csrf = array(
								'name' => $this->security->get_csrf_token_name(),
								'hash' => $this->security->get_csrf_hash()
							);
							?>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<h3>离校人员信息</h3>
							<hr/>
							<div class="form-group">
								<div class="col-xs-2">
									<p class="text-center"><strong>姓名</strong></p>
								</div>
								<div class="col-xs-2">
									<p class="text-center"><strong>去向目的地</strong></p>
								</div>
								<div class="col-xs-2">
									<p class="text-center"><strong>起始日期</strong></p>
								</div>
								<div class="col-xs-2">
									<p class="text-center"><strong>截止日期</strong></p>
								</div>
								<div class="col-xs-2">
									<p class="text-center"><strong>家庭第一联系人电话</strong></p>
								</div>
								<div class="col-xs-1">
									<p class="text-center"><strong>分管辅导员</strong></p>
								</div>
								<div class="col-xs-1">
									<p class="text-center"><strong>操作</strong></p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-2">
									<select class="username-ajax form-control" name="info[0][student_id]">
									</select>
								</div>
								<div class="col-xs-2">
									<input type="text" class="form-control" name="info[0][reason]" placeholder="如：浙江金华" />
								</div>
								<div class="col-xs-2">
									<input type="text" class="form-control" name="info[0][begin_date]" value="<?echo date("Y-m-d")?>">
								</div>
								<div class="col-xs-2">
									<input type="text" class="form-control" name="info[0][end_date]" value="<?echo date("Y-m-d")?>">
								</div>
								<div class="col-xs-2">
									<input type="text" class="form-control" name="info[0][remark]" placeholder="家庭第一联系人电话" />
								</div>
								<div class="col-xs-1">
									<input type="text" class="form-control" name="info[0][instructor]" placeholder="辅导员" />
								</div>
								<div class="col-xs-1">
									<button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
								</div>
							</div>

							<!-- The template for adding new field -->
							<div class="form-group hide" id="infoTemplate">
								<div class="col-xs-2">
									<select class="username-ajax form-control" name="student_id">
									</select>
								</div>
								<div class="col-xs-2">
									<input type="text" class="form-control" name="reason" placeholder="如：浙江金华" />
								</div>
								<div class="col-xs-2">
									<input type="text" class="form-control" name="begin_date" value="<?echo date("Y-m-d")?>">
								</div>
								<div class="col-xs-2">
									<input type="text" class="form-control" name="end_date" value="<?echo date("Y-m-d")?>">
								</div>
								<div class="col-xs-2">
									<input type="text" class="form-control" name="remark" placeholder="家庭第一联系人电话" />
								</div>
								<div class="col-xs-1">
									<input type="text" class="form-control" name="instructor" placeholder="辅导员" />
								</div>
								<div class="col-xs-1">
									<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12">
										<button type="submit" class="btn btn-info btn-block">提交离校人员</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->


<!-- Select2 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/select2/select2.full.min.js"></script>
<!-- smart-time-ago -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/smart-time-ago/timeago.js"></script>
<!-- Bootstrap datetimepicker -->
<script type="text/javascript" src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<!-- control -->
<script src="<?php echo base_url();?>public/js/public/<?php echo $controller_name.'_'.$method_name?>.js"></script>
<script>var task_id=<?=$taskinfo['task_id'];?></script>
</body>
</html>
