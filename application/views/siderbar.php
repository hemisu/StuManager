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
		<?echo $sider_ul_list;?>
	</section>
	<!-- /.sidebar -->
</aside>

