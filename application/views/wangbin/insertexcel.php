<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 16/3/4
 * Time: 下午8:45
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="<?php echo base_url('/favicon.png');?>" rel="icon" type="image/x-icon" />
	<title>数据导入导出 - 就业统计</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/bootstrap/css/bootstrap.min.css');?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/bootstrap/css/font-awesome.min.css');?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/bootstrap/css/ionicons.min.css');?>">
	<!-- animate.css -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/animate.css');?>">
	<!-- sco.message -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/sco/css/sco.message.css');?>">
	<!-- pace.js -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/pace/themes/blue/pace-theme-center-simple.css');?>">
	<!-- table -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/bootstrap-table/bootstrap-table.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/bootstrap-table/extensions/editable/bootstrap-editable.css');?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="<?php echo base_url('/public/AdminLTE2/dist/js/html5shiv.min.js');?>"></script>
	<script src="<?php echo base_url('/public/AdminLTE2/dist/js/respond.min.js');?>"></script>
	<![endif]-->
	<style>
	</style>
</head>
<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">电气学院就业统计</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="<?=base_url('wangbin');?>">总览 <span class="sr-only">(current)</span></a></li>
				<li><a href="<?=base_url('wangbin/byteacher');?>">按指导教师统计</a></li>
				<li><a href="<?=base_url('wangbin/byclasses');?>">按班级情况统计</a></li>
				<li class="active"><a href="#">数据导入/导出</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<div class="box" style="margin: 20px 5% 0;">
	<ol class="breadcrumb">
		<li><a href="#">就业统计</a></li>
		<li class="active">数据导入\导出</li>
	</ol>
	<h3>数据导入</h3>
	<?php echo form_open_multipart('wangbin/excel');?>
	<div class="form-group">
		<label for="exampleInputFile">数据导入</label>
		<input type="file" name="userfile" />
		<p class="help-block">选择数据文件(excel,csv格式)</p>
		<a href="<?=base_url('public/upload/demo_export.xls')?>">下载excel导入模板</a>
	</div>
	<br />
	<?//跨站请求伪造
	$csrf = array(
		'name' => $this->security->get_csrf_token_name(),
		'hash' => $this->security->get_csrf_hash()
	);
	?>
	<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	<input type="submit" class="btn btn-default" value="开始导入" />
	</form>
	<hr />
	<h3>数据导出</h3>
	<a href="<?=base_url('wangbin/exportexcel')?>" class="btn btn-default">导出为excel</a>
</div>
<script>
	var SITE_URL = "<?echo SITE_BASE;?>";//SITE_URL
	var CURRENT_URL = "<?echo current_url();?>";//CURRENT_URL
	window.paceOptions = {
		ajax: {
			trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
		}
	};
	//	console.log('咦！这么巧你也喜欢研究WEB技术！\r\n我是本校电气专业大三的学生\r\n有没有兴趣一起讨论？\r\n联系我的QQ：597941116 %c 备注：来自StuManager\r\n',"color:red");
</script>
<script src="<?php echo base_url('/public/AdminLTE2/plugins/pace/pace.js');?>"></script>
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- bootstrapValidator -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
<!-- sco.message -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/sco/js/sco.message.js"></script>
<!-- Bootstrap-table -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<!-- put your locale files after bootstrap-table.js -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/extensions/export/tableExport.min.js"></script>
<!-- Tabele editable -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/extensions/editable/bootstrap-editable.min.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-table/extensions/editable/bootstrap-table-editable.min.js"></script>
<script>
</script>
</body>
</html>
