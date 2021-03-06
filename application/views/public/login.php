<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="<?echo base_url();?>/favicon.png" rel="icon" type="image/x-icon" />
	<title>登录 - 学生管理系统 StuManager </title>
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
		<p class="login-box-msg">登陆</p>
		<form id="loginForm" action="<?echo base_url('login/login')?>" method="post">
			<?//跨站请求伪造
			$csrf = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);
			?>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="student_id" placeholder="学号" <?if($student_id)echo 'value="'.$student_id.'"';?>>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" placeholder="密码">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<div id="popup-captcha"></div>
			</div>

			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck hidden">
						<label>
							<input type="checkbox" name="remembermyid" <?if($student_id)echo 'checked';?>> 记住我的账号
						</label>
					</div>
				</div><!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" id="popup-submit" class="btn btn-primary btn-block btn-flat">提交</button>
				</div><!-- /.col -->
			</div>
		</form>

		<div class="social-auth-links text-center">
			<p>- OR -</p>
			<a href="<?php echo base_url('login/binding');?>" class="btn btn-block btn-social btn-github"><i class="fa fa-user-plus" style="font-size: 13px;"></i>教务系统账号登陆</a>
		</div>
		<!-- /.social-auth-links-->

		<a href="<?=base_url('login/forget');?>">忘记密码?</a><br>
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
<!-- 引入封装了failback的接口--initGeetest -->
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script>
	var SITE_URL = "<?echo SITE_BASE;?>";//SITE_URL
	$(document).ready(function(){
		var handlerPopup = function (captchaObj) {
			$("#popup-submit").click(function () {
				var validate = captchaObj.getValidate();
				if (!validate) {
					$.scojs_message('请完成验证', $.scojs_message.TYPE_ERROR);
					$('#loginForm').data('bootstrapValidator').resetForm();
				}
			});
			// 弹出式需要绑定触发验证码弹出按钮
			captchaObj.bindOn("#popup-submit");
			// 将验证码加到id为captcha的元素里
			captchaObj.appendTo("#popup-captcha");
			// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
		};
		$.ajax({
			// 获取id，challenge，success（是否启用failback）
			url: SITE_URL+"api/gt/", // 加随机数防止缓存
			type: "get",
			dataType: "json",
			success: function (data) {
				// 使用initGeetest接口
				// 参数1：配置参数
				// 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
				initGeetest({
					gt: data.gt,
					challenge: data.challenge,
					product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
					offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
				}, handlerPopup);
			}
		});

		$('#loginForm').bootstrapValidator({
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
				remembermyid:{

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
						$.scojs_message(result.username + '&nbsp;,欢迎登陆', $.scojs_message.TYPE_OK);
						$.GoUrl(result.next_url, 1);
					}
				}, 'json');
			})
			.find('input[name="remembermyid"]')
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
				$('#loginForm').bootstrapValidator('revalidateField', field);
			})
			.end();
		$('.hidden').removeClass('hidden');//渲染后显示

	});
</script>
</body>
</html>
