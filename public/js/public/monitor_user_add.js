$(document).ready(function(){

	$('#user_add').bootstrapValidator({
		framework: 'bootstrap',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			student_id: {
				message: '学号不能为空',
				validators: {
					notEmpty: {
						message: '用户名不能为空'
					},
					stringLength: {
						min: 10,
						max: 10,
						message: '学号必须为10位'
					},
					remote: {
						url: SITE_URL+'user/check_student_id',
						message: '该学号已经存在，请更换'
					}
				}
			},
			password: {
				threshold: 6,
				validators:{
					notEmpty: {
						message: '密码不能为空'
					}
				}
			},
			username: {
				validators:{
					notEmpty: {
						message: '用户名不能为空'
					}
				}
			},
			atschool: {
				validators:{
					notEmpty: {
						message: '是否在校'
					}
				}
			},
			college: {
				validators:{
					notEmpty: {
						message: '填写学院全称 例：自动化与电气工程学院'
					}
				}
			},
			classes:{
				validators:{
					notEmpty:{
						message: '填写行政班级 例：自动化131'
					}
				}
			},
			majoryear:{
				validators:{
					notEmpty:{
						message: '填写年级 例：13'
					},
					regexp: {
						regexp: /^[0-9]+$/,
						message: '年级格式错误'
					}
				}
			},
			major:{
				validators:{
					notEmpty:{
						message: '填写年级简称 例：自动化'
					}
				}
			},
			classnum:{
				validators:{
					notEmpty:{
						message: '填写班级号 例：131'
					},
					regexp: {
						regexp: /^[0-9]+$/,
						message: '班级号格式错误'
					}
				}
			},
			card_id:{
				validators:{
					notEmpty:{
						message: '填写身份证号'
					},
					regexp:{
						regexp: /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,
						message: '身份证格式错误'
					}
				}
			},
			zzmm:{
				validators:{
					notEmpty:{
						message: '请填写政治面貌'
					}
				}
			},
			sex: {
				validators: {
					notEmpty: {
						message: '必须选择性别'
					}
				}
			},
			email: {
				validators: {
					emailAddress: {
						message: 'email格式错误'
					}
				}
			},
			qq:{
				validators: {
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
			mz:{
				validators:{
					notEmpty:{
						message: '民族不能为空'
					}
				}
			},
			jg:{
				validators:{
					notEmpty:{
						message: '籍贯不能为空'
					}
				}
			},
			fa_phone:{
				validators: {
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: '手机号只能全为数字'
					}
				}
			},
			mo_phone:{
				validators: {
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: '手机号只能全为数字'
					}
				}
			},
			ybh:{
				validators: {
					regexp: {
						regexp: /^[0-9\.]+$/,
						message: '邮编号格式错误'
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

});