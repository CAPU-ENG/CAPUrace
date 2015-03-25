<?php echo validation_errors(); ?>

<div class="signcontainer">
    <h3>请输入注册信息</h3>
    <hr/>
    <label class="col-sm-4">学校名称</label>
    <div class="col-sm-8">
        <input type="text" name="school" class="form-control">
    </div><br/><br/>
    <label class="col-sm-4">车协名称</label>
    <div class="col-sm-8">
        <input type="text" name="association_name" class="form-control">
    </div><br/><br/>
    <label class="col-sm-4">所在地区</label>
    <div class="col-sm-8">
        <?=form_dropdown('province', $GLOBALS['PROVINCES'], set_value('province'), 'class="form-control"')?>
    </div><br/><br/>
    <hr/>
    <label class="col-sm-4">领队姓名</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="leader">
    </div><br/><br/>
    <label class="col-sm-4">联系电话</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="tel">
    </div><br/><br/>
    <hr/>
    <label class="col-sm-4">电子邮箱</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="mail">
    </div><br/><br/>
    <label class="col-sm-4">密码</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" name="password">
    </div><br/><br/>
    <label class="col-sm-4">密码确认</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" name="passconf">
    </div><br/><br/>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block">返回</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-success btn-block">注册</button>
    </div>



</div>

<!--
--><?php
/*
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

*/?>
