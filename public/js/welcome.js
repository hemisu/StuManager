requirejs.config({
	baseUrl: SITE_URL + 'public/AdminLTE2',
	paths: {
		"jquery": "plugins/jQuery/jQuery-2.1.4.min",
		"bootstrap": "bootstrap/js/bootstrap",
		"bootstrapValidator": "plugins/bootstrap-validator/js/bootstrapValidator.min",
		"message": "plugins/sco/js/sco.message",
		"iCheck": "plugins/iCheck/icheck.min",
		"stu": "stu"
	},
	shim: {
		"bootstrapValidator": {
			exports: "$",
			deps: ["jquery"]
		},
		"iCheck": {
			exports: "$",
			deps: ["jquery"]
		},
		"bootstrap": ['jquery'],
		"message": {
			exports: "$",
			deps: ['jquery']
		},
		"stu": ['jquery']
	}
});

requirejs(['jquery', 'message', 'bootstrap', 'bootstrapValidator', 'message', 'iCheck', 'stu'],
	function ($, message, bootstrap, bootstrapValidator, message, iCheck, stu) {
		$('#agreementBottom').click(function () {
			$('#acceptTerms').iCheck('check');
		});
		$('#modalClose').click(function () {
			$('#acceptTerms').iCheck('uncheck');
		});
		$('#bindingForm').bootstrapValidator({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				student_id: {
					validators: {
						notEmpty: {
							message: '学号不能为空'
						},
						stringLength: {
							min: 10,
							max: 10,
							message: '学号为10位'
						},
						regexp: {
							regexp: /^[0-9]+$/,
							message: '学号只能是数字'
						}
					}
				},
				password: {
					validators: {
						notEmpty: {
							message: '密码不能为空'
						}
					}
				},
				acceptTerms: {
					validators: {
						notEmpty: {
							message: '需要同意协议'
						}
					}
				}
			}
		})
			.on('success.form.bv', function (e) {
				// Prevent form submission
				e.preventDefault();

				// Get the form instance
				var $form = $(e.target);

				// Get the BootstrapValidator instance
				var bv = $form.data('bootstrapValidator');

				// Use Ajax to submit form data
				$.post($form.attr('action'), $form.serialize(), function (result) {
					if (result.response === 'error') {

						$.scojs_message('用户名或者密码错误', $.scojs_message.TYPE_ERROR);
						$('#bindingForm').data('formValidation').resetForm();

					} else {
						console.log(result);
						$.scojs_message(result.username + '&nbsp;,欢迎登陆', $.scojs_message.TYPE_OK);
						stu.GoUrl(result.next_url, 1);
					}
				}, 'json');
			})
			.find('input[name="acceptTerms"]')
			// Init icheck elements
			.iCheck({
				// The tap option is only available in v2.0
				tap: true,
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			})
			// Called when the radios/checkboxes are changed
			.on('ifChanged', function (e) {
				// Get the field name
				var field = $(this).attr('name');
				$('#bindingForm').bootstrapValidator('revalidateField', field);
			})
			.end();
	});