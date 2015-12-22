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
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="<?php echo base_url('/favicon.png');?>" rel="icon" type="image/x-icon" />
	<title><?echo $pageheaderinfo[0][0];?> - 学生管理系统 Stumanager</title>
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
	<!-- sco.message -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/sco/css/sco.message.css');?>">
	<!-- pace.js -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/pace/themes/blue/pace-theme-center-simple.css');?>">
	<!-- table -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/bootstrap-table/bootstrap-table.min.css');?>">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>">
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
	<style>
	</style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">

<!-- Logo -->
<a href="index2.html" class="logo">
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
<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-envelope-o"></i>
		<span class="label label-success">4</span>
	</a>
	<ul class="dropdown-menu">
		<li class="header">You have 4 messages</li>
		<li>
			<!-- inner menu: contains the actual data -->
			<ul class="menu">
				<li><!-- start message -->
					<a href="#">
						<div class="pull-left">
							<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user2-160x160.jpg" class="img-circle" alt="User Image">
						</div>
						<h4>
							Support Team
							<small><i class="fa fa-clock-o"></i> 5 mins</small>
						</h4>
						<p>Why not buy a new awesome theme?</p>
					</a>
				</li><!-- end message -->
				<li>
					<a href="#">
						<div class="pull-left">
							<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user3-128x128.jpg" class="img-circle" alt="User Image">
						</div>
						<h4>
							AdminLTE Design Team
							<small><i class="fa fa-clock-o"></i> 2 hours</small>
						</h4>
						<p>Why not buy a new awesome theme?</p>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="pull-left">
							<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg" class="img-circle" alt="User Image">
						</div>
						<h4>
							Developers
							<small><i class="fa fa-clock-o"></i> Today</small>
						</h4>
						<p>Why not buy a new awesome theme?</p>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="pull-left">
							<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user3-128x128.jpg" class="img-circle" alt="User Image">
						</div>
						<h4>
							Sales Department
							<small><i class="fa fa-clock-o"></i> Yesterday</small>
						</h4>
						<p>Why not buy a new awesome theme?</p>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="pull-left">
							<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg" class="img-circle" alt="User Image">
						</div>
						<h4>
							Reviewers
							<small><i class="fa fa-clock-o"></i> 2 days</small>
						</h4>
						<p>Why not buy a new awesome theme?</p>
					</a>
				</li>
			</ul>
		</li>
		<li class="footer"><a href="#">See All Messages</a></li>
	</ul>
</li>
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-bell-o"></i>
		<span class="label label-warning">10</span>
	</a>
	<ul class="dropdown-menu">
		<li class="header">You have 10 notifications</li>
		<li>
			<!-- inner menu: contains the actual data -->
			<ul class="menu">
				<li>
					<a href="#">
						<i class="fa fa-users text-aqua"></i> 5 new members joined today
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-users text-red"></i> 5 new members joined
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-shopping-cart text-green"></i> 25 sales made
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-user text-red"></i> You changed your username
					</a>
				</li>
			</ul>
		</li>
		<li class="footer"><a href="#">View all</a></li>
	</ul>
</li>
<!-- Tasks: style can be found in dropdown.less -->
<li class="dropdown tasks-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-flag-o"></i>
		<span class="label label-danger">9</span>
	</a>
	<ul class="dropdown-menu">
		<li class="header">You have 9 tasks</li>
		<li>
			<!-- inner menu: contains the actual data -->
			<ul class="menu">
				<li><!-- Task item -->
					<a href="#">
						<h3>
							Design some buttons
							<small class="pull-right">20%</small>
						</h3>
						<div class="progress xs">
							<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">20% Complete</span>
							</div>
						</div>
					</a>
				</li><!-- end task item -->
				<li><!-- Task item -->
					<a href="#">
						<h3>
							Create a nice theme
							<small class="pull-right">40%</small>
						</h3>
						<div class="progress xs">
							<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">40% Complete</span>
							</div>
						</div>
					</a>
				</li><!-- end task item -->
				<li><!-- Task item -->
					<a href="#">
						<h3>
							Some task I need to do
							<small class="pull-right">60%</small>
						</h3>
						<div class="progress xs">
							<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">60% Complete</span>
							</div>
						</div>
					</a>
				</li><!-- end task item -->
				<li><!-- Task item -->
					<a href="#">
						<h3>
							Make beautiful transitions
							<small class="pull-right">80%</small>
						</h3>
						<div class="progress xs">
							<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">80% Complete</span>
							</div>
						</div>
					</a>
				</li><!-- end task item -->
			</ul>
		</li>
		<li class="footer">
			<a href="#">View all tasks</a>
		</li>
	</ul>
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
			<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user9-400x400.jpg" class="img-circle" alt="User Image">
			<p>
				<?echo isset($userinfo['username']) ? $userinfo['username']: "Data Error:@param:userinfo";?> - Web Developer
				<small>Member since Nov. 2015</small>
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
				<a href="#" class="btn btn-default btn-flat">个人中心</a>
			</div>
			<div class="pull-right">
				<a href="<?=base_url('login/loginout');?>" class="btn btn-default btn-flat">注销</a>
			</div>
		</li>
	</ul>
</li>
<!-- Control Sidebar Toggle Button -->
<li>
	<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>
</ul>
</div>

</nav>
</header>