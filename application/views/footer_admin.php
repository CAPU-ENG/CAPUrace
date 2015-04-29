<div class="container">
    <div class="col-sm-1"></div>
    <div class="col-sm-2">
        <button class="btn btn-primary btn-block" id="btn-return-to-admin-index">管理员首页</button>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-primary btn-block" id="btn-go-to-pay">缴费后台</button>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-primary btn-block disabled" id="btn-export-excel">导出总表</button>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-warning btn-block" id="btn-logout">注销</button>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-danger btn-block disabled" id="btn-close-system">关闭系统</button>
    </div>
    <div class="col-sm-1"></div>
</div>
</body>
</html>
<script>
    $("#btn-return-to-admin-index").click(function() {
        window.location.assign("<?=site_url('admin/index')?>");
    });
    $("#btn-go-to-pay").click(function() {
        window.location.assign("<?=site_url('admin/pay')?>");
    });
    $("#btn-logout").click(function() {
        window.location.assign("<?=site_url('admin/logout')?>");
    });
</script>
