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
					<h3 class="box-title">等级考试成绩</h3>
					<div class="box-tools pull-right">
					</div>
				</div><!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="table-responsive">
						<table class="table table-striped">
							<tr>
								<th>学年</th>
								<th>学期</th>
								<th>等级考试名称</th>
								<th>准考证号</th>
								<th>考试日期</th>
								<th>成绩</th>
								<th>听力成绩</th>
								<th>阅读成绩</th>
								<th>写作成绩</th>
								<th>综合成绩</th>
							</tr>
							<?foreach($scoreinfo as $k){
								echo '<tr>';
								unset($k['student_id']);
								unset($k['ranktest_id']);
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
