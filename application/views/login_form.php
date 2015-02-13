<?php
/**
 * Created by PhpStorm.
 * User: Jeldor
 * Date: 1/27/15
 * Time: 08:05
 */
?>

<!DOCTYPE html>
<html>
<head>
    <title>登录</title>
</head>

<body>
<?php echo validation_errors(); ?>

<?php
echo form_open(site_url('user/login'));
echo '用户名' . form_input('mail', set_value('mail')) . br();
echo '密码' . form_password('password', '') . br();
echo form_submit('', '登录') . form_reset('', '重置');
echo form_close();
?>

</body>

</html>