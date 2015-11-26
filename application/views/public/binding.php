<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Log in</title>
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
<div class="register-box">
	<div class="register-logo">
		<a href="../../index2.html">Stu<b>Manager</a>
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
		<a href="<?php echo base_url('welcome/index');?>" class="text-center">我已经有账号了</a>
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
<!-- require.js -->
<script data-main="<?php echo base_url('/public/AdminLTE2/common');?>" src="<?php echo base_url('/public/AdminLTE2/require.js');?>"></script>
<script src="<?php echo base_url();?>public/js/<?php echo $controller_name?>.js"></script>

</body>
</html>
