$(document).ready(function(){
	$('#moduleForm').bootstrapValidator({
		framework: 'bootstrap',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			menu_name: {
				validators: {
					notEmpty: {
						message: '标题不能为空'
					}
				}
			}
		}
	}).on('success.form.bv', function (e) {
		// Prevent form submission
		e.preventDefault();

		// Get the form instance
		var $form = $(e.target);

		// Get the BootstrapValidator instance
		var bv = $form.data('bootstrapValidator');

		// Use Ajax to submit form data
		$.post($form.attr('action'), $form.serialize(), function (result) {
			if (result.response === 'error') {
				$.scojs_message('提交失败', $.scojs_message.TYPE_ERROR);
				$('#bindingForm').data('formValidation').resetForm();
			} else {
				console.log(result);
				$.scojs_message('提交成功', $.scojs_message.TYPE_OK);
				$.GoUrl(result.next_url, 1);
			}
		}, 'json');
	})
		.end();
});