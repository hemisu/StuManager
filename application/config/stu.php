<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * 系统版本
 */
$config['stu_status'] = array (
	'systemVersion' => '1.0.0',
	'open' => true,
);
/*
 * 站点信息
 */
$config['siteinfo'] = array(
	'sitename' => '学生管理系统 StuManager'
);
/*
 * 事项模板
 */
$config['stu_task'] = array (
	'return_statistic' => '返校统计',
	'leave_statistic' => '离校统计',
	'stay_statistic' => '留校统计',
	'evaluate' => '学业综合评定',
	'completedata' => '资料补全',
	'scholarship' => '奖学金评定',
	'identify_poor' => '贫困生认定',
	'work_study' => '勤工助学',
	'work_study_hours' => '勤工工时填写',

);
/*
 * UI颜色
 */
$config['progress_color']=array('green','aqua','light','red','yellow','muted');
/*
 * 阿里云Access
 */
$config['aliyunAccess'] = array (
	'KeyID' => 'heePH42PYly0tbWt',
	'Secret' => 'mzb0pkTEJNPYxPBFIBaNUFaEw4Vl51',
);
/*
 * 七牛云Access
 */
$config['qiniuAccess'] = array (
	'accessKey' => 'u2Yv3iO5kpgK9j-hKkBFtvHY14XMg_6yCaZwIA3k',
	'secretKey' => 'JnQuR9BrKSIWeRcj-ei1EUh4trj0EdI02IFX2Yt9'
);
/*
 * 七牛云外链地址
 */
$config['qiniubaseurl'] = 'http://7xozcr.com1.z0.glb.clouddn.com/';
//source.hemisu.com
/*
 * 126邮箱
 */
$config['email_126'] = array(
	'smtp_host' => 'smtp.126.com',
	'smtp_user' => 'hekunyu@126.com',
	'smtp_pass' => '0gaza14713a'
);
