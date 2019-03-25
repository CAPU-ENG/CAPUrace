<script type="text/javascript">
    var controller = "<?=site_url('user/login')?>";
    var directto = "<?=base_url()?>";
</script>

<div class="signcontainer">
    <h3>高校用户登录</h3>
    <hr/>
    <div class="col-sm-4">邮箱</div>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="mail" id="mail">
    </div>
    <br/>
    <br/>
    <div class="col-sm-4">密码</div>
    <div class="col-sm-8">
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <br/>
    <br/>
    <div class="col-sm-4" ><a href="<?=site_url('user/forgetpw')?>">忘记密码</a></div>
    <br/>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block" id="btn-signup">注册</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-success btn-block" id="btn-login">登录</button>
    </div>
</div>
<script>
    $("#password").bind("keypress",function(event) {
        if(event.keyCode == "13") {
            postLogin();
        }
    });
    $("#btn-signup").click(function() {
        window.location.href = "<?=site_url('user/signup')?>";
    });
    $("#btn-login").click(function() {
        localStorage.removeItem('team');
        localStorage.removeItem('individual');
        postLogin();
    });
</script>
