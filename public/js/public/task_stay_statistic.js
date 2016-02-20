/**
 * Created by hekunyu on 16/2/17.
 */

$(document).ready(function () {
	$('body').timeago();
	//删除
	$('.del').click(function () {
		var staid = $(this).data('statistic-id');
		var stausername = $(this).data('statistic-username');
		$.ajax({
			type: 'get',
			url: SITE_URL + 'task/returnleave_statistic_delete',
			data: {'id': staid, 'username': stausername, 'task_id': task_id ,'stay':1},
			dataType: 'json',
			success: function (result) {
				if (result.response == false) {
					$.scojs_message('删除失败', $.scojs_message.TYPE_ERROR);
				} else {
						//console.log(result);
					$.scojs_message('删除成功', $.scojs_message.TYPE_OK);
				}
			}
		});
//			console.log(staid);
		$(this).parent().parent().remove();
	});
	//删除
	$('.delclassinfo').click(function () {
		$.ajax({
			type: 'get',
			url: SITE_URL + 'task/returnleave_statistic_delete_classall',
			data: {'task_id': task_id},
			dataType: 'json',
			success: function (result) {
				if (result.response == false) {
					$.scojs_message('删除失败', $.scojs_message.TYPE_ERROR);
				} else {
					console.log(result);
					$.scojs_message('提交成功，本班人员全部到齐', $.scojs_message.TYPE_OK);
					setTimeout("location.reload();", 2000)
				}
			}
		});
	});
	$("#form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
	var nameValidators = {
			row: '.col-xs-2',   // The title is placed inside a <div class="col-xs-4"> element
			validators: {
				notEmpty: {
					message: '姓名不能为空'
				}
			}
		},
		reasonValidators = {
			row: '.col-xs-2',
			validators: {
				notEmpty: {
					message: '留校原因不能为空'
				}
			}
		},
		remarkValidators = {
			row: '.col-xs-2',
			validators: {
				notEmpty: {
					message: '填写负责人'
				}
			}
		},
		beginValidators = {
			row: '.col-xs-2',
			validators: {
				notEmpty: {
					message: '填写开始日期'
				},
				date: {
					format: 'YYYY-MM-DD',
					message: '日期不符合要求，年-月-日'
				}
			}
		},
		endValidators = {
			row: '.col-xs-2',
			validators: {
				notEmpty: {
					message: '填写结束日期'
				},
				date: {
					format: 'YYYY-MM-DD',
					message: '日期不符合要求，年-月-日'
				}
			}
		},
		instructorValidators = {
			row: '.col-xs-2',
			validators: {
				notEmpty: {
					message: '不能为空'
				}
			}
		},
		infoIndex = 0;

	$('#infoForm')
		.find('[name="info[0][student_id]"]')
		.select2({
			placeholder: "输入姓名",
			ajax: {
				url: SITE_URL+'task/user_username_json',
				delay: 250,
				dataType: 'json',
				processResults: function (data) {
					return {
						results: data
					};
				}
			}
		})
		.end()
		.bootstrapValidator({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				'info[0][student_id]': nameValidators,
				'info[0][reason]': reasonValidators,
				'info[0][remark]': remarkValidators,
				'info[0][begin_date]': beginValidators,
				'info[0][end_date]': endValidators,
				'info[0][instructor]': instructorValidators
			}
		})

		// Add button click handler
		.on('click', '.addButton', function () {
			infoIndex++;
			var $template = $('#infoTemplate'),
				$clone = $template
					.clone()
					.removeClass('hide')
					.removeAttr('id')
					.attr('data-info-index', infoIndex)
					.insertBefore($template);

			// Update the name attributes
			$clone
				.find('[name="student_id"]').attr('name', 'info[' + infoIndex + '][student_id]').end()
				.find('[name="reason"]').attr('name', 'info[' + infoIndex + '][reason]').end()
				.find('[name="remark"]').attr('name', 'info[' + infoIndex + '][remark]').end()
				.find('[name="begin_date"]').attr('name', 'info[' + infoIndex + '][begin_date]').end()
				.find('[name="instructor"]').attr('name', 'info[' + infoIndex + '][instructor]').end()
				.find('[name="end_date"]').attr('name', 'info[' + infoIndex + '][end_date]').end();

			// Add new fields
			// Note that we also pass the validator rules for new field as the third parameter
			$('#infoForm')
				.bootstrapValidator('addField', 'info[' + infoIndex + '][student_id]', nameValidators)
				.find('[name="info[' + infoIndex + '][student_id]"]')
				.select2({
					placeholder: "输入姓名",
					ajax: {
						url: SITE_URL + 'task/user_username_json',
						delay: 250,
						dataType: 'json',
						processResults: function (data) {
							return {
								results: data
							};
						}
					}
				})
				.end()
				.bootstrapValidator('addField', 'info[' + infoIndex + '][reason]', reasonValidators)
				.bootstrapValidator('addField', 'info[' + infoIndex + '][remark]', remarkValidators)
				.bootstrapValidator('addField', 'info[' + infoIndex + '][begin_date]', beginValidators)
				.bootstrapValidator('addField', 'info[' + infoIndex + '][instructor]', instructorValidators)
				.bootstrapValidator('addField', 'info[' + infoIndex + '][end_date]', endValidators);
		})

		// Remove button click handler
		.on('click', '.removeButton', function () {
			var $row = $(this).parents('.form-group'),
				index = $row.attr('data-info-index');

			// Remove fields
			$('#infoForm')
				.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][student_id]"]'))
				.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][reason]"]'))
				.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][begin_date]"]'))
				.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][end_date]"]'))
				.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][instructor]"]'))
				.bootstrapValidator('removeField', $row.find('[name="info[' + index + '][remark]"]'));

			// Remove element containing the fields
			$row.remove();
		})
		.on('success.form.bv', function (e) {
			// Prevent form submission
			e.preventDefault();

			// Get the form instance
			var $form = $(e.target);

			// Get the BootstrapValidator instance
			var bv = $form.data('bootstrapValidator');

			// Use Ajax to submit form data
			$.ajax({
				url: $form.attr('action'),
				data: $('#infoForm').serialize(),
				dataType: 'json',
				type: 'post',
				success: function (result) {
					if (result.response === false) {

						$.scojs_message('提交失败!' + result.tips, $.scojs_message.TYPE_ERROR);

					} else {
						console.log(result);
						$.scojs_message('提交成功', $.scojs_message.TYPE_OK);
						$.GoUrl(result.next_url, 1);
					}
				}
			});
		})
	;
//http://formvalidation.io/examples/adding-dynamic-field/
});
