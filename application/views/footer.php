<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/19
 * Time: 下午9:10
 */
?>
<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 2.0
	</div>
	<strong>Copyright &copy; 2014-2015 <a href="http://hemisu.com">Hemisu</a>.</strong> All rights reserved.|Theme Designed By <a href="https://almsaeedstudio.com/">Almsaeed Studio.</a>
</footer>
<!-- Add the sidebar's background. This div must be placed
		 immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- pace.js -->
<script>
	var SITE_URL = "<?echo SITE_BASE;?>";//SITE_URL
	var CURRENT_URL = "<?echo current_url();?>";//CURRENT_URL
	var student_id = "<?echo $this->student_id;?>";//学号
	window.paceOptions = {
		ajax: {
			trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
		}
	};
	console.log('咦！这么巧你也喜欢研究WEB技术！\r\n我是本校电气专业大三的学生\r\n有没有兴趣一起讨论？\r\n联系我的QQ：597941116 %c 备注：来自StuManager\r\n',"color:red");
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
<!-- bootstrapValidator -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
<!-- sco.message -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/sco/js/sco.message.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/dist/js/demo.js"></script>
<script>
//	$(window).scroll( function() {
//		console.log("滚动条到顶部的垂直高度: "+$(document).scrollTop());
//		console.log("页面的文档高度 ："+$(document).height());
//		console.log('浏览器的高度：'+$(window).height());
//	});
</script>
