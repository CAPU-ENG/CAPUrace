<script type="text/javascript">
    var controller = "<?=site_url('user/resetpw')?>";
    var directto = "<?=site_url('user/login')?>";
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
    $("#passconf").bind("keypress",function(event) {
        if(event.keyCode == "13") {
            $("#btn-reset").disabled=true;
            $("#btn-reset").text("重置中...");
            resetPW();
            $("#btn-reset").disabled=false;
            $("#btn-reset").text("确认");
        }
    });
    $("#btn-reset").click(function () {
            this.disabled = true;
            $(this).text("重置中...");
            resetPW();
            this.disabled = false;
            $(this).text("确认");
        }
    );
</script>
