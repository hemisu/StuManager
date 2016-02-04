<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="<?echo base_url();?>/favicon.png" rel="icon" type="image/x-icon" />
	<title>教务系统账号登录 - 学生管理系统 StuManager</title>
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
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/iCheck/square/blue.css');?>">
	<!-- bootstrapValidator -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/bootstrap-validator/css/bootstrapValidator.css');?>">
	<!-- sco.message -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/sco/css/sco.message.css');?>">
	<!-- pace.js -->
	<link rel="stylesheet" href="<?php echo base_url('/public/AdminLTE2/plugins/pace/themes/blue/pace-theme-flash.css');?>">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="<?php echo base_url('/public/AdminLTE2/dist/js/html5shiv.min.js');?>"></script>
	<script src="<?php echo base_url('/public/AdminLTE2/dist/js/respond.min.js');?>"></script>
	<![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box animated fadeInUp">
	<div class="register-logo">
		<a href="#">Stu<b>Manager</a>
	</div>

	<div class="register-box-body">
		<p class="login-box-msg">教务系统账号登陆</p>
		<?//跨站请求伪造
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		?>
		<form action="<?echo base_url('Jw/binding')?>" id="bindingForm" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="student_id" placeholder="学号">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" placeholder="密码">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<!-- A trigger modal -->
							<input type="checkbox" name="acceptTerms" id="acceptTerms">
							我同意协议 <a href="#" data-toggle="modal" data-target="#agreementModal">点击查看</a>
						</label>
					</div>
				</div><!-- /.col -->
				<div class="col-xs-4">
					<button id="submitButton" type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
				</div><!-- /.col -->
			</div>
		</form>
		<a href="<?php echo base_url('login');?>" class="text-center">我已经有账号了</a>
	</div><!-- /.form-box -->
</div><!-- /.register-box -->

<!-- Modal -->
<div class="modal fade" id="agreementModal" tabindex="-1" role="dialog" aria-labelledby="绑定教务系统账号协议">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">绑定教务系统账号用户协议</h4>
			</div>
			<div class="modal-body">
				<h3>一、总则</h3>
				<ul class="list-unstyled">
					<li>1.1 用户在绑定之前，应当仔细阅读本协议，并同意遵守本协议后方可成为完成账号绑定。一旦绑定成功，用户应当受本协议的约束。用户在使用时，应当同意接受相关协议后方能使用。</li>
					<li>1.3 本协议则可由本站随时更新，用户应当及时关注并同意本站不承担通知义务。本站的通知、公告、声明或其它类似内容是本协议的一部分。</li>
				</ul>
				<h3>二、用户帐号</h3>
				<ul class="list-unstyled">
					<li>2.1 用户只能按照注册要求使用真实姓名，及身份证号注册。用户有义务保证密码和帐号的安全，用户利用该密码和帐号所进行的一切活动引起的任何损失或损害，由用户自行承担全部责任，本站不承担任何责任。</li>
					<li>2.2 如用户发现帐号遭到未授权的使用或发生其他任何安全问题，应立即修改帐号密码并妥善保管，如有必要，请通知本站。因黑客行为或用户的保管疏忽导致帐号非法使用，本站不承担任何责任。</li>
					<li>2.3 本站不会查看和保存用户的教务系统账号密码，仅在需要获取信息时提示登陆。</li>
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" id="modalClose" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" id="agreementBottom" class="btn btn-primary" data-dismiss="modal">同意</button>
			</div>
		</div>
	</div>
</div>
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
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/dist/js/demo.js"></script>
<!-- bootstrapValidator -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
<!-- sco.message -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/sco/js/sco.message.js"></script>

<!-- iCheck -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/iCheck/icheck.min.js"></script>

<script>
	$(document).ready(function(){
		$('#agreementBottom').click(function () {
			$('#acceptTerms').iCheck('check');
		});
		$('#modalClose').click(function () {
			$('#acceptTerms').iCheck('uncheck');
		});
		$('#bindingForm').bootstrapValidator({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				student_id: {
					validators: {
						notEmpty: {
							message: '学号不能为空'
						},
						stringLength: {
							min: 10,
							max: 10,
							message: '学号为10位'
						},
						regexp: {
							regexp: /^[0-9]+$/,
							message: '学号只能是数字'
						}
					}
				},
				password: {
					validators: {
						notEmpty: {
							message: '密码不能为空'
						}
					}
				},
				acceptTerms: {
					validators: {
						notEmpty: {
							message: '需要同意协议'
						}
					}
				}
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
					if (result.response == false) {

						$.scojs_message(result.recontent, $.scojs_message.TYPE_ERROR);
//						$('#bindingForm').data('formValidation').resetForm();

					} else {
						console.log(result);
						$.scojs_message(result.username + '&nbsp;,欢迎登陆', $.scojs_message.TYPE_OK);
						$.GoUrl(result.next_url, 1);
					}
				}, 'json');
			})
			.find('input[name="acceptTerms"]')
			// Init icheck elements
			.iCheck({
				// The tap option is only available in v2.0
				tap: true,
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			})
			// Called when the radios/checkboxes are changed
			.on('ifChanged', function (e) {
				// Get the field name
				var field = $(this).attr('name');
				$('#bindingForm').bootstrapValidator('revalidateField', field);
			})
			.end();
	});
</script>


</body>
</html>
