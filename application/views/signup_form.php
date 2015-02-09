<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/26/15
 * Time: 19:11
 */
?>

<html>
<head>
    <title>新用户注册</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php

echo form_open(site_url('user/signup'));
echo '学校' . form_input('school', set_value('school')) . br();
echo '车协名称' . form_input('association_name', set_value('association_name')) . br();
$provinces = array(
    '北京市',
    '天津市',
    '上海市',
    '重庆市',
    '河北省',
    '河南省',
    '云南省',
    '辽宁省',
    '黑龙江',
    '湖南省',
    '安徽省',
    '山东省',
    '新疆维吾尔族自治区',
    '江苏省',
    '浙江省',
    '江西省',
    '湖北省',
    '广西壮族自治区',
    '甘肃省',
    '山西省',
    '内蒙古',
    '陕西省',
    '吉林省',
    '福建省',
    '贵州省',
    '广东省',
    '青海省',
    '西藏自治区',
    '四川省',
    '宁夏回族自治区',
    '海南省',
    '台湾省',
    '香港特别行政区',
    '澳门特别行政区'
);
echo '所在地区（省级行政区）' . form_dropdown('province', $provinces, set_value('province')) . br();
echo '领队姓名' . form_input('leader', set_value('leader')) . br();
echo '联系电话' . form_input('tel', set_value('tel')) . br();
echo '电子邮箱（登录名）' . form_input('mail', set_value('mail')) . br();
echo '密码' . form_password('password', set_value('password')) . br();
echo '再次输入密码' . form_password('passconf', set_value('passconf')) . br();
echo form_submit('submit', '登录') . form_reset('reset', '重置');
echo form_close();

?>

</body>
</html>