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
	<title>AdminLTE 2 | Dashboard</title>
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
	<style>
		hr {
			margin-top: 10px;
			margin-bottom: 10px;
			border: 0;
			border-top: 1px solid #eee;
		}
		/**班级圈**/
		.social-feed-box {
			border: 1px solid #e7eaec;
			background: #fff;
			margin-bottom: 15px;
		}
		.social-action {
			margin: 15px;
		}
		.social-avatar .media-body a {
			font-size: 14px;
			display: block;
		}
		.btn-white {
			color: inherit;
			background: #fff;
			border: 1px solid #e7eaec;
		}
		.btn-white.active,.btn-white:active,.btn-white:focus,.btn-white:hover {
			color:inherit;
			border:1px solid #d2d2d2
		}
		.btn-white.active,.btn-white:active {
			box-shadow:0 2px 5px rgba(0,0,0,.15)inset
		}
		.m-t-xs {
			margin-top: 5px;
		}
		.m-b-sm {
			margin-bottom: 10px;
		}
		.m-t-sm {
			margin-top: 10px;
		}
		.media-body {
			display: block;
			width: auto;
		}
		.text-muted {
			color: #777;
		}
		.social-body {
			padding: 15px;
		}
		.social-avatar {
			padding: 15px 15px 0;
		}
		.social-avatar img {
			height: 40px;
			width: 40px;
			margin-right: 10px;
		}
		.social-footer .social-comment img {
			width: 32px;
			margin-right: 10px;
		}
		.social-footer {
			border-top: 1px solid #e7eaec;
			padding: 10px 15px;
			background: #f9f9f9;
		}
		.social-comment:first-child {
			margin-top: 0;
		}
		.social-comment {
			margin-top: 15px;
		}
		/**file_manager**/

		.ibox {
			clear: both;
			margin-bottom: 25px;
			margin-top: 0;
			padding: 0;
		}
		.ibox-content {
			background-color: #fff;
			color: inherit;
			padding: 15px 20px 20px;
			border-color: #e7eaec;
			-webkit-border-image: none;
			-o-border-image: none;
			border-image: none;
			border-style: solid solid none;
			border-width: 1px 0;
			clear: both;
		}
		.ibox-title {
			-moz-border-bottom-colors: none;
			-moz-border-left-colors: none;
			-moz-border-right-colors: none;
			-moz-border-top-colors: none;
			background-color: #fff;
			border-color: #e7eaec;
			-webkit-border-image: none;
			-o-border-image: none;
			border-image: none;
			border-style: solid solid none;
			border-width: 4px 0 0;
			color: inherit;
			margin-bottom: 0;
			padding: 14px 15px 7px;
			min-height: 48px;
		}
		.ibox-title h5 {
			display: inline-block;
			font-size: 14px;
			margin: 0 0 7px;
			padding: 0;
			text-overflow: ellipsis;
			float: left;
		}

		.ibox-tools {
			display: inline-block;
			float: right;
			margin-top: 0;
			position: relative;
			padding: 0;
		}
		.project-list table tr td {
			border-top: none;
			border-bottom: 1px solid #e7eaec;
			padding: 15px 10px;
			vertical-align: middle;
		}
		.file-manager {
			list-style: none outside none;
			margin: 0;
			padding: 0;
		}
		.file-control.active {
			text-decoration: underline;
		}
		.file-control {
			color: inherit;
			font-size: 11px;
			margin-right: 10px;
		}
		.file-manager .hr-line-dashed {
			margin: 15px 0;
		}
		.folder-list li {
			border-bottom: 1px solid #e7eaec;
			display: block;
		}
		.folder-list li a {
			color: #666;
			display: block;
			padding: 5px 0;
		}
		.folder-list li i {
			margin-right: 8px;
			color: #3d4d5d;
		}
		.tag-list li {
			float: left;
		}
		.tag-list li a {
			font-size: 10px;
			background-color: #f3f3f4;
			padding: 5px 12px;
			color: inherit;
			border-radius: 2px;
			border: 1px solid #e7eaec;
			margin-right: 5px;
			margin-top: 5px;
			display: block;
		}
		ul.tag-list li {
			list-style: none;
		}
		.file-box {
			float: left;
			width: 220px;
		}
		.file {
			border: 1px solid #e7eaec;
			padding: 0;
			background-color: #fff;
			position: relative;
			margin-bottom: 20px;
			margin-right: 20px;
		}
		.corner {
			position: absolute;
			display: inline-block;
			width: 0;
			height: 0;
			line-height: 0;
			border: .6em solid transparent;
			border-right: .6em solid #f1f1f1;
			border-bottom: .6em solid #f1f1f1;
			right: 0;
			bottom: 0;
		}
		.file .icon {
			padding: 15px 10px;
			text-align: center;
		}
		.file .icon, .file .image {
			height: 100px;
			overflow: hidden;
		}
		.file .file-name {
			padding: 10px;
			background-color: #f8f8f8;
			border-top: 1px solid #e7eaec;
		}
		.file .icon i {
			font-size: 70px;
			color: #dadada;
		}
		.project-people img {
			width: 32px;
			height: 32px;
		}
		.img-circle {
			border-radius: 50%;
		}
		.img-circle {
			border-radius: 50%;
		}
		img {
			vertical-align: middle;
		}
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
		<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user9-400x400.jpg" class="user-image" alt="User Image">
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
				<a href="#" class="btn btn-default btn-flat">注销</a>
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