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
			<div class="ibox-title">
				<h5>所有项目</h5>
				<div class="ibox-tools">
					<a href="projects.html" class="btn btn-primary btn-xs">创建新项目</a>
				</div>
			</div>
			<div class="ibox-content">
			<div class="row m-b-sm m-t-sm">
				<div class="col-md-1">
					<button type="button" id="loading-example-btn" class="btn btn-white btn-sm" onclick="javascript:window.top.location.reload()"><i class="fa fa-refresh"></i> 刷新</button>
				</div>
				<div class="col-md-11">
					<div class="input-group">
						<input type="text" placeholder="请输入项目名称" class="input-sm form-control"> <span class="input-group-btn">
			      <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
					</div>
				</div>
			</div>

			<div class="project-list">
				<div class="table-responsive">
				<?echo $tasklist;?>
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
</body>
</html>
