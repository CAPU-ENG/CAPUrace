<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/26/15
 * Time: 19:11
 */
?>

<!DOCTYPE html>
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
echo '所在地区（省级行政区）' . form_dropdown('province', $GLOBALS['PROVINCES'], set_value('province')) . br();
echo '领队姓名' . form_input('leader', set_value('leader')) . br();
echo '联系电话' . form_input('tel', set_value('tel')) . br();
echo '电子邮箱（登录名）' . form_input('mail', set_value('mail')) . br();
echo '密码' . form_password('password', '') . br();
echo '再次输入密码' . form_password('passconf', '') . br();
echo form_submit('', '注册') . form_reset('', '重置');
echo form_close();

?>

</body>
</html>