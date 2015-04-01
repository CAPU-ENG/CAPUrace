<script type="text/javascript">
    var controller = "<?=site_url('user/login')?>";
    var directto = "<?=base_url()?>";
</script>

<div class="signcontainer">
    <h3>高校用户登录</h3>
    <hr/>
    <div class="col-sm-4">用户名</div>
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
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block">注册</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-success btn-block" onclick="postLogin()">登录</button>
    </div>
</div>
