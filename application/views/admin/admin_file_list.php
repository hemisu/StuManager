<?php
/**
 * Created by PhpStorm.
 * User: hekunyu
 * Date: 15/11/25
 * Time: 下午8:33
 */
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<?echo $pageheader;?>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">文件列表</h3>
					<div class="box-tools pull-right">
						<a href="<?echo base_url('admin/announce_add')?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#uploadModal">上传新文件</a>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="table-responsive">
						<table class="table table-striped">
							<tr>
								<th style="width: 10px">#</th>
								<th style="width: 200px">浏览</th>
								<th>文件名</th>
								<th>姓名</th>
								<th>学号</th>
								<th>班级</th>
								<th>操作</th>
							</tr>
              <?php
              echo $filelist;
              ?>
						</table>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
<!--					--><?//print_r($announcelistpage);?>
				</div><!-- /.box-booter -->
			</div><!-- /.box -->
		</div><!-- /.col-->
	</div><!-- ./row -->
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
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- footer -->
<? require_once(dirname(__FILE__) . "/" . "../footer.php");?>

<!-- ./wrapper -->
<!-- Bootstrap WYSIHTML5 -->
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
