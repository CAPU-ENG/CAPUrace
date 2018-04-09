<script type="text/javascript">
    var controller = "<?=site_url('user/resetpw')?>";
    var directto = "<?=base_url()?>";
</script>
<div class="signcontainer">
    <h3>重置密码 </h3>
    <hr/>
    <label class="col-sm-4">电子邮箱</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="mail" id="mail">
    </div><br/><br/>
    <label class="col-sm-4">新密码</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" name="password" id="password">
    </div><br/><br/>
    <label class="col-sm-4">新密码确认</label>
    <div class="col-sm-8">
        <input type="password" class="form-control" name="passconf" id="passconf">
    </div><br/><br/>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block" id="btn-back">返回</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-success btn-block" id="btn-reset">确认</button>
    </div>
</div>

<script>
    $("#btn-send-vcode").click(function () {
            this.disabled = true;
            $(this).text("发送中...");
            sendVcode();
            this.disabled = false;
            $(this).text("再次发送");
        }
    );
    $("#btn-vcode").click(function() {
        this.disabled = true;
        $(this).text("验证中...");
        checkVcode();
        this.disabled = false;
        $(this).text("重新验证");
    });
</script>
