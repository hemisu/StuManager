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
							<a href="<?=base_url('task');?>" class="btn btn-white btn-xs pull-right">返回项目列表</a>
							<h2><?=$taskinfo['title']?></h2>
						</div>
						<dl class="dl-horizontal">
							<dt>状态：</dt>
							<dd><span class="label label-<?
								if(time()-strtotime($taskinfo['deadtime']) <0){
									echo 'danger';
								}else{
									echo 'success';
								}
							?>"><?
									if(time()-strtotime($taskinfo['deadtime']) <0){
										echo '进行中';
									}else{
										echo '已完成';
									}
									?></span>
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
						<?$proportion = $this->Task_title_model->progress_time($taskinfo);?>
						<dl class="dl-horizontal">
							<dt>当前进度</dt>
							<dd>
								<div class="progress progress-striped active m-b-sm">
									<div style="width: <?=$proportion?>%;" class="progress-bar"></div>
								</div>
								<small>当前已完成总进度的 <strong><?=$proportion?>%</strong></small>
							</dd>
						</dl>
						<strong><h3>介绍:</h3></strong>
						<hr />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<p><?=$taskinfo['description'];?></p>
						<hr />
						<?
						if(strtotime($taskinfo['deadtime'])-time()>0) {//未过截止日期
							?>
							<a href="<?= base_url('task') . '/' . $taskinfo['cate'] . '/task_id/' . $taskinfo['task_id']; ?>"
							   class="btn btn-info btn-block">点击进入填写页面</a>
						<?}else{?>
							<a href="<?= base_url('task') . '/' . $taskinfo['cate'] . '/task_id/' . $taskinfo['task_id']; ?>"
							   class="btn btn-danger btn-block">已过截止日期，点击查看内容</a>
						<?}?>
					</div>
				</div>

				<div class="row m-t-sm">
					<div class="col-sm-12">
						<div class="panel blank-panel">
							<div class="panel-heading">
								<div class="panel-options">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-1" data-toggle="tab">提交列表</a>
										</li>
<!--										<li class=""><a href="#tab-2" data-toggle="tab">阶段</a>-->
<!--										</li>-->
									</ul>
								</div>
							</div>

							<div class="panel-body animated fadeInUp">
								<div class="tab-content">
									<div class="tab-pane active" id="tab-1">
										<div class="feed-activity-list">
											<?=$actionlist;?>
										</div>
									</div>
<!--									<div class="tab-pane" id="tab-2">-->
<!--										<div class="table-responsive">-->
<!--											<table class="table table-striped">-->
<!--											<thead>-->
<!--											<tr>-->
<!--												<th>状态</th>-->
<!--												<th>标题</th>-->
<!--												<th>开始时间</th>-->
<!--												<th>结束时间</th>-->
<!--												<th>说明</th>-->
<!--											</tr>-->
<!--											</thead>-->
<!--											<tbody>-->
<!--											<tr>-->
<!--												<td>-->
<!--													<span class="label label-primary"><i class="fa fa-check"></i> 已完成</span>-->
<!--												</td>-->
<!--												<td>-->
<!--													文档在线预览功能-->
<!--												</td>-->
<!--												<td>-->
<!--													11月7日 22:03-->
<!--												</td>-->
<!--												<td>-->
<!--													11月7日 20:11-->
<!--												</td>-->
<!--												<td>-->
<!--													<p class="small">-->
<!--														已经测试通过-->
<!--													</p>-->
<!--												</td>-->
<!---->
<!--											</tr>-->
<!--											<tr>-->
<!--												<td>-->
<!--													<span class="label label-primary"><i class="fa fa-check"></i> 解决中</span>-->
<!--												</td>-->
<!--												<td>-->
<!--													会员登录-->
<!--												</td>-->
<!--												<td>-->
<!--													11月7日 22:03-->
<!--												</td>-->
<!--												<td>-->
<!--													11月7日 20:11-->
<!--												</td>-->
<!--												<td>-->
<!--													<p class="small">-->
<!--														测试中-->
<!--													</p>-->
<!--												</td>-->
<!---->
<!--											</tr>-->
<!--											<tr>-->
<!--												<td>-->
<!--													<span class="label label-primary"><i class="fa fa-check"></i> 解决中</span>-->
<!--												</td>-->
<!--												<td>-->
<!--													会员积分-->
<!--												</td>-->
<!--												<td>-->
<!--													11月7日 22:03-->
<!--												</td>-->
<!--												<td>-->
<!--													11月7日 20:11-->
<!--												</td>-->
<!--												<td>-->
<!--													<p class="small">-->
<!--														未测试-->
<!--													</p>-->
<!--												</td>-->
<!---->
<!--											</tr>-->
<!---->
<!---->
<!--											</tbody>-->
<!--										</table>-->
<!--									</div>-->
<!--									</div>-->
								</div>
							</div>
						</div>
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

<!-- smart-time-ago -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/smart-time-ago/timeago.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/smart-time-ago/locales/timeago.zh-cn.js"></script>
<!-- control -->
<script src="<?php echo base_url();?>public/js/public/<?php echo $controller_name.'_'.$method_name?>.js"></script>
</body>
</html>
