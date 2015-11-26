requirejs.config({
	baseUrl: SITE_URL + 'public/AdminLTE2',
	paths: {
		"jquery": "plugins/jQuery/jQuery-2.1.4.min",
		"bootstrap": "bootstrap/js/bootstrap",
		"bootstrapValidator": "plugins/bootstrap-validator/js/bootstrapValidator.min",
		"message": "plugins/sco/js/sco.message",
		"iCheck": "plugins/iCheck/icheck.min",
		"stu": "stu",
		"fastclick": "plugins/fastclick/fastclick.min",
		"app": "dist/js/app.min",
		"sparkline": "plugins/sparkline/jquery.sparkline.min",
		"slimScroll": "plugins/slimScroll/jquery.slimscroll.min",
		"chartjs": "plugins/chartjs/Chart.min",
		"dashboard2": "dist/js/pages/dashboard2",
		"demo": "dist/js/demo",
		"jvectormap":  "plugins/jvectormap/jquery-jvectormap-1.2.2.min"
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
		"stu": ['jquery'],
		"app":{
			exports: "$",
			deps: ['jquery']
		},
		"sparkline": {
			exports: "$",
			deps: ['jquery']
		},
		"slimScroll": {
			exports: "$",
			deps: ['jquery']
		},
		"dashboard2": {
			exports: "$",
			deps: ['jquery']
		},
		"demo": {
			exports: "$",
			deps: ['jquery']
		},
		"jvectormap": {
			exports: "$",
			deps: ['jquery']
		}
	}
});

requirejs(['jquery', 'message', 'bootstrap', 'bootstrapValidator', 'message', 'iCheck', 'stu','chartjs'],
	function ($, message, bootstrap, bootstrapValidator, message, iCheck, stu, chartjs) {

	});