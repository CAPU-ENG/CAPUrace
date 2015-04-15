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
    '1000' => '第{order}个人的姓名不合法。',
    '1010' => '第{order}个人的性别不合法。',
    '1020' => '第{order}个人的手机号不合法。',
    '1021' => '第{order}个人的手机号与第{order1}个人重复。',
    '1030' => '第{order}个人的参赛情况不合法。',
    '1040' => '第{order}个人的清真选项不合法。',
    '1050' => '第{order}个人的身份证号不合法。',
    '1051' => '第{order}个人的身份证号与第{order1}个人重复。',
    '1060' => '第{order}个人的住宿方式不合法。',
    '1070' => '第{order}个人的5.16 晚餐不合法。',
    '1080' => '第{order}个人的5.17 午餐不合法。',
    '1090' => '第{order}个人的参赛项目不合法。',
    '1091' => '第{order}个人是观赛人员，不得参赛。',
    '1092' => '第{order}个人是参赛人员，参赛项目不得为空。',
    '1093' => '第{order}个人是男生，不可以参加女子组比赛。',
    '1094' => '第{order}个人是女生，不可以参加男子组比赛。',
    '1100' => '第{order}个人的团体赛选项不合法。',
    '1101' => '第{order}个人是观赛人员，不得参加团体赛。',
    '1110' => '第{order}个人的5.16 公路选项不合法。',
    '1111' => '第{order}个人是男生，不可以参加 5.16 公路女子组。',
    '1112' => '第{order}个人是女生，不可以参加 5.16 公路男子组。',
    '1120' => '第{order}个人的5.17 山地选项不合法。',
    '1121' => '第{order}个人是男生，不可以参加 5.17 山地女子组。',
    '1122' => '第{order}个人是女生，不可以参加 5.17 山地男子组。',
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
    '1' => '男子组',
);

$CAPURACE_F = array(
    '0' => '不参加',
    '2' => '女子组',
);

$CAPURACE = array(
    '0' => ' 不参加 ',
    '1' => ' 男子组 ',
    '2' => ' 女子组 ',
);

$RACE_ALL = array(
    '0' => ' 不参加 ',
    '1' => ' 男子组 ',
    '2' => ' 女子组 ',
    '3' => ' 团体赛 '
);

$RACE = array(
    '0' => '观赛',
    '1' => '参赛'
);

$SHIMANO_RDB_M = array(
    '0' => '不参加',
    '1' => '男子初级组',
    '2' => '男子中级组',
    '3' => '男子精英组',
    '5' => '小轮组'
);

$SHIMANO_RDB_F = array(
    '0' => '不参加',
    '4' => '女子组',
    '5' => '小轮组'
);

$SHIMANO_RDB = array(
    '0' => '不参加',
    '1' => '男子初级组',
    '2' => '男子中级组',
    '3' => '男子精英组',
    '4' => '女子组',
    '5' => '小轮组'
);

$SHIMANO_MTB_M = array(
    '0' => '不参加',
    '1' => '男子初级组',
    '2' => '男子中级组',
    '3' => '男子精英组',
    '5' => '大众体验组'
);

$SHIMANO_MTB_F = array(
    '0' => '不参加',
    '4' => '女子组',
    '5' => '大众体验组'
);

$SHIMANO_MTB = array(
    '0' => '不参加',
    '1' => '男子初级组',
    '2' => '男子中级组',
    '3' => '男子精英组',
    '4' => '女子组',
    '5' => '大众体验组'
);

$ACCOMMODATION = array(
    '0' => '不需要',
    '1' => '旅馆',
    '2' => '露营（自带帐篷）',
    '3' => '露营（租用帐篷）'
);

$ACCO_FEE = array(
    '0' => 0,
    '1' => 50,
    '2' => 30,
    '3' => 30
);

/* End of file constants.php */
/* Location: ./application/config/constants.php */
