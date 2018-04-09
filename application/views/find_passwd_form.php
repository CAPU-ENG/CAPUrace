<script type="text/javascript">
    var controller = "<?=site_url('user/forgetpw')?>";
    var directto = "<?=base_url()?>";
</script>
<div class="signcontainer">
    <h3>请输入注册时的邮箱 </h3>&nbsp; <u>操作提示：输入邮箱后，点击“发送验证码”按钮。前往邮箱查看验证码，在“验证码”一栏填写，点击“验证”按钮完成验证，进入重置密码。</u>
    <hr/>
    <label class="col-sm-4">电子邮箱</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="mail" id="mail">
    </div><br/><br/>
    <label class="col-sm-4">验证码</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="vcode" id="vcode">
    </div><br/><br/>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block" id="btn-send-vcode">发送验证码</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block" id="btn-vcode">验证</button>
    </div>
</div>

<script>
    $("#btn-send-vcode").click(function () {
            this.disabled = true;
            $(this).text("发送中...");
            sendVcode();
            this.disabled = false;
            $(this).text("已发送");
        }
    );
    $("#btn-vcode").click(function() {
        window.location.href = "<?=site_url('user/forgetpw')?>";
    });
</script>
