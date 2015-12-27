<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/22
 * Time: 下午9:41
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<?echo $pageheader;?>
<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<a href="<?echo base_url('/message/index');?>" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Folders</h3>
						<div class="box-tools">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="mailbox.html"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right">12</span></a></li>
							<li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
							<li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
							<li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li>
							<li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
						</ul>
					</div><!-- /.box-body -->
				</div><!-- /. box -->
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Labels</h3>
						<div class="box-tools">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
							<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
							<li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
						</ul>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
			<div class="col-md-9">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Compose New Message</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<input class="form-control" placeholder="To:">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Subject:">
						</div>
						<div class="form-group">
							<textarea id="compose-textarea" class="form-control" style="height: 300px">
								<h1><u>Heading Of Message</u></h1>
								<h4>Subheading</h4>
								<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee</p>
								<ul>
									<li>List item one</li>
									<li>List item two</li>
									<li>List item three</li>
									<li>List item four</li>
								</ul>
								<p>Thank you,</p>
								<p>John Doe</p>
							</textarea>
						</div>
						<div class="form-group">
							<div class="btn btn-default btn-file">
								<i class="fa fa-paperclip"></i> Attachment
								<input type="file" name="attachment">
							</div>
							<p class="help-block">Max. 32MB</p>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<div class="pull-right">
							<button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
							<button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
						</div>
						<button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
					</div><!-- /.box-footer -->
				</div><!-- /. box -->
			</div><!-- /.col -->
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
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Bootstrap datetimepicker -->
<script type="text/javascript" src="<?php echo base_url('/public/AdminLTE2');?>/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<!-- control -->
<script src="<?php echo base_url();?>public/js/<?php echo $controller_name.'_'.$method_name?>.js"></script>

</body>
</html>
