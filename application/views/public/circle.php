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
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-xs-12">
		<div class="social-feed-box">

			<div class="pull-right social-action dropdown">
				<button data-toggle="dropdown" class="dropdown-toggle btn-white" aria-expanded="false">
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu m-t-xs">
					<li><a href="#">设置</a></li>
				</ul>
			</div>
			<div class="social-avatar">
				<a href="" class="pull-left">
					<img alt="image" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user7-128x128.jpg" >
				</a>
				<div class="media-body">
					<a href="#">
						尤小右
					</a>
					<small class="text-muted">8月18日 16:05 来自 微博 weibo.com</small>
				</div>
			</div>
			<div class="social-body">
				<p>
					看到说是 React 的也是醉了，他说的是 falcor... Khan Academy 是最早在生产环境里使用 React 的公司之一
				</p>

				<div class="btn-group">
					<button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> 赞</button>
					<button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> 评论</button>
					<button class="btn btn-white btn-xs"><i class="fa fa-share"></i> 分享</button>
				</div>
			</div>
			<div class="social-footer">
				<div class="social-comment">
					<a href="" class="pull-left">
						<img alt="image" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg">
					</a>
					<div class="media-body">
						<a href="#">
							尤小右
						</a> jQuery的作者在Twitter上发了一条这样的推，也是有点平衡了
						<br>
						<a href="#" class="small"><i class="fa fa-thumbs-up"></i> 26</a> -
						<small class="text-muted">8月18日</small>
					</div>
				</div>

				<div class="social-comment">
					<a href="" class="pull-left">
						<img alt="image" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user5-128x128.jpg">
					</a>
					<div class="media-body">
						<a href="#">
							尤小右
						</a> John大概是在学习React和Flux。。。
						<br>
						<a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11</a> -
						<small class="text-muted">8月18日</small>
					</div>
				</div>

				<div class="social-comment">
					<a href="" class="pull-left">
						<img alt="image" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user4-128x128.jpg">
					</a>
					<div class="media-body">
						<textarea class="form-control" placeholder="填写评论..."></textarea>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>
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
</body>
</html>
