$(document).ready(function(){

	$('#userinfopost').bootstrapValidator({
		framework: 'bootstrap',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			sex: {
				validators: {
					notEmpty: {
						message: '必须选择性别'
					}
				}
			},
			email: {
				validators: {
					notEmpty: {
						message: 'email不能为空'
					},
					emailAddress: {
						message: 'email格式错误'
					}

				}
			},
			qq:{
				validators: {
					notEmpty: {
						message: 'QQ号不能为空'
					},
					stringLength: {
						min: 3,
						max: 15,
						message: 'qq号格式错误'
					},
					regexp: {
						regexp: /^[0-9]+$/,
						message: 'qq号格式错误'
					}
				}
			},
			long_phone:{
				validators: {
					notEmpty: {
						message: '长号不能为空'
					},
					stringLength: {
						min: 11,
						max: 11,
						message: '长号格式错误'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: '手机号只能全为数字'
					}
				}
			},
			short_phone:{
				validators: {
					notEmpty: {
						message: '短号不能为空'
					},
					stringLength: {
						min: 6,
						max: 6,
						message: '短号格式错误'
					},
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: '手机号只能全为数字'
					}
				}
			},
			qinshi:{
				validators: {
					notEmpty: {
						message: '寝室不能为空'
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
			if (result.response == false ) {

				$.scojs_message('提交失败', $.scojs_message.TYPE_ERROR);
				$.GoUrl(result.next_url, 1);

			} else {
				console.log(result);
				$.scojs_message('提交成功', $.scojs_message.TYPE_OK);
				$.GoUrl(result.next_url, 1);
			}
		}, 'json');
	})
		.end();
	$('#postpassword').bootstrapValidator({
		framework: 'bootstrap',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			password: {
				threshold: 6,
				validators:{
					remote: {
						url: SITE_URL+'user/check_password',
						message: '密码错误',
						type: 'POST'
					},
					notEmpty: {
						newpassword: '原密码不能为空'
					}
				}
			},
			newpassword: {
				validators: {
					notEmpty: {
						newpassword: '新密码不能为空'
					},
					identical: {
						field: 'confirmPassword',
						message: '新密码需和重复密码不相同'
					},
					callback: {
						newpassword: '密码不符合要求',
						callback: function(value, validator, $field) {
							if (value === '') {
								return true;
							}

							// Check the password strength
							if (value.length < 6) {
								return {
									valid: false,
									message: '密码需要长于6位才足够安全哦'
								};
							}

							//// The password doesn't contain any uppercase character
							//if (value === value.toLowerCase()) {
							//	return {
							//		valid: false,
							//		message: '密码至少需要一位大写字母才足够安全哦'
							//	}
							//}
							//
							//// The password doesn't contain any uppercase character
							//if (value === value.toUpperCase()) {
							//	return {
							//		valid: false,
							//		message: '密码至少需要一位小写字母才足够安全哦'
							//	}
							//}

							// The password doesn't contain any digit
							if (value.search(/[0-9]/) < 0) {
								return {
									valid: false,
									message: '密码至少需要有一个数字才足够安全哦'
								}
							}

							return true;
						}
					}
				}
			},
			confirmPassword: {
				validators: {
					identical: {
						field: 'newpassword',
						message: '新密码需和重复密码不相同'
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
			if (result.response == false) {

				$.scojs_message('提交失败', $.scojs_message.TYPE_ERROR);
				$.GoUrl(result.next_url, 1);

			} else {
				console.log(result);
				$.scojs_message('提交成功', $.scojs_message.TYPE_OK);
				$.GoUrl(result.next_url, 1);
			}
		}, 'json');
	})
		.end();

});