<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/22
 * Time: 下午5:23
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<? echo $pageheader; ?>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="social-feed-box">
					<div style="padding:15px;">
						<form id="circleForm" action="<? echo current_url(); ?>" method="post">
							<div class="form-group">
								<textarea class="textarea" name="content" placeholder="请输入内容"
								          style="width: 100%; height: 60px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
							</div>
							<div class="form-group">
								<label>
									<input type="checkbox" name="anonymous" value="1"> 匿名
								</label>
							</div>
							<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> 提交</button>
						</form>
					</div>
				</div>
				<?= $circle_list;?>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<? require_once(dirname(__FILE__) . "/" . "../footer.php"); ?>

<!-- ./wrapper -->
<!-- Bootstrap WYSIHTML5 -->
<script
	src="<?php echo base_url('/public/AdminLTE2'); ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('/public/AdminLTE2/plugins/iCheck/icheck.min.js'); ?>"></script>
<script>
	$(document).ready(function () {
		$(".textarea").wysihtml5();
		$('#circleForm').bootstrapValidator({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				content: {
					validators: {
						notEmpty: {
							message: '内容不能为空'
						}
					}
				},
				anonymous: {}
			}
		})
			.on('success.form.bv', function (e) {
				// Prevent form submission
				e.preventDefault();

				// Get the form instance
				var $form = $(e.target);

				// Get the BootstrapValidator instance
				var bv = $form.data('bootstrapValidator');

				// Use Ajax to submit form data
				$.post($form.attr('action'), $form.serialize(), function (result) {
					if (result.status == false) {
						$.scojs_message(result.tips, $.scojs_message.TYPE_ERROR);
						$('#loginForm').data('bootstrapValidator').resetForm();
					} else {
						console.log(result);
						$.scojs_message(result.tips, $.scojs_message.TYPE_OK);
						$.GoUrl(result.next_url, 1);
					}
				}, 'json');
			})
			.end();
		$(".commentbtn").on('click',function(){
			var circle_commentid = $(this).data('circle-commentid');
			var comment_html = '<div class="social-footer animated fadeInDown"> ' +
				'<div class="social-comment">' +
				'<a href="" class="pull-left"> ' +
				'<img alt="image" src="'+SITE_URL+'/public/avatar/'+student_id+'.jpg"> ' +
			'</a> ' +

			' <div class="media-body"> ' +
			'<form id="comment-'+circle_commentid+'" action="'+CURRENT_URL+'" method="post">'+
			'<input name="parent_id" type="hidden" value="'+circle_commentid+'">'+
			'<textarea class="form-control" name="content" placeholder="填写评论..."></textarea> ' +
			'<button type="submit" class="btn btn-primary" style="margin-top: 5px;"><i class="fa fa-pencil"></i> 提交</button> '+
			'	<label> '+
			'	<input type="checkbox" name="anonymous" value="1"> 匿名'+
			' </label> '+
			'</form></div> ' +
			'</div> ' +
			'</div>';
			$(this).attr("disabled","disabled");
			$(this).parent().parent().after(comment_html);
			$('form').bootstrapValidator({
				framework: 'bootstrap',
				icon: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					content: {
						validators: {
							notEmpty: {
								message: '内容不能为空'
							}
						}
					},
					anonymous: {}
				}
			})
				.on('success.form.bv', function (e) {
					// Prevent form submission
					e.preventDefault();

					// Get the form instance
					var $form = $(e.target);

					// Get the BootstrapValidator instance
					var bv = $form.data('bootstrapValidator');

					// Use Ajax to submit form data
					$.post($form.attr('action'), $form.serialize(), function (result) {
						if (result.status == false) {
							$.scojs_message(result.tips, $.scojs_message.TYPE_ERROR);
							$('#loginForm').data('bootstrapValidator').resetForm();
						} else {
							console.log(result);
							$.scojs_message(result.tips, $.scojs_message.TYPE_OK);
							$.GoUrl(result.next_url, 1);
						}
					}, 'json');
				})
				.end();
			console.log(circle_commentid);
		})
		.end();
	});
</script>
</body>
</html>
