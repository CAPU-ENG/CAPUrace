<?php
$this->load->view('admin_header');
$this->load->helper('form');

echo form_open('admin/auth/');
?>
<?php if ($error_no !== 0) { ?>
<p>错误 <?php echo $error_no; ?>: <?php echo $error_info; ?></p>
<?php } ?>
<label for="secret">口令</label>
<input type="password" name="secret" id="secret">
<br>
<label for="captcha">验证码</label>
<input type="password" name="captcha" id="captcha">
<?php echo $captcha_image; ?>
<input type="submit" value="登陆">
<?php
echo form_close();

$this->load->view('admin_footer');
