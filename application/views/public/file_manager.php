<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/22
 * Time: 下午9:48
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<? echo $pageheader; ?>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-sm-3">
	<div class="ibox float-e-margins">
		<div class="ibox-content">
			<div class="file-manager">
				<h5>显示：</h5>
				<a href="<?=current_url();?>" class="file-control active">所有</a>
				<a href="<?=current_url().'?type=image'?>" class="file-control">图片</a>
				<a href="<?=current_url().'?type=application/pdf'?>" class="file-control">文档</a>

				<div class="hr-line-dashed"></div>
				<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#uploadModal">上传文件</button>
				<div class="hr-line-dashed"></div>
				<h5>文件夹</h5>
				<ul class="folder-list" style="padding: 0">
					<li><a href="<?=current_url().'?student_id='.$userinfo['student_id'];?>"><i class="fa fa-folder"></i> 私人文件夹</a>
					</li>
				</ul>
<!--				<h5 class="tag-title">标签</h5>-->
<!--				<ul class="tag-list" style="padding: 0">-->
<!--					<li><a href="file_manager.html">学生会</a>-->
<!--					</li>-->
<!--					<li><a href="file_manager.html">工作</a>-->
<!--					</li>-->
<!--					<li><a href="file_manager.html">凭证</a>-->
<!--					</li>-->
<!--					</li>-->
<!--				</ul>-->
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-9">
<div class="row">
<div class="col-sm-12">
<?=$filelist;?>
</div>
</div>
</div>
</div>
<!-- upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">上传文件</h4>
			</div>
			<div class="modal-body">
				<div class="row demo-columns">
					<div class="col-md-6">
						<!-- D&D Zone-->
						<div id="drag-and-drop-zone" class="uploader">
							<div>将文件拖拽到这里</div>
							<div class="or">-or-</div>
							<div class="browser">
								<label>
									<span>点击浏览文件</span>
									<input type="file" name="files[]" accept="image/*" multiple="multiple" title='Click to add Images'>
								</label>
							</div>
						</div>
						<!-- /D&D Zone -->

						<!-- Debug box -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">控制台</h3>
							</div>
							<div class="panel-body demo-panel-debug">
								<ul id="demo-debug">
								</ul>
							</div>
						</div>
						<!-- /Debug box -->
					</div>
					<!-- / Left column -->

					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">文件列表</h3>
							</div>
							<div class="panel-body demo-panel-files" id='demo-files'>
								<span class="demo-note">无文件</span>
							</div>
						</div>
					</div>
					<!-- / Right column -->
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
</div>
</section>
<!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<? require_once(dirname(__FILE__) . "/" . "../footer.php"); ?>

<!-- ./wrapper -->
<!-- upload -->
<script src="<?php echo base_url('/public/AdminLTE2'); ?>/plugins/uploader/demo-preview.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2'); ?>/plugins/uploader/dmuploader.js"></script>
<!-- fancyBox -->
<script src="<?php echo base_url('/public/AdminLTE2'); ?>/plugins/fancyBox/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url('/public/AdminLTE2'); ?>/plugins/fancyBox/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript">
	$("[limit]").limit();
	$(".fancybox").fancybox({'type':'image'});//fancyBox
	$('#drag-and-drop-zone').dmUploader({
		url: 'http://upload.qiniu.com',
		dataType: 'json',
		extraData: {
			"<?=$this->security->get_csrf_token_name();?>": "<?=$this->security->get_csrf_hash();?>",
			"x:sid":"<?=$userinfo['student_id']?>",
			"x:pid":''
		},
//		allowedTypes: 'image/*',
		onInit: function () {
			$.danidemo.addLog('#demo-debug', 'default', '成功加载');
		},
		onBeforeUpload: function (id) {
			$.danidemo.addLog('#demo-debug', 'default', '开始上传文件 #' + id);

			$.danidemo.updateFileStatus(id, 'default', '上传中...');
		},
		onNewFile: function (id, file) {

			$.danidemo.addFile('#demo-files', id, file);

			/*** Begins Image preview loader ***/
			if (typeof FileReader !== "undefined") {

				var reader = new FileReader();

				// Last image added
				var img = $('#demo-files').find('.demo-image-preview').eq(0);

				reader.onload = function (e) {
					img.attr('src', e.target.result);
				}

				reader.readAsDataURL(file);

			} else {
				// Hide/Remove all Images if FileReader isn't supported
				$('#demo-files').find('.demo-image-preview').remove();
			}
			/*** Ends Image preview loader ***/

		},
		onComplete: function () {
			$.danidemo.addLog('#demo-debug', 'default', '文件上传序列完成');
		},
		onUploadProgress: function (id, percent) {
			var percentStr = percent + '%';

			$.danidemo.updateFileProgress(id, percentStr);
		},
		onUploadSuccess: function (id, data) {
			$.danidemo.addLog('#demo-debug', 'success', '上传文件 #' + id + ' 成功');

			$.danidemo.addLog('#demo-debug', 'info', '服务器响应文件 #' + id + ': ' + JSON.stringify(data));

			$.danidemo.updateFileStatus(id, 'success', '上传成功');

			$.danidemo.updateFileProgress(id, '100%');
		},
		onUploadError: function (id, message) {
			$.danidemo.updateFileStatus(id, 'error', message);

			$.danidemo.addLog('#demo-debug', 'error', '上传文件失败 #' + id + ': ' + message);
		},
		onFileTypeError: function (file) {
			$.danidemo.addLog('#demo-debug', 'error', '文件 \'' + file.name + '\' 不能添加：必须是图片文件');
		},
		onFileSizeError: function (file) {
			$.danidemo.addLog('#demo-debug', 'error', '文件 \'' + file.name + '\' 不能添加：超出规定大小');
		},
		onFallbackMode: function (message) {
			$.danidemo.addLog('#demo-debug', 'info', '浏览器不符合要求: ' + message);
		}
	});
</script>
</body>
</html>
