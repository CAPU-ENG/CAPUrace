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
    '东北地区（黑龙江省、吉林省、辽宁省、内蒙古自治区）',
    '山东地区（山东省）',
    '山西地区（山西省）',
    '其他地区（其他省、市、自治区）'
);
$PROVINCES_SHORT = array(
    '北京地区',
    '天津地区',
    '河北地区',
    '东北地区',
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
    '201' => '用户尚未激活，请您前往注册邮箱查收激活邮件！',
    '202' => '用户尚未通过审核，请您稍后登录！',
    '204' => '用户不存在，请注册！',
    '205' => '注册已截止',
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
    '1070' => '第{order}个人的第一天晚餐不合法。',
    '1080' => '第{order}个人的第二天午餐不合法。',
    '1081' => '第{order}个人是参赛选手，必须定第二天午餐。',
    '1090' => '第{order}个人的参赛项目不合法。',
    '1091' => '第{order}个人是观赛人员，不得参赛。',
    '1092' => '第{order}个人是参赛人员，参赛项目不得为空。',
    '1093' => '第{order}个人是男生，不可以参加女子组比赛。',
    '1094' => '第{order}个人是女生，不可以参加男子组比赛。',
    '1095' => '第{order}个人不可以同时参加大众和精英组比赛。',
    '1096' => '参加公路赛人数不得超过{quota}人。',
    '1097' => '抱歉，公路赛名额已满！',
    '1098' => '观众名额仅剩{quota}人。',
    '1099' => '每个学校观赛人数不得超过{quota}人。',
    '1100' => '第{order}个人的团体赛选项不合法。',
    '1101' => '第{order}个人是观赛人员，不得参加团体赛。',
    '1102' => '山地男子大众组名额已满！',
    '1103' => '山地女子组名额已满！',
    '1104' => '公路男子大众组名额已满！',
    '1105' => '公路女子组名额已满！',
    '1106' => '公路男子精英组名额已满！',
    '1107' => '山地男子精英组名额已满！',
    // Team Registration Error.
    '2000' => '第{order}组第{order_ind}个人不合法。',
    '2001' => '第{order}组第{order_ind}个人与第{order1}组第{order1_ind}个人重复。',
    '2002' => '参赛队伍不得超过3支。',
    '2003' => '报名团体赛人数与实际参加人数不匹配。'
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

$ID_TYPE = array(
    'identity' => '身份证',
    'passport' => '护照',
);

$IFRACE = array(
    '1' => '参赛',
    '0' => '观赛'
);

$CAPURACE_M = array(
    '0' => '不参加',
    '1' => '山地男子组',
);

$CAPURACE_F = array(
    '0' => '不参加',
    '1' => '山地女子组',
);

$CAPURDB_M = array(
    '0' => ' 不参加 ',
    '1' => ' 公路男子组 ',
);

$CAPURDB_F = array(
    '0' => ' 不参加 ',
    '1' => ' 公路女子组 ',
);

$RACE = array(
    '0' => '观赛',
    '1' => '参赛'
);


$RACE_M_QUOTA = 190;
$RACE_ELITE_QUOTA = 190;
$RACE_F_QUOTA = 190;
$RDB_M_QUOTA = 150;
$RDB_F_QUOTA = 55;
$RDB_ELITE_QUOTA = 75;
$RACE_TEAM_QUOTA = 60;

$AUDIENCE_QUOTA = 230;
$AUD_QUOTA_PER_SCHOOL = 3;

$ACCOMMODATION = array(
    '0' => '不需要',
    '1' => '旅馆',
    '2' => '露营（自带帐篷）',
);

$ACCO_FEE = array(
    '0' => 0,
    '1' => 55,
    '2' => 10,
);

/*
 * Date and Time Settings
 */

$SIGN_UP_DEADLINE = '2019-06-21';

/*
 * Admin user list
 */
$ADMIN = array(
    '霜降' => '9ee1accf374c1862c39e2784f224d7fd',
    '灰白' => '9ee1accf374c1862c39e2784f224d7fd',
    'capu' => '9ee1accf374c1862c39e2784f224d7fd'
);

$ACCOUNTANT_PASS = '9ee1accf374c1862c39e2784f224d7fd';
$PRESIDENT_PASS = '9ee1accf374c1862c39e2784f224d7fd';

/*
 * Documentation titles.
 */
$TITLES = array(
    'race-info' => '比赛基本信息',
    'race-info-rule' => '比赛规则',
    'race-info-award' => '比赛奖品',
    'race-info-map' => '赛场与赛道',
    'race-info-process' => '比赛流程',
    'activity' => '活动通知',
    'register-readme' => '报名须知',
    'competition-info-history' => '历史',
    'competition-info-sodality' => '联谊',
    'competition-info-event' => '赛事',
    'competition-info' => '赛场视频',
);
$NOT_AVAILABLE_TEXT = "<h3>文档暂未更新，请稍后查看！</h3>";

/* End of file constants.php */
/* Location: ./application/config/constants.php */
