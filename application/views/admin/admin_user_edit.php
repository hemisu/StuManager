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
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">添加用户</h3>
				<div class="box-tools pull-right">
					<a href="<?echo base_url('admin/user_library')?>" class="btn btn-default btn-sm">返回</a>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form id="user_add" class="form-horizontal" action="<?echo current_url();?>" method="post">
					<?//跨站请求伪造
					$csrf = array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					);
					$salt=base64_encode(mcrypt_create_iv(32,MCRYPT_DEV_RANDOM));//盐自动生成
//					echo $this->User_model->salt_password($edituserinfo['student_id'],$edituserinfo['password'])
					?>

					<?
					//构造数组 - 生成表单
					$structrue = array(
						array('name'=>'student_id','type'=>'text','value'=>$edituserinfo['student_id'],'labelname'=>'学号','readonly'=>'1'),
						array('name'=>'password','type'=>'password','value'=>$edituserinfo['password'],'labelname'=>'密码'),
						array('name'=>'salt','type'=>'hidden','value'=>$edituserinfo['salt'],'labelname'=>'密钥'),
						array('name'=>'group_id','type'=>'select','value'=>$edituserinfo['group_id'],'labelname'=>'用户组','option'=>$this->User_group_model->get_user_gruop_arr()),
						array('name'=>'username','type'=>'text','value'=>$edituserinfo['username'],'labelname'=>'姓名'),
						array('name'=>'avatar','type'=>'hidden','value'=>$edituserinfo['avatar'],'labelname'=>'avatar'),
						array('name'=>'atschool','type'=>'radio','value'=>$edituserinfo['atschool'],'labelname'=>'是否在校','option'=>array('0'=>'不在','1'=>'在校')),
						array('name'=>'status','type'=>'text','value'=>$edituserinfo['status'],'labelname'=>'状态'),
						array('name'=>'college','type'=>'text','value'=>$edituserinfo['college'],'labelname'=>'学院'),
						array('name'=>'classes','type'=>'text','value'=>$edituserinfo['classes'],'labelname'=>'行政班级'),
						array('name'=>'majoryear','type'=>'text','value'=>$edituserinfo['majoryear'],'labelname'=>'年级'),
						array('name'=>'major','type'=>'text','value'=>$edituserinfo['major'],'labelname'=>'年级简称'),
						array('name'=>'classnum','type'=>'text','value'=>$edituserinfo['classnum'],'labelname'=>'班级号'),
						array('name'=>'card_id','type'=>'text','value'=>$edituserinfo['card_id'],'labelname'=>'身份证号'),
						array('name'=>'zzmm','type'=>'select','value'=>$edituserinfo['zzmm'],'labelname'=>'政治面貌','option'=>array('共青团员'=>'共青团员','预备党员'=>'预备党员','群众'=>'群众')),

						array('name'=>'sex','type'=>'radio','value'=>$edituserinfo['sex'],'labelname'=>'性别','option'=>array('0'=>'女','1'=>'男')),
						array('name'=>'email','type'=>'email','value'=>$edituserinfo['email'],'labelname'=>'邮箱'),
						array('name'=>'qq','type'=>'text','value'=>$edituserinfo['qq'],'labelname'=>'qq'),
						array('name'=>'long_phone','type'=>'text','value'=>$edituserinfo['long_phone'],'labelname'=>'长号'),
						array('name'=>'short_phone','type'=>'text','value'=>$edituserinfo['short_phone'],'labelname'=>'短号'),
						array('name'=>'mz','type'=>'text','value'=>$edituserinfo['mz'],'labelname'=>'民族'),
						array('name'=>'jg','type'=>'text','value'=>$edituserinfo['jg'],'labelname'=>'籍贯'),
						array('name'=>'fa_name','type'=>'text','value'=>$edituserinfo['fa_name'],'labelname'=>'父亲姓名'),
						array('name'=>'fa_phone','type'=>'text','value'=>$edituserinfo['fa_phone'],'labelname'=>'父亲电话'),
						array('name'=>'mo_name','type'=>'text','value'=>$edituserinfo['mo_name'],'labelname'=>'母亲姓名'),
						array('name'=>'mo_phone','type'=>'text','value'=>$edituserinfo['mo_phone'],'labelname'=>'母亲电话'),
						array('name'=>'ybh','type'=>'text','value'=>$edituserinfo['ybh'],'labelname'=>'邮编号'),
						array('name'=>'homephone','type'=>'text','value'=>$edituserinfo['homephone'],'labelname'=>'家庭电话'),
						array('name'=>'address','type'=>'text','value'=>$edituserinfo['address'],'labelname'=>'家庭地址'),
						array('name'=>'qinshi','type'=>'text','value'=>$edituserinfo['qinshi'],'labelname'=>'寝室'),
						array('name'=>'remarks','type'=>'textarea','value'=>$edituserinfo['remarks'],'labelname'=>'个人简介'),

					);
					foreach($structrue as $v){//由构造函数生成表单
						if($v['type']=='textarea') {
							echo '<div class="form-group">';
							echo '	<label for="input'.$v['name'].'" class="col-sm-2 control-label">'.$v['labelname'].'</label>';
							echo '	<div class="col-sm-10">';
							echo '<textarea class="form-control" rows="3" id="input'.$v['name'].'" name="'.$v['name'].'">'.$v['value'].'</textarea>';
							echo '	</div>';
							echo '</div>';
						} elseif($v['type']=='radio') {
							echo '<div class="form-group">';
							echo '	<label class="col-sm-2 control-label">'.$v['labelname'].'</label>';
							echo '<div class="col-sm-10 "><div class="btn-group" data-toggle="buttons">';
							foreach($v['option'] as $k=>$w){
								echo '    <label class="btn btn-default';
								if($v['value']==$k)echo ' active';
								echo '">';
								echo '      <input type="radio" id="options'.$v['name'].'" name="'.$v['name'].'" value="'.$k.'"';
								if($v['value']==$k)echo ' checked="checked"';//是否被选中
								echo '>'.$w;
								echo '    </label>';
							}
							echo '</div></div></div>';
						} elseif($v['type']=='select') {
							echo '<div class="form-group">';
							echo '	<label class="col-sm-2 control-label">'.$v['labelname'].'</label>';
							echo '<div class="col-sm-10 "><select name="'.$v['name'].'" class="form-control">';
							foreach($v['option'] as $k=>$w){
								echo '<option value="'.$k.'" ';
								if($v['value']==$k){echo 'selected';}//是否被选中
								echo '>'.$w.'</option>';
							}
							echo '</select></div></div>';
						} elseif($v['type']=='hidden'){
							echo '<input type="hidden" name="'.$v['name'].'" value="'.$v['value'].'" />';
						} else {
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
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<? require_once(dirname(__FILE__) . "/" . "../footer.php");?>

<!-- ./wrapper -->

<!-- control -->
<script src="<?php echo base_url();?>public/js/admin/<?php echo $controller_name.'_'.$method_name;?>.js"></script>

</body>
</html>
