<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="<?echo base_url();?>/favicon.png" rel="icon" type="image/x-icon" />
	<title>忘记密码 - 学生管理系统 StuManager </title>
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
<body class="hold-transition login-page">
<div class="login-box animated fadeInUp">
	<div class="login-logo">
		<a href="#">Stu<b>Manager</b></a>
	</div><!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">忘记密码</p>
		<form id="forgetForm" action="<?echo current_url()?>" method="post">
			<?//跨站请求伪造
			$csrf = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);
			?>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="student_id" <?if($student_id)echo 'value="'.$student_id.'"';?> disabled>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" placeholder="新密码">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			<div class="row">
				<div class="col-xs-8">
				</div><!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">提交</button>
				</div><!-- /.col -->
			</div>
		</form>
		<!-- /.social-auth-links-->

	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('/public/AdminLTE2/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url('/public/AdminLTE2/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- bootstrapValidator -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/dist/js/demo.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/fastclick/fastclick.min.js"></script>
<!-- bootstrapValidator -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
<!-- sco.message -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/sco/js/sco.message.js"></script>

<!-- iCheck -->
<script src="<?php echo base_url('/public/AdminLTE2/plugins/iCheck/icheck.min.js');?>"></script>
<script>
	$(document).ready(function(){
		$('#forgetForm').bootstrapValidator({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				password: {
					notEmpty: {
						newpassword: '新密码不能为空'
					},
					identical: {
						field: 'confirmPassword',
						message: '新密码需和重复密码不相同'
					},
					callback: {
						newpassword: '密码不符合要求',
						callback: function(value, validator, $field) {
							if (value === '') {
								return true;
							}

							// Check the password strength
							if (value.length < 6) {
								return {
									valid: false,
									message: '密码需要长于6位才足够安全哦'
								};
							}

							//// The password doesn't contain any uppercase character
							//if (value === value.toLowerCase()) {
							//	return {
							//		valid: false,
							//		message: '密码至少需要一位大写字母才足够安全哦'
							//	}
							//}
							//
							//// The password doesn't contain any uppercase character
							//if (value === value.toUpperCase()) {
							//	return {
							//		valid: false,
							//		message: '密码至少需要一位小写字母才足够安全哦'
							//	}
							//}

							// The password doesn't contain any digit
							if (value.search(/[0-9]/) < 0) {
								return {
									valid: false,
									message: '密码至少需要有一个数字才足够安全哦'
								}
							}

							return true;
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
					if (result.status == false) {
						$.scojs_message(result.tips, $.scojs_message.TYPE_ERROR);
						$('#loginForm').data('bootstrapValidator').resetForm();
					}else{
						console.log(result);
						$.scojs_message('密码修改成功,请重新登录', $.scojs_message.TYPE_OK);
						$.GoUrl(result.next_url, 1);
					}
				}, 'json');
			})
			.end();
	});
</script>
</body>
</html>
