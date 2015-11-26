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




