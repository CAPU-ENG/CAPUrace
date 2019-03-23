<script type="text/javascript">
    var controller = "<?=site_url('user/signup')?>";
    var directto = "<?=base_url()?>";
</script>
<div class="signcontainer">
    <h3>重置密码 </h3>
    <hr/>
    <label class="col-sm-4">电子邮箱</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="mail" id="mail">
    </div><br/><br/>
    <label class="col-sm-4">验证码</label>
    <div class="col-sm-8">
        <input type="text" name="association_name" class="form-control" id="assoc">
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
        <button class="btn btn-success btn-block" id="btn-signup">注册</button>
    </div>
</div>
<script>
    $("#passconf").bind("keypress",function(event) {
        if(event.keyCode == "13") {
        $("#btn-signup").disabled=true;
        $("#btn-signup").text("注册中...");
        postSignup();
        $("#btn-signup").disabled=false;
        $("#btn-signup").text("注册");
        }
    });
    $("#btn-back").click(function() {
        window.location.href = "<?=site_url('user/login')?>";
    });
    $("#btn-signup").click(function() {
        this.disabled=true;
        $(this).text("注册中...");
        postSignup();
        this.disabled=false;
        $(this).text("注册");
    });
    $(document).ready(function() {
        var signUpDeadline = new Date("<?= $GLOBALS['SIGN_UP_DEADLINE']?>");
        var now = new Date();
        if (now > signUpDeadline) {
            alert("注册已截止");
            window.location.href = "<?=site_url('')?>"
        }
    });
</script>
