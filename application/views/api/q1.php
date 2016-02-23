<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="<?echo base_url();?>/favicon.png" rel="icon" type="image/x-icon" />
	<title>API - 学生管理系统 StuManager </title>
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
		<p class="login-box-msg">API</p>
		<form id="loginForm" action="<?echo current_url();?>" method="post">
			<?//跨站请求伪造
			$csrf = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);
			?>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="student_id" placeholder="以空格分隔 输入每个人过桥时间">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>

			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			<div class="row">
				<div class="col-xs-8">
				</div><!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">提交</button>
				</div><!-- /.col -->
			</div>
			大头污语一、
			<P>半夜。床上。<br>“你……？”哥哥刚想说些什么，却被一只玉手捂住了嘴。<br>“噓……”妹妹把头凑到哥哥耳边，轻声说：<br>“哥……人家……人家想和你一起……一起……建设中国特色社会主义嘛……”<br>只感到一股社会责任感与民族归属感冲上了他的头，于是双手开始不自觉的对妹妹薄薄的睡衣实行伟大的改革开放政策，牢牢把握一个中心两个基本点；刺激消费扩大内需；<br>让一切创造财富的源泉涌流……<br>“啊……啊……那里不行……我的社会主义核心价值观……要缺失了……”<br>话音未落，哥哥那高速增长的GDP已经在经济特区开始了社会主义现代化建设，深入贯彻落实“三个代表”重要思想，以人为本推动经济社会发展，围绕主题抓住主线，全面提高开放型经济水平，坚持“引进来”和“走出去”相结合的战略，优化结构，&nbsp;拓展深度，极大地促进了社会生产力的发展。<br>而妹妹则结合具体国情新出台了紧缩性财政政策缓解通货膨胀，吸纳了大量社会流动资金，取得了卓越成效。<br>“越来越紧了呢，又促进经济稳定持续增长了呢……”收获了生活水平不断提高的哥哥的一致好评。<br>“啊……啊……为人民服务的工作态度……”妹妹依旧沉浸在爱岗敬业的无限快乐中，“以后……一定要……对人民负责……哦，不然……我可要……建立……信息公开制度……与办事公开……制度了哟。”<br>“呵……明明那么享受中国梦……舆论还不老实……看我不加快转变经济发展方式好好思想教育一下这不听话的妹妹……”<br>于是哥哥直起身来实施创新驱动发展战略，增强创新发展新动力，深化改革，加快转变经济发展方式的主攻方向，促进资本在全球范围内的流动；牢牢扭住经理建设为中心，聚精会神搞建设，一心一意谋发展，推动了城乡发展一体化。<br>妹妹日益增长的物质文化需求终于无法忍受：“啊……啊……要全面建成……小康社会了……实现……共产主义了……好幸福……”<br>“那我也要实现伟大中国梦了。”哥哥通过市场准入规则后，实行扩张型经济政策，使大量流动资金流入市场，缓解通货紧缩，资金全部吸入市场，达到泡沫顶峰。<br>“呼……全部投入市场了呢，这下糟糕了。”妹妹一脸幸福地说。<br>“还没完呢！”哥哥再次蓬勃发展的经济水平又一次的抬起了头。<br>“啊？！啊……啊……”<br>天已经亮了，但哥哥却依然在贯彻从群众中来到群众中去的工作方法……</P>
		</form>

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

</body>
</html>
