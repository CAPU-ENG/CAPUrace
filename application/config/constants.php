<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
 * ------------------------------------------------------------------------
 * Province Settings
 * ------------------------------------------------------------------------
 *
 * This array is for the dropdown-menu in the sign up form.
 *
 */

$PROVINCES = array(
    '北京市',
    '天津市',
    '上海市',
    '重庆市',
    '河北省',
    '河南省',
    '云南省',
    '辽宁省',
    '黑龙江省',
    '吉林省',
    '安徽省',
    '江苏省',
    '浙江省',
    '江西省',
    '湖北省',
    '湖南省',
    '甘肃省',
    '山东省',
    '山西省',
    '广东省',
    '陕西省',
    '福建省',
    '贵州省',
    '青海省',
    '四川省',
    '海南省',
    '宁夏回族自治区',
    '西藏自治区',
    '内蒙古自治区',
    '广西壮族自治区',
    '新疆维吾尔族自治区',
    '台湾省',
    '香港特别行政区',
    '澳门特别行政区'
);

/* End of file constants.php */
/* Location: ./application/config/constants.php */