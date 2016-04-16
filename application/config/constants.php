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
    '北京地区（北京市）',
    '天津地区（天津市）',
    '河北地区（河北省）',
    '辽宁地区（辽宁省）',
    '黑吉地区（黑龙江省、吉林省）',
    '山东地区（山东省）',
    '山西地区（山西省）',
    '其他地区（其他省、市、自治区）'
);
$PROVINCES_SHORT = array(
    '北京地区',
    '天津地区',
    '河北地区',
    '辽宁地区',
    '黑吉地区',
    '山东地区',
    '山西地区',
    '其他地区'
);

/*
 * Error message settings;
 * =======================
 * These messages are error messages returned to user input.
 *
 */
$ERR_MSG = array(
    '200' => 'OK.',
    '202' => '用户尚未通过审核，请您稍后登录！',
    '204' => '用户不存在，请注册！',
    '400' => '存在不合法输入，请检查手机号、邮箱等信息是否正确填写！',
    '401' => '密码错误，请重新输入！',
    // Individual Registration Error.
    '999' => '人员名单不能为空。',
    '1000' => '第{order}个人的姓名不合法。',
    '1010' => '第{order}个人的性别不合法。',
    '1020' => '第{order}个人的手机号不合法。',
    '1021' => '第{order}个人的手机号与第{order1}个人重复。',
    '1030' => '第{order}个人的参赛情况不合法。',
    '1040' => '第{order}个人的清真选项不合法。',
    '1050' => '第{order}个人的身份证号不合法。',
    '1051' => '第{order}个人的身份证号与第{order1}个人重复。',
    '1060' => '第{order}个人的住宿方式不合法。',
    '1070' => '第{order}个人的 5.16 晚餐不合法。',
    '1080' => '第{order}个人的 5.17 午餐不合法。',
    '1081' => '第{order}个人是参赛选手，必须定 5.17 午餐。',
    '1090' => '第{order}个人的参赛项目不合法。',
    '1091' => '第{order}个人是观赛人员，不得参赛。',
    '1092' => '第{order}个人是参赛人员，参赛项目不得为空。',
    '1093' => '第{order}个人是男生，不可以参加女子组比赛。',
    '1094' => '第{order}个人是女生，不可以参加男子组比赛。',
    '1100' => '第{order}个人的团体赛选项不合法。',
    '1101' => '第{order}个人是观赛人员，不得参加团体赛。',
    '1110' => '第{order}个人的 5.16 公路选项不合法。',
    '1111' => '第{order}个人是男生，不可以参加 5.16 公路女子组。',
    '1112' => '第{order}个人是女生，不可以参加 5.16 公路男子组。',
    '1120' => '第{order}个人的 5.17 山地选项不合法。',
    '1121' => '第{order}个人是男生，不可以参加 5.17 山地女子组。',
    '1122' => '第{order}个人是女生，不可以参加 5.17 山地男子组。',
    // Team Registration Error.
    '2000' => '第{order}组第{order_ind}个人不合法。',
    '2001' => '第{order}组第{order_ind}个人与第{order1}组第{order1_ind}个人重复。',
    '2002' => '参赛队伍不得超过3支。'
);

/*
 * Selector options
 * ========================
 * These associative arrays are for the selectors in the forms.
 */
$JUDGE = array(
    '0' => '否',
    '1' => '是'
);

$TF = array(
    'true' => '是',
    'false' => '否'
);

$GENDER = array(
    '1' => '男',
    '2' => '女'
);

$IFRACE = array(
    '1' => '参赛',
    '0' => '观赛'
);

$CAPURACE_M = array(
    '0' => '不参加',
    '1' => '男子大众组',
    '2' => '男子精英组'
);

$CAPURACE_F = array(
    '0' => '不参加',
    '3' => '女子组',
);

$CAPURACE = array(
    '0' => ' 不参加 ',
    '1' => ' 男子大众组 ',
    '2' => ' 男子精英组 ',
    '3' => ' 女子组 ',
);

$RACE = array(
    '0' => '观赛',
    '1' => '参赛'
);

$ACCOMMODATION = array(
    '0' => '不需要',
    '1' => '旅馆',
    '2' => '露营（自带帐篷）',
);

$ACCO_FEE = array(
    '0' => 0,
    '1' => 50,
    '2' => 10,
);

/*
 * Admin user list
 */
$ADMIN = array(
    '老蒋' => 'bf7d6c2e83eaa18f185c127ce495ec7c',
    '喵喵' => 'f1466c1c2a641cd47a48e8076711e808',
    '毛毛熊' => '124fe97157e01351785faa69b5189c13',
    'capu' => 'ea23bef773499d151cfd5d7f2da8ba75'
);

$ACCOUNTANT_PASS = 'f1466c1c2a641cd47a48e8076711e808';
$PRESIDENT_PASS = '124fe97157e01351785faa69b5189c13';

/* End of file constants.php */
/* Location: ./application/config/constants.php */
