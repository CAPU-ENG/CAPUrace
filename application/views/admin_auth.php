<div class="signcontainer">
    <h3>管理员登录</h3>
    <hr/>
    <div class="row">
        <label class="col-sm-4">口令</label>
        <div class="col-sm-8">
            <input class="form-control" name="pass">
        </div>
    </div>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-block btn-warning" id="return-to-index">返回</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-block btn-success" id="go-to-admin">登录</button>
    </div>
</div>
<script>
    $("#return-to-index").click(function() {
        window.location.assign("<?=site_url('index')?>");
    });
    $("#go-to-admin").click(function() {
        var pass = $("[name='pass']").val();
        pass = $.md5(pass);
        var data = {
            pass: pass
        };
        $.post("<?=site_url('user/admin')?>", data, function(response) {
            if (response != 0) {
                alert('口令错误！');
            } else {
                window.location.assign('<?=site_url('admin')?>');
            }
        });
    });
</script>