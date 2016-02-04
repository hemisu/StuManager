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
			<img class="profile-user-img img-responsive img-circle" src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" alt="User profile picture" data-toggle="modal" data-target="#avatarModal">
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
<!--	<li class="active"><a href="#activity" data-toggle="tab">动态</a></li>-->
<!--	<li><a href="#timeline" data-toggle="tab">时间轴</a></li>-->
	<li class="active"><a href="#settings" data-toggle="tab" id="settingbtn">修改个人资料</a></li>
	<li><a href="#password" data-toggle="tab" id="passwordbtn">修改密码</a></li>
</ul>
<div class="tab-content">

<div class="tab-pane active" id="settings">
	<form id="userinfopost" class="form-horizontal" action="<?echo current_url();?>" method="post">
		<?//跨站请求伪造
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		?>
		<label class="col-sm-2 control-label"></label><div class="col-sm-10 "><p>tip:点击左侧头像即可更换新头像</p></div>
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
<!-- avatar Modal -->
<div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">更换头像</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-3">
						<a class="media-left" href="#" target="_blank">
							<img id="previewpic" src="<?echo base_url('/public/avatar').'/'.$userinfo['avatar'];?>" width="100">
						</a>
					</div>
					<div class="col-lg-9">
						<h4 class="media-heading">允许上传类型：gif|jpg|jpeg|png|bmp</h4>
						<form method="post" action="<?=base_url('file/avatar_upload/'.$userinfo['student_id'])?>" enctype="multipart/form-data">
							<input name="avatar" type="file" size="15">
							<br/>
							<input type="submit" name="submitavatar" value="上传头像" class="btn btn-info">
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
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
