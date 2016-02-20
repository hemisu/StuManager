<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/12/6
 * Time: 下午8:33
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">学业成绩</h3>
					<div class="box-tools pull-right">
					</div>
				</div><!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="table-responsive">
						<table class="table table-striped">
							<tr>
								<th>学年</th>
								<th>学期</th>
								<th>课程代码</th>
								<th>课程名称</th>
								<th>课程性质</th>
								<th>学分</th>
								<th>绩点</th>
								<th>成绩</th>
								<th>辅修标记</th>
								<th>补考成绩</th>
								<th>重修成绩</th>
								<th>学院名称</th>
								<th>重修标记</th>
							</tr>
							<?foreach($scoreinfo as $k){
								echo '<tr>';
								unset($k['student_id']);
								unset($k['score_id']);
								foreach($k as $v){
									echo '<td>'.$v.'</td>';
								}
								echo '</tr>';
							}?>

						</table>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
				</div><!-- /.box-booter -->
			</div><!-- /.box -->
		</div><!-- /.col-->
	</div><!-- ./row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<?require_once(dirname(__FILE__)."/"."../footer.php");?>

<!-- ./wrapper -->

</body>
</html>
