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
<!--				--><?//print_r($taskinfo);?>
			<div class="row">
				<div class="col-sm-12">
					<div class="m-b-md">
						<a href="<?=base_url('task');?>" class="btn btn-white btn-xs pull-right">返回项目列表</a>
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
					<strong><h3>介绍:</h3></strong>
					<hr />
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<p><?=$taskinfo['description'];?></p>
					<hr />
					<a href="<?=base_url($taskinfo['cate']).'/'.$taskinfo['cate_id'];?>" class="btn btn-info btn-block">点击进入填写页面</a>
				</div>
			</div>

			<div class="row m-t-sm">
				<div class="col-sm-12">
					<div class="panel blank-panel">
						<div class="panel-heading">
							<div class="panel-options">
								<ul class="nav nav-tabs">
									<li class="active"><a href="project_detail.html#tab-1" data-toggle="tab">提交列表</a>
									</li>
									<li class=""><a href="project_detail.html#tab-2" data-toggle="tab">阶段</a>
									</li>
								</ul>
							</div>
						</div>

						<div class="panel-body animated fadeInUp">

							<div class="tab-content">
								<div class="tab-pane active" id="tab-1">
									<div class="feed-activity-list">
										<div class="feed-element">
											<a href="profile.html#" class="pull-left">
												<img alt="image" class="img-circle" src="<?echo base_url("/public/AdminLTE2/dist/img");?>/user6-128x128.jpg">
											</a>
											<div class="media-body ">
												<small class="pull-right">1天前</small>
												<strong>奔波儿灞</strong> 提交了 <strong>2016返校统计</strong> .
												<br>
												<small class="text-muted">54分钟前 来自 user—agent</small>
												<div class="well">
													真麻烦。找不到要的
												</div>

											</div>
										</div>
										<div class="feed-element">
											<a href="profile.html#" class="pull-left">
												<img alt="image" class="img-circle" src="<?echo base_url("/public/AdminLTE2/dist/img");?>/user3-128x128.jpg">
											</a>
											<div class="media-body ">
												<small class="pull-right">1天前</small>
												<strong>奔波儿灞</strong> 提交了 <strong>2016返校统计</strong>.
												<br>
												<small class="text-muted">54分钟前 来自 user—agent</small>

											</div>
										</div>



									</div>

								</div>
								<div class="tab-pane" id="tab-2">

									<table class="table table-striped">
										<thead>
										<tr>
											<th>状态</th>
											<th>标题</th>
											<th>开始时间</th>
											<th>结束时间</th>
											<th>说明</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td>
												<span class="label label-primary"><i class="fa fa-check"></i> 已完成</span>
											</td>
											<td>
												文档在线预览功能
											</td>
											<td>
												11月7日 22:03
											</td>
											<td>
												11月7日 20:11
											</td>
											<td>
												<p class="small">
													已经测试通过
												</p>
											</td>

										</tr>
										<tr>
											<td>
												<span class="label label-primary"><i class="fa fa-check"></i> 解决中</span>
											</td>
											<td>
												会员登录
											</td>
											<td>
												11月7日 22:03
											</td>
											<td>
												11月7日 20:11
											</td>
											<td>
												<p class="small">
													测试中
												</p>
											</td>

										</tr>
										<tr>
											<td>
												<span class="label label-primary"><i class="fa fa-check"></i> 解决中</span>
											</td>
											<td>
												会员积分
											</td>
											<td>
												11月7日 22:03
											</td>
											<td>
												11月7日 20:11
											</td>
											<td>
												<p class="small">
													未测试
												</p>
											</td>

										</tr>


										</tbody>
									</table>

								</div>
							</div>

						</div>

					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->
	</div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->

<!-- pace.js -->
<script>
	var SITE_URL = "<?echo SITE_BASE?>";//require.js
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
</body>
</html>
