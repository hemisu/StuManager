<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/14
 * Time: 下午7:46
 * sidebar.php
 * 侧边栏
 **/
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user9-400x400.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?echo isset($userinfo['username']) ? $userinfo['username']: "Data Error:@param:userinfo";?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...暂时无法使用">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">主导航</li>
			<li <?if($method_name=='dashboard')echo 'class="active"';?>>
				<a href="<?echo base_url('welcome/dashboard');?>">
					<i class="fa fa-dashboard"></i> <span>总览</span>
				</a>
			</li>
			<li <?if($method_name=='profile')echo 'class="active"';?>>
				<a href="<?echo base_url('user/profile');?>">
					<i class="fa fa-desktop"></i> <span>个人中心</span>
				</a>
			</li>
			<li <?if($controller_name=='circle')echo 'class="active"';?>>
				<a href="<?echo base_url('circle');?>">
					<i class="fa fa-group"></i> <span>班级圈</span>
				</a>
			</li>
			<li class="treeview  <?if($controller_name=='message')echo 'active';?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>消息</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?if($method_name=='index')echo 'class="active"';?>>
						<a href="<?echo base_url('message');?>"><i class="fa fa-circle-o"></i> 消息列表
							<small class="label pull-right label-primary">2</small>
						</a>
					</li>
					<li <?if($method_name=='send')echo 'class="active"';?>>
						<a href="<?echo base_url('message/send');?>"><i class="fa fa-circle-o"></i> 发送消息
						</a>
					</li>
				</ul>
			</li>
			<li <?if($controller_name=='file')echo 'class="active"';?>>
				<a href="<?echo base_url('file');?>">
					<i class="fa fa-folder"></i> <span>资料库</span>
				</a>
			</li>
			<li <?if($controller_name=='task')echo 'class="active"';?>>
				<a href="<?echo base_url('task');?>">
					<i class="fa fa-tasks"></i> <span>待办事项</span>
					<small class="label pull-right bg-red">2</small>
				</a>
			</li>
			<li class="treeview  <?if( ($controller_name == 'user')&&($method_name != 'profile'))echo 'active';?>">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>用户</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?if($method_name=='multilist')echo 'class="active"';?>>
						<a href="<?echo base_url('user/multilist');?>"><i class="fa fa-circle-o"></i> 用户列表</a>
					</li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cog"></i> <span>管理</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li><a href="index.html"><i class="fa fa-circle-o"></i> 操作日志</a></li>
					<li>
						<a href="#"><i class="fa fa-circle-o"></i> 用户管理 <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> 添加用户</a></li>
							<li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> 用户管理</a></li>
							<li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> 管理用户组</a></li>
							<li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> 用户资料汇总</a></li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-circle-o"></i> 内容管理 <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li <?if($controller_name=='admin'&&$method_name=='announce')echo 'class="active"';?>>
								<a href="<?=base_url('admin/announce');?>"><i class="fa fa-circle-o"></i> 公告管理</a>
							</li>
							<li><a href="index2.html"><i class="fa fa-circle-o"></i> 待办事项管理</a></li>
							<li><a href="index2.html"><i class="fa fa-circle-o"></i> 附件管理</a></li>
						</ul>
					</li>
					<li><a href="index2.html"><i class="fa fa-circle-o"></i> 数据库管理</a></li>
				</ul>
			</li>
			<li class="header">标签</li>
			<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
			<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
			<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>