<script type="text/javascript">
    var controller = "<?=site_url('user/forgetpw')?>";
    var directto = "<?=base_url()?>";
</script>
<div class="signcontainer">
    <h3>请输入注册邮箱 </h3>
    <br/><br/>
    <label class="col-sm-4">电子邮箱</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="mail" id="mail">
    </div><br/><br/>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block" id="btn-back">返回</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-success btn-block" id="btn-forgetpw">发送验证码</button>
    </div>
</div>
<script>
    $("#passconf").bind("keypress",function(event) {
        if(event.keyCode == "13") {
        $("#btn-forgetpw").disabled=true;
        $("#btn-forgetpw").text("发送中...");
        forgetpw();
        $("#btn-forgetpw").disabled=false;
        $("#btn-forgetpw").text("发送验证码");
        }
    });
    $("#btn-back").click(function() {
        window.location.href = "<?=site_url('user/login')?>";
    });
    $("#btn-forgetpw").click(function() {
        this.disabled=true;
        $(this).text("发送中...");
        forgetpw();
        this.disabled=false;
        $(this).text("发送验证码");
    });
</script>
