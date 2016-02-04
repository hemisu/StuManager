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
				<div class="ibox-content">
				<div class="row">
					<div class="col-sm-12">
						<div class="m-b-md">
							<a href="<?=base_url('task/detail/task_id').'/'.$taskinfo['task_id'];?>" class="btn btn-white btn-xs pull-right">返回项目详情</a>
							<h2><?=$taskinfo['title']?></h2>
						</div>
						<dl class="dl-horizontal">
							<dt>状态：</dt>
							<dd><span class="label label-<?
								switch($taskinfo['status']){
									case '进行中' : echo 'danger';break;
									case '已完成' : echo 'success';break;
									default:break;
								}
							?>"><?=$taskinfo['status']?></span>
							</dd>
						</dl>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<dl class="dl-horizontal">
							<dt>发布人：</dt>
							<dd><?=$taskinfo['author']?></dd>
							<dt>用户组：</dt>
							<dd><?=$this->User_group_model->get_user_gruop_name($taskinfo['group_id'])?></dd>
						</dl>
					</div>
					<div class="col-sm-7" id="cluster_info">
						<dl class="dl-horizontal">
							<dt>创建于：</dt>
							<dd><?=$taskinfo['posttime']?></dd>
							<dt>截止于：</dt>
							<dd><?=$taskinfo['deadtime']?></dd>
						</dl>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<dl class="dl-horizontal">
							<dt>当前进度</dt>
							<dd>
								<div class="progress progress-striped active m-b-sm">
									<div style="width: <?=$taskinfo['progress']?>%;" class="progress-bar"></div>
								</div>
								<small>当前已完成总进度的 <strong><?=$taskinfo['progress']?>%</strong></small>
							</dd>
						</dl>
						<strong><h3>内容:</h3></strong>
						<hr />
						<p><?=$taskinfo['description'];?></p>
						<?=$statistictable;?>
						<hr />
					</div>
				</div>
				<div class="row m-t-sm">
					<div class="col-sm-12">
						<form id="infoForm" method="post" action="<?=current_url();?>" class="form-horizontal">
							<?//跨站请求伪造
							$csrf = array(
								'name' => $this->security->get_csrf_token_name(),
								'hash' => $this->security->get_csrf_hash()
							);
							?>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="form-group">
								<label class="col-xs-2 control-label">未到校人员信息：</label>
								<div class="col-xs-3">
									<select class="username-ajax form-control" name="info[0][student_id]">
									</select>
								</div>
								<div class="col-xs-3">
									<select class="form-control" name="info[0][reason]">
										<option value="请假">请假</option>
										<option value="正在途中">正在途中</option>
										<option value="未联系上">未联系上</option>
									</select>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="info[0][remark]" placeholder="备注" />
								</div>
								<div class="col-xs-1">
									<button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
								</div>
							</div>

							<!-- The template for adding new field -->
							<div class="form-group hide" id="infoTemplate">
								<div class="col-xs-3 col-xs-offset-2">
									<select class="student_id-ajaxs form-control" name="student_id">
									</select>
								</div>
								<div class="col-xs-3">
									<select class="form-control" name="reason">
										<option value="请假">请假</option>
										<option value="正在途中">正在途中</option>
										<option value="未联系上">未联系上</option>
									</select>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="remark" placeholder="备注" />
								</div>
								<div class="col-xs-1">
									<button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12">
									<button type="submit" class="btn btn-info btn-block">提交</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
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
<!-- bootstrapValidator -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
<!-- sco.message -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/sco/js/sco.message.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/select2/select2.full.min.js"></script>
<!-- smart-time-ago -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/smart-time-ago/timeago.js"></script>
<script>
	$(document).ready(function() {
		$('body').timeago();
		//删除
		$('.del').click(function(){
			var staid=$(this).data('statistic-id');
			var stausername=$(this).data('statistic-username');
			$.ajax({
				type: 'get',
				url: '<?=base_url('task/returnleave_statistic_delete');?>',
				data: {'id' : staid,'username':stausername,'task_id':'<?=$taskinfo['task_id'];?>'} ,
				dataType:'json',
				success:function(result) {
					if (result.response == false ) {
						$.scojs_message('删除失败', $.scojs_message.TYPE_ERROR);
					} else {
						console.log(result);
						$.scojs_message('删除成功', $.scojs_message.TYPE_OK);
					}
				}
			});
			console.log(staid);
			$(this).parent().parent().remove();
		})

		var nameValidators = {
				row: '.col-xs-3',   // The title is placed inside a <div class="col-xs-4"> element
				validators: {
					notEmpty: {
						message: '姓名不能为空'
					}
				}
			},
			reasonValidators = {
				row: '.col-xs-3',
				validators: {
					notEmpty: {
						message: '原因不能为空'
					}
				}
			},
			remarkValidators = {
				row: '.col-xs-3',
				validators: {
					notEmpty: {
						message: '填写备注'
					}

				}
			},
			infoIndex = 0;

		$('#infoForm')
			.find('[name="info[0][student_id]"]')
			.select2({
				placeholder: "输入姓名",
				ajax: {
					url: '<?=base_url('task')?>/user_username_json',
					delay: 250,
					dataType: 'json',
					processResults: function (data) {
						return {
							results: data
						};
					}
				}
			})
			.end()
			.bootstrapValidator({
				framework: 'bootstrap',
				icon: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					'info[0].student_id': nameValidators,
					'info[0].reason': reasonValidators,
					'info[0].remark': remarkValidators
				}
			})

			// Add button click handler
			.on('click', '.addButton', function() {
				infoIndex++;
				var $template = $('#infoTemplate'),
					$clone    = $template
						.clone()
						.removeClass('hide')
						.removeAttr('id')
						.attr('data-info-index', infoIndex)
						.insertBefore($template);

				// Update the name attributes
				$clone
					.find('[name="student_id"]').attr('name', 'info[' + infoIndex + '][student_id]').end()
					.find('[name="reason"]').attr('name', 'info[' + infoIndex + '][reason]').end()
					.find('[name="remark"]').attr('name', 'info[' + infoIndex + '][remark]').end();

				// Add new fields
				// Note that we also pass the validator rules for new field as the third parameter
				$('#infoForm')
					.bootstrapValidator('addField', 'info[' + infoIndex + '][student_id]', nameValidators)
					.find('[name="info[' + infoIndex + '][student_id]"]')
					.select2({
						placeholder: "输入姓名",
						ajax: {
							url: '<?=base_url('task')?>/user_username_json',
							delay: 250,
							dataType: 'json',
							processResults: function (data) {
								return {
									results: data
								};
							}
						}
					})
					.end()
					.bootstrapValidator('addField', 'info[' + infoIndex + '][reason]', reasonValidators)
					.bootstrapValidator('addField', 'info[' + infoIndex + '][remark]', remarkValidators);
			})

			// Remove button click handler
			.on('click', '.removeButton', function() {
				var $row  = $(this).parents('.form-group'),
					index = $row.attr('data-info-index');

				// Remove fields
				$('#infoForm')
					.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][student_id]"]'))
					.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][reason]"]'))
					.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][remark]"]'));

				// Remove element containing the fields
				$row.remove();
			})
			.on('success.form.bv', function (e) {
				// Prevent form submission
				e.preventDefault();

				// Get the form instance
				var $form = $(e.target);

				// Get the BootstrapValidator instance
				var bv = $form.data('bootstrapValidator');

				// Use Ajax to submit form data
				$.ajax({
					url:$form.attr('action'),
					data:$('#infoForm').serialize(),
					dataType:'json',
					type:'post',
					success:function(result){
						if (result.response === false) {

							$.scojs_message('提交失败!' +result.tips, $.scojs_message.TYPE_ERROR);

						} else {
							console.log(result);
							$.scojs_message('提交成功', $.scojs_message.TYPE_OK);
							$.GoUrl(result.next_url, 1);
						}
					}
				});
			})
		;
//http://formvalidation.io/examples/adding-dynamic-field/
	});
</script>
</body>
</html>
