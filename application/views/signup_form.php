<script type="text/javascript">
    var controller = "<?=site_url('user/signup')?>";
    var directto = "<?=base_url()?>";
</script>
<div class="signcontainer">
    <h3>请输入注册信息</h3>
    <hr/>
    <label class="col-sm-4">学校名称</label>
    <div class="col-sm-8">
        <input type="text" name="school" class="form-control" id="school">
    </div><br/><br/>
    <label class="col-sm-4">车协名称</label>
    <div class="col-sm-8">
        <input type="text" name="association_name" class="form-control" id="assoc">
    </div><br/><br/>
    <label class="col-sm-4">所在地区</label>
    <div class="col-sm-8">
        <?=form_dropdown('province', $GLOBALS['PROVINCES'], set_value('province'), 'class="form-control" id="province"')?>
    </div><br/><br/>
    <hr/>
    <label class="col-sm-4">领队姓名</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="leader" id="leader">
    </div><br/><br/>
    <label class="col-sm-4">联系电话</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="tel" id="tel">
    </div><br/><br/>
    <hr/>
    <label class="col-sm-4">电子邮箱</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="mail" id="mail">
    </div><br/><br/>
    <label class="col-sm-4">密码</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" name="password" id="password">
    </div><br/><br/>
    <label class="col-sm-4">密码确认</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" name="passconf" id="passconf">
    </div><br/><br/>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block">返回</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-success btn-block" onclick="postSignup()">注册</button>
    </div>
</div>
