<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/22
 * Time: 下午8:35
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">

<div class="row">
<div class="col-md-3 hidden-xs">

	<!-- Profile Image -->
	<div class="box box-primary">
		<div class="box-body box-profile">
			<img class="profile-user-img img-responsive img-circle" src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" alt="User profile picture">
			<h3 class="profile-username text-center"><?echo isset($userinfo['username']) ? $userinfo['username']: "Data Error:@param:userinfo";?></h3>
			<p class="text-muted text-center"><?=$this->User_group_model->get_user_gruop_name($userinfo['group_id']);?></p>

			<ul class="list-group list-group-unbordered">
				<li class="list-group-item">
					<b>学号</b> <a class="pull-right"><?echo isset($userinfo['student_id']) ? $userinfo['student_id']: "Data Error:@param:userinfo";?></a>
				</li>
				<li class="list-group-item">
					<b>学院</b> <a class="pull-right"><?echo isset($userinfo['college']) ? $userinfo['college']: "Data Error:@param:userinfo";?></a>
				</li>
				<li class="list-group-item">
					<b>班级</b> <a class="pull-right"><?echo isset($userinfo['classes']) ? $userinfo['classes']: "Data Error:@param:userinfo";?></a>
				</li>
				<li class="list-group-item">
					<b>关注</b> <a class="pull-right">1,322</a>
				</li>
				<li class="list-group-item">
					<b>被关注</b> <a class="pull-right">543</a>
				</li>
				<li class="list-group-item">
					<b>好友</b> <a class="pull-right">13,287</a>
				</li>
			</ul>
		</div><!-- /.box-body -->
	</div><!-- /.box -->

	<!-- About Me Box -->
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">详细信息</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<strong><i class="fa fa-qq margin-r-5"></i>  QQ</strong>
			<p class="text-muted">
				<?echo isset($userinfo['qq']) ? $userinfo['qq']: "Data Error:@param:userinfo";?>
			</p>

			<hr>

			<strong><i class="fa fa-envelope margin-r-5"></i>  Mail（未验证）</strong>
			<p class="text-muted">
				<?echo isset($userinfo['email']) ? $userinfo['email']: "Data Error:@param:userinfo";?>
			</p>

			<hr>

			<strong><i class="fa fa-phone margin-r-5"></i>  短号</strong>
			<p class="text-muted">
				<?echo isset($userinfo['short_phone']) ? $userinfo['short_phone']: "Data Error:@param:userinfo";?>
			</p>

			<hr>

			<strong><i class="fa fa-mobile-phone margin-r-5"></i>  长号</strong>
			<p class="text-muted">
				<?echo isset($userinfo['long_phone']) ? $userinfo['long_phone']: "Data Error:@param:userinfo";?>
			</p>

			<hr>

			<strong><i class="fa fa-map-marker margin-r-5"></i> 寝室</strong>
			<p class="text-muted"><?echo isset($userinfo['qinshi']) ? $userinfo['qinshi']: "Data Error:@param:userinfo";?></p>

			<hr>

			<strong><i class="fa fa-pencil margin-r-5"></i> 状态</strong>
			<p>
				<span class="label label-success"><?echo isset($userinfo['status']) ? $userinfo['status']: "Data Error:@param:userinfo";?></span>
			</p>

			<hr>

			<strong><i class="fa fa-file-text-o margin-r-5"></i> 简介</strong>
			<p><?echo isset($userinfo['remarks']) ? (empty($userinfo['remarks'])?"这个人很懒，什么都没说。":$userinfo['remarks']): "Data Error:@param:userinfo";?></p>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div><!-- /.col -->
<div class="col-md-9 col-xs-12">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
	<li class="active"><a href="#activity" data-toggle="tab">动态</a></li>
	<li><a href="#timeline" data-toggle="tab">时间轴</a></li>
	<li><a href="#settings" data-toggle="tab" id="settingbtn">修改个人资料</a></li>
	<li><a href="#password" data-toggle="tab" id="passwordbtn">修改密码</a></li>
</ul>
<div class="tab-content">
<div class="active tab-pane" id="activity">
	<!-- Post -->
	<div class="post">
		<div class="user-block">
			<img class="img-circle img-bordered-sm" src="<?echo base_url('/public/AdminLTE2/dist/img')?>/user1-128x128.jpg" alt="user image">
                        <span class='username'>
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
			<span class='description'>Shared publicly - 7:30 PM today</span>
		</div><!-- /.user-block -->
		<p>
			Lorem ipsum represents a long-held tradition for designers,
			typographers and the like. Some people hate it and argue for
			its demise, but others ignore the hate as they create awesome
			tools to help create filler text for everyone from bacon lovers
			to Charlie Sheen fans.
		</p>
		<ul class="list-inline">
			<li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
			<li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
			<li class="pull-right"><a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li>
		</ul>

		<input class="form-control input-sm" type="text" placeholder="Type a comment">
	</div><!-- /.post -->

	<!-- Post -->
	<div class="post clearfix">
		<div class='user-block'>
			<img class='img-circle img-bordered-sm' src='<?echo base_url('/public/AdminLTE2/dist/img')?>/user7-128x128.jpg' alt='user image'>
                        <span class='username'>
                          <a href="#">Sarah Ross</a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
			<span class='description'>Sent you a message - 3 days ago</span>
		</div><!-- /.user-block -->
		<p>
			Lorem ipsum represents a long-held tradition for designers,
			typographers and the like. Some people hate it and argue for
			its demise, but others ignore the hate as they create awesome
			tools to help create filler text for everyone from bacon lovers
			to Charlie Sheen fans.
		</p>

		<form class='form-horizontal'>
			<div class='form-group margin-bottom-none'>
				<div class='col-sm-9'>
					<input class="form-control input-sm" placeholder="Response">
				</div>
				<div class='col-sm-3'>
					<button class='btn btn-danger pull-right btn-block btn-sm'>Send</button>
				</div>
			</div>
		</form>
	</div><!-- /.post -->

	<!-- Post -->
	<div class="post">
		<div class='user-block'>
			<img class='img-circle img-bordered-sm' src='<?echo base_url('/public/AdminLTE2/dist/img')?>/user6-128x128.jpg' alt='user image'>
                        <span class='username'>
                          <a href="#">Adam Jones</a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
			<span class='description'>Posted 5 photos - 5 days ago</span>
		</div><!-- /.user-block -->
		<div class='row margin-bottom'>
			<div class='col-sm-6'>
				<img class='img-responsive' src='<?echo base_url('/public/AdminLTE2/dist/img')?>/photo1.png' alt='Photo'>
			</div><!-- /.col -->
			<div class='col-sm-6'>
				<div class='row'>
					<div class='col-sm-6'>
						<img class='img-responsive' src='<?echo base_url('/public/AdminLTE2/dist/img')?>/photo2.png' alt='Photo'>
						<br>
						<img class='img-responsive' src='<?echo base_url('/public/AdminLTE2/dist/img')?>/photo3.jpg' alt='Photo'>
					</div><!-- /.col -->
					<div class='col-sm-6'>
						<img class='img-responsive' src='<?echo base_url('/public/AdminLTE2/dist/img')?>/photo4.jpg' alt='Photo'>
						<br>
						<img class='img-responsive' src='<?echo base_url('/public/AdminLTE2/dist/img')?>/photo1.png' alt='Photo'>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.col -->
		</div><!-- /.row -->

		<ul class="list-inline">
			<li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
			<li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
			<li class="pull-right"><a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li>
		</ul>

		<input class="form-control input-sm" type="text" placeholder="Type a comment">
	</div><!-- /.post -->
</div><!-- /.tab-pane -->
<div class="tab-pane" id="timeline">
	<!-- The timeline -->
	<ul class="timeline timeline-inverse">
		<!-- timeline time label -->
		<li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
		</li>
		<!-- /.timeline-label -->
		<!-- timeline item -->
		<li>
			<i class="fa fa-envelope bg-blue"></i>
			<div class="timeline-item">
				<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
				<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
				<div class="timeline-body">
					Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
					weebly ning heekya handango imeem plugg dopplr jibjab, movity
					jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
					quora plaxo ideeli hulu weebly balihoo...
				</div>
				<div class="timeline-footer">
					<a class="btn btn-primary btn-xs">Read more</a>
					<a class="btn btn-danger btn-xs">Delete</a>
				</div>
			</div>
		</li>
		<!-- END timeline item -->
		<!-- timeline item -->
		<li>
			<i class="fa fa-user bg-aqua"></i>
			<div class="timeline-item">
				<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
				<h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
			</div>
		</li>
		<!-- END timeline item -->
		<!-- timeline item -->
		<li>
			<i class="fa fa-comments bg-yellow"></i>
			<div class="timeline-item">
				<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
				<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
				<div class="timeline-body">
					Take me to your leader!
					Switzerland is small and neutral!
					We are more like Germany, ambitious and misunderstood!
				</div>
				<div class="timeline-footer">
					<a class="btn btn-warning btn-flat btn-xs">View comment</a>
				</div>
			</div>
		</li>
		<!-- END timeline item -->
		<!-- timeline time label -->
		<li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
		</li>
		<!-- /.timeline-label -->
		<!-- timeline item -->
		<li>
			<i class="fa fa-camera bg-purple"></i>
			<div class="timeline-item">
				<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
				<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
				<div class="timeline-body">
					<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/photo4.jpg" width="150" alt="..." class="margin">
					<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/photo4.jpg" width="150" alt="..." class="margin">
					<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/photo4.jpg" width="150" alt="..." class="margin">
					<img src="<?echo base_url('/public/AdminLTE2/dist/img')?>/photo4.jpg" width="150" alt="..." class="margin">
				</div>
			</div>
		</li>
		<!-- END timeline item -->
		<li>
			<i class="fa fa-clock-o bg-gray"></i>
		</li>
	</ul>
</div><!-- /.tab-pane -->
<div class="tab-pane" id="settings">
	<form id="userinfopost" class="form-horizontal" action="<?echo current_url();?>" method="post">
		<?//跨站请求伪造
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		?>

		<?
		$structrue = array(
			array('name'=>'sex','type'=>'radio','value'=>$userinfo['sex'],'labelname'=>'性别','option'=>array('0'=>'女','1'=>'男')),
			array('name'=>'email','type'=>'email','value'=>$userinfo['email'],'labelname'=>'邮箱'),
			array('name'=>'qq','type'=>'text','value'=>$userinfo['qq'],'labelname'=>'qq'),
			array('name'=>'long_phone','type'=>'text','value'=>$userinfo['long_phone'],'labelname'=>'长号'),
			array('name'=>'short_phone','type'=>'text','value'=>$userinfo['short_phone'],'labelname'=>'短号'),
			array('name'=>'mz','type'=>'text','value'=>$userinfo['mz'],'labelname'=>'民族'),
			array('name'=>'jg','type'=>'text','value'=>$userinfo['jg'],'labelname'=>'籍贯'),
			array('name'=>'fa_name','type'=>'text','value'=>$userinfo['fa_name'],'labelname'=>'父亲姓名'),
			array('name'=>'fa_phone','type'=>'text','value'=>$userinfo['fa_phone'],'labelname'=>'父亲电话'),
			array('name'=>'mo_name','type'=>'text','value'=>$userinfo['mo_name'],'labelname'=>'母亲姓名'),
			array('name'=>'mo_phone','type'=>'text','value'=>$userinfo['mo_phone'],'labelname'=>'母亲电话'),
			array('name'=>'ybh','type'=>'text','value'=>$userinfo['ybh'],'labelname'=>'邮编号'),
			array('name'=>'homephone','type'=>'text','value'=>$userinfo['homephone'],'labelname'=>'家庭电话'),
			array('name'=>'address','type'=>'text','value'=>$userinfo['address'],'labelname'=>'家庭地址','readonly'=>1),
			array('name'=>'qinshi','type'=>'text','value'=>$userinfo['qinshi'],'labelname'=>'寝室','readonly'=>1),
			array('name'=>'remarks','type'=>'textarea','value'=>$userinfo['remarks'],'labelname'=>'个人简介'),

		);
		foreach($structrue as $v){
			if($v['type']=='textarea'){
				echo '<div class="form-group">';
				echo '	<label for="input'.$v['name'].'" class="col-sm-2 control-label">'.$v['labelname'].'</label>';
				echo '	<div class="col-sm-10">';
				echo '<textarea class="form-control" rows="3" id="input'.$v['name'].'" name="'.$v['name'].'">'.$v['value'].'</textarea>';
				echo '	</div>';
				echo '</div>';
			}elseif($v['type']=='radio'){
				echo '<div class="form-group">';
				echo '	<label class="col-sm-2 control-label">'.$v['labelname'].'</label>';
				echo '<div class="col-sm-10 "><div class="btn-group" data-toggle="buttons">';
					foreach($v['option'] as $k=>$w){
						echo '    <label class="btn btn-default';
						if($v['value']==$k)echo ' active';
						echo '">';
            echo '      <input type="radio" id="options'.$v['name'].'" name="'.$v['name'].'" value="'.$k.'"';
						if($v['value']==$k)echo ' checked="checked"';
						echo '>'.$w;
            echo '    </label>';
					}
				echo '</div></div></div>';
			}else{
				echo '<div class="form-group">';
				echo '	<label for="input'.$v['name'].'" class="col-sm-2 control-label">'.$v['labelname'].'</label>';
				echo '	<div class="col-sm-10">';
				echo '		<input type="'.$v['type'].'" class="form-control" id="input'.$v['name'].'" name="'.$v['name'].'" value="'.$v['value'].'" ';
				if(isset($v['readonly']))echo 'readonly';
				echo '>';
				echo '	</div>';
				echo '</div>';
			}
		}
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary" onclick="{if(confirm('确定修改?')){return true;}return false;}">提交</button>
			</div>
		</div>
	</form>
</div><!-- /.tab-pane -->
<div class="tab-pane" id="password">
	<form id="postpassword" class="form-horizontal" action="<?echo current_url();?>" method="post">
		<?
		$structrue = array(
			array('name'=>'password','type'=>'password','value'=>'','labelname'=>'原密码'),
			array('name'=>'newpassword','type'=>'password','value'=>'','labelname'=>'新密码'),
			array('name'=>'confirmPassword','type'=>'password','value'=>'','labelname'=>'重复新密码'),
		);
		foreach($structrue as $v){
			echo '<div class="form-group">';
			echo '	<label for="input'.$v['name'].'" class="col-sm-2 control-label">'.$v['labelname'].'</label>';
			echo '	<div class="col-sm-10">';
			echo '		<input type="'.$v['type'].'" class="form-control" id="input'.$v['name'].'" name="'.$v['name'].'" value="'.$v['value'].'">';
			echo '	</div>';
			echo '</div>';
		}
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-danger" onclick="{if(confirm('确定修改?')){return true;}return false;}">提交</button>
			</div>
		</div>
	</form>
</div><!-- /.tab-pane -->
</div><!-- /.tab-content -->
</div><!-- /.nav-tabs-custom -->
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
<!-- control -->
<script src="<?php echo base_url();?>public/js/<?php echo $controller_name.'_'.$method_name;?>.js"></script>
<script>
	$(document).ready(function() {
		if(window.location.hash == "#settings"){
			$('#settingbtn').trigger("click");
		}
		SITE_URL = '<?echo base_url();?>';
	});
</script>
</body>
</html>
