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
<section class="content-header">
	<h1>
		待办事项
		<small>待办事项列表</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> 主页</a></li>
		<li>待办事项</li>
		<li class="active">待办事项列表</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="ibox">
	<div class="ibox-title">
		<h5>所有项目</h5>
		<div class="ibox-tools">
			<a href="projects.html" class="btn btn-primary btn-xs">创建新项目</a>
		</div>
	</div>
	<div class="ibox-content">
	<div class="row m-b-sm m-t-sm">
		<div class="col-md-1">
			<button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> 刷新</button>
		</div>
		<div class="col-md-11">
			<div class="input-group">
				<input type="text" placeholder="请输入项目名称" class="input-sm form-control"> <span class="input-group-btn">
	                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
			</div>
		</div>
	</div>

	<div class="project-list">

	<table class="table table-hover">
	<tbody>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">LIKE－一款能够让用户快速获得认同感的兴趣社交应用</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 48%</small>
			<div class="progress progress-xs active">
				<div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
					<span class="sr-only">60% Complete (warning)</span>
				</div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user5-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user3-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user1-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">米莫说｜MiMO Show</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 28%</small>
			<div class="progress progress-mini">
				<div style="width: 28%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user5-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-default">已取消
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">商家与购物用户的交互试衣应用</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 8%</small>
			<div class="progress progress-mini">
				<div style="width: 8%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user5-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">天狼---智能硬件项目</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 83%</small>
			<div class="progress progress-mini">
				<div style="width: 83%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user1-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user1-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">乐活未来</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 97%</small>
			<div class="progress progress-mini">
				<div style="width: 97%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">【私人医生项目】</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 48%</small>
			<div class="progress progress-mini">
				<div style="width: 48%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user1-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user5-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">快狗家居</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 28%</small>
			<div class="progress progress-mini">
				<div style="width: 28%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user5-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-default">已取消
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">线下超市+线上商城+物流配送互联系统</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 8%</small>
			<div class="progress progress-mini">
				<div style="width: 8%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user1-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">P司机汽车省钱专家</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 83%</small>
			<div class="progress progress-mini">
				<div style="width: 83%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user5-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">左左 靠谱男同交友</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 97%</small>
			<div class="progress progress-mini">
				<div style="width: 97%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user1-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	<tr>
		<td class="project-status">
	                                            <span class="label label-primary">进行中
	                                        </span></td>
		<td class="project-title">
			<a href="project_detail.html">程序员私活圈</a>
			<br>
			<small>创建于 2014.08.15</small>
		</td>
		<td class="project-completion">
			<small>当前进度： 28%</small>
			<div class="progress progress-mini">
				<div style="width: 28%;" class="progress-bar"></div>
			</div>
		</td>
		<td class="project-people">
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user5-128x128.jpg"></a>
			<a href="projects.html"><img alt="image" class="img-circle" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg"></a>
		</td>
		<td class="project-actions">
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 查看 </a>
			<a href="projects.html#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
		</td>
	</tr>
	</tbody>
	</table>
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
