<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/14
 * Time: 下午7:46
 * head.php
 * 头部
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="<?php echo base_url('/favicon.png');?>" rel="icon" type="image/x-icon" />
	<title><?echo $pageheaderinfo[0][0];?> - <?=$this->siteinfo['sitename']?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/bootstrap/css/bootstrap.min.css');?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/bootstrap/css/font-awesome.min.css');?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/bootstrap/css/ionicons.min.css');?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/dist/css/AdminLTE.min.css');?>">
	<!-- animate.css -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/animate.css');?>">
	<!-- sco.message -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/sco/css/sco.message.css');?>">
	<!-- pace.js -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/pace/themes/blue/pace-theme-center-simple.css');?>">
	<!-- table -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/bootstrap-table/bootstrap-table.min.css');?>">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/select2/select2.min.css');?>">
	<!-- bootstrap slider -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/bootstrap-slider/slider.css');?>">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>">
	<!-- fancyBox -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/fancyBox/jquery.fancybox.css');?>">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- bootstrap datetimepicker -->
	<link rel="stylesheet"  href="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" >
	<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/dist/css/skins/_all-skins.min.css');?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="<?php echo base_url('/public/AdminLTE2/dist/js/html5shiv.min.js');?>"></script>
	<script src="<?php echo base_url('/public/AdminLTE2/dist/js/respond.min.js');?>"></script>
	<![endif]-->
	<!-- 调试 -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/stu.css');?>">
	<!-- uploader.css -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/uploader/uploader.css');?>">
	<style>
	</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">

<!-- Logo -->
<a href="#" class="logo">
	<!-- mini logo for sidebar mini 50x50 pixels -->
	<span class="logo-mini"><b>S</b>tu</span>
	<!-- logo for regular state and mobile devices -->
	<span class="logo-lg"><b>Stu</b>Manager</span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
</a>
<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
<!-- Tasks: style can be found in dropdown.less -->
<li class="dropdown tasks-menu">
	<li class="dropdown tasks-menu">
		<?=$this->Task_title_model->head_task_html($this->group_id);?>
	</li>
</li>
<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<img src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" class="user-image" alt="User Image">
		<span class="hidden-xs"><?echo isset($userinfo['username']) ? $userinfo['username']: "Data Error:@param:userinfo";?></span>
	</a>
	<ul class="dropdown-menu">
		<!-- User image -->
		<li class="user-header">
			<img src="<?echo base_url('/public/avatar/')?>/<?=$userinfo['avatar'];?>" class="img-circle" alt="User Image">
			<p>
				<?echo isset($userinfo['username']) ? $userinfo['username']: "Data Error:@param:userinfo";?> - <?=$this->User_group_model->get_user_gruop_name($userinfo['group_id']);?>
				<small><?=$userinfo['college'];?> - <?=$userinfo['majoryear'];?> 届</small>
			</p>
		</li>
		<!-- Menu Body -->
		<li class="user-body">
			<div class="col-xs-4 text-center">
				<a href="#">关注</a>
			</div>
			<div class="col-xs-4 text-center">
				<a href="#">好友</a>
			</div>
			<div class="col-xs-4 text-center">
				<a href="#">班级</a>
			</div>
		</li>
		<!-- Menu Footer-->
		<li class="user-footer">
			<div class="pull-left">
				<a href="<?=base_url('user/profile');?>" class="btn btn-default btn-flat">个人中心</a>
			</div>
			<div class="pull-right">
				<a href="<?=base_url('login/loginout');?>" class="btn btn-default btn-flat">注销</a>
			</div>
		</li>
	</ul>
</li>
<!-- Control Sidebar Toggle Button -->
<li>
	<a href="<?=base_url('login/loginout');?>"><i class="fa fa-times"></i></a>
</li>
<!--<li>-->
<!--	<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
<!--</li>-->
</ul>
</div>

</nav>
</header>