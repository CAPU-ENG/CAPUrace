<script type="text/javascript">
    var controller = "<?=site_url('user/resetpw')?>";
    var directto = "<?=base_url()?>";
</script>

<?php if ($status == 0 ):?>
    <div class="signcontainer">
      <h3>重置密码 </h3>
      <hr/>
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
        <button class="btn btn-success btn-block" id="btn-signup">重置</button>
      </div>
    </div>
    <hr/>
    <?php endif; ?>

<?php if ($status == 1 ):?>
    <p style="color: red">激活码无效或您已成功激活。</p>
    <hr/>
    <?php endif; ?>
<?php if ($status == 2 ):?>
    <p style="color: red">激活码不存在。</p>
    <hr/>
    <?php endif; ?>

<script>
    $("#passconf").bind("keypress",function(event) {
        if(event.keyCode == "13") {
        $("#btn-signup").disabled=true;
        $("#btn-signup").text("重置中...");
        resetpw();
        $("#btn-signup").disabled=false;
        $("#btn-signup").text("重置");
        }
    });
    $("#btn-back").click(function() {
        window.location.href = "<?=site_url('user/login')?>";
    });
    $("#btn-signup").click(function() {
        this.disabled=true;
        $(this).text("重置中...");
        resetpw();
        this.disabled=false;
        $(this).text("重置");
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
