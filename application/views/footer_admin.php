</div>
<div class="container">
    <h5 style="text-align: center">管理员操作</h5>
  <div class="col-sm-1"></div>
    <button class="btn btn-primary" id="btn-return-to-admin-index">管理员首页</button>
    <button class="btn btn-primary" id="btn-export-excel">导出总表</button>
    <div class="btn-group">
      <button class="btn btn-primary" id="btn-go-to-info">报名数据</button>
      <button class="btn btn-primary" id="btn-check-unacitvated">尚未激活</button>
      <button class="btn btn-primary" id="btn-go-to-unstarted">激活而未报名</button>
      <button class="btn btn-primary" id="btn-check-registrating">正在报名</button>
      <button class="btn btn-primary" id="btn-go-to-pay">缴费后台</button>
    </div>
    <button class="btn btn-warning" id="btn-logout">注销</button>
    <button class="btn btn-danger" id="btn-close-system">关闭系统</button>
  <div class="col-sm-1"></div>
  <br>
  <h5 style="text-align: center">赛事内容编辑</h5>
  <div class="col-sm-2"></div>
  <div class="btn-group">
    <button class="btn btn-primary" id="btn-race-info">比赛基本信息</button>
    <button class="btn btn-primary" id="btn-race-info-process">比赛流程</button>
    <button class="btn btn-primary" id="btn-race-info-rule">比赛规则</button>
    <button class="btn btn-primary" id="btn-race-info-map">赛场与赛道</button>
    <button class="btn btn-primary" id="btn-race-info-award">比赛奖品</button>
  </div>
  <button class="btn btn-primary" id="btn-register-readme">报名须知</button>
  <div class="col-sm-1"></div>
<div class="container">
  <h5 style="text-align: center">赛事报名结果编辑</h5>
  <div class="col-sm-2"></div>
  <div class="btn-group">
    <button class="btn btn-primary" id="btn-result-info">参赛高校</button>
    <button class="btn btn-primary" id="btn-result-info-male-mountain-classic">男子山地精英组</button>
    <button class="btn btn-primary" id="btn-result-info-male-mountain-general">男子山地大众组</button>
    <button class="btn btn-primary" id="btn-result-info-male-road-classic">男子公路精英组</button>
    <button class="btn btn-primary" id="btn-result-info-male-road-general">男子公路大众组</button>
    <button class="btn btn-primary" id="btn-result-info-female-mountain">女子山地组</button>
    <button class="btn btn-primary" id="btn-result-info-female-road">女子公路组</button>
    <div class="col-sm-1"></div>
</div>
<br>
<div class="container">
  <h5 style="text-align: center">赛事风采编辑</h5>
  <div class="col-sm-5"></div>
  <div class="btn-group">
    <button class="btn btn-primary" id="btn-competition-info-history">历史</button>
    <button class="btn btn-primary" id="btn-competition-info-sodality">联谊</button>
    <button class="btn btn-primary" id="btn-competition-info-event">赛事</button>
    <button class="btn btn-primary" id="btn-competition-info">赛场视频</button>
    <div class="col-sm-1"></div>
</div>
<br><br>
</body>
</html>
<script>
    $("[id='btn-clear-rdb']").prop('disabled', true);
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
        window.location.assign("<?=site_url('admin/export')?>");
    });
    $("#btn-go-to-unstarted").click(function() {
        window.location.assign("<?=site_url('admin/unstarted')?>");
    });
    $("#btn-check-unacitvated").click(function() {
        window.location.assign("<?=site_url('admin/unactivated')?>");
    });
    $("#btn-check-registrating").click(function() {
        window.location.assign("<?=site_url('admin/registering')?>");
    });
    $("#btn-race-info").click(function () {
        window.location.assign("<?=site_url('admin/edit/race-info')?>");
    });
    $("#btn-race-info-process").click(function () {
        window.location.assign("<?=site_url('admin/edit/race-info-process')?>");
    });
    $("#btn-race-info-rule").click(function () {
        window.location.assign("<?=site_url('admin/edit/race-info-rule')?>");
    });
    $("#btn-race-info-map").click(function () {
        window.location.assign("<?=site_url('admin/edit/race-info-map')?>");
    });
    $("#btn-race-info-award").click(function () {
        window.location.assign("<?=site_url('admin/edit/race-info-award')?>");
    });
    $("#btn-race-info-racevideo").click(function () {
        window.location.assign("<?=site_url('admin/edit/race-info-racevideo')?>");
    });
    $("#btn-register-readme").click(function () {
        window.location.assign("<?=site_url('admin/edit/register-readme')?>");
    });
    $("#btn-competition-info").click(function () {
        window.location.assign("<?=site_url('admin/edit/competition-info')?>");
    });
    $("#btn-competition-info-history").click(function () {
        window.location.assign("<?=site_url('admin/edit/competition-info-history')?>");
    });
    $("#btn-competition-info-sodality").click(function () {
        window.location.assign("<?=site_url('admin/edit/competition-info-sodality')?>");
    });
    $("#btn-competition-info-event").click(function () {
        window.location.assign("<?=site_url('admin/edit/competition-info-event')?>");
    });
    $("#btn-result-info").click(function () {
        window.location.assign("<?=site_url('admin/edit/result-info')?>");
    });
    $("#btn-result-info-male-mountain-classic").click(function () {
        window.location.assign("<?=site_url('admin/edit/result-info-male-mountain-classic')?>");
    });
    $("#btn-result-info-male-mountain-general").click(function () {
        window.location.assign("<?=site_url('admin/edit/result-info-male-mountain-general')?>");
    });
    $("#btn-result-info-male-road-classic").click(function () {
        window.location.assign("<?=site_url('admin/edit/result-info-male-road-classic')?>");
    });
    $("#btn-result-info-male-road-general").click(function () {
        window.location.assign("<?=site_url('admin/edit/result-info-male-road-general')?>");
    });
    $("#btn-result-info-female-mountain").click(function () {
        window.location.assign("<?=site_url('admin/edit/result-info-female-mountain')?>");
    });
    $("#btn-result-info-female-road").click(function () {
        window.location.assign("<?=site_url('admin/edit/result-info-female-road')?>");
    });
    $("#btn-close-system").click(function() {
        if (confirm('本操作将关闭整个报名系统，且不可恢复。确定继续？')) {
            $.post("<?=site_url('admin/shutdown')?>", {}, function (response) {
                alert(response.msg);
            });
        }
    })
</script>
