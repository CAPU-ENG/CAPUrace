<hr/>
<div class="col-sm-4"></div>
<div class="col-sm-4">
    <button class="btn btn-success btn-block" id="return-to-admin-index">管理员首页</button>
</div>
<div class="col-sm-4"></div>
</body>
</html>
<script>
    $("#return-to-admin-index").click(function() {
        window.location.assign("<?=site_url('admin/index')?>");
    })
</script>
