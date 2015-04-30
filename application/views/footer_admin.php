<div class="container">
    <div class="col-sm-1"></div>
        <button class="btn btn-primary" id="btn-return-to-admin-index">管理员首页</button>
        <div class="btn-group">
            <button class="btn btn-primary" id="btn-go-to-pay">缴费后台</button>
            <button class="btn btn-primary" id="btn-go-to-info">报名数据</button>
        </div>
        <button class="btn btn-primary" id="btn-export-excel">导出总表</button>
        <button class="btn btn-warning" id="btn-logout">注销</button>
        <button class="btn btn-danger disabled" id="btn-close-system">关闭系统</button>
    <div class="col-sm-2"></div>
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
    $("#btn-go-to-info").click(function() {
        window.location.assign("<?=site_url('admin/info')?>");
    });
    $("#btn-export-excel").click(function() {
        window.open("<?=site_url('admin/export')?>");
    });
</script>
