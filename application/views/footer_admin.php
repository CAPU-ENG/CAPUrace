</div>
<div class="container">
    <h5 style="text-align: center">管理员操作</h5>
  <div class="col-sm-1"></div>
    <button class="btn btn-primary" id="btn-return-to-admin-index">管理员首页</button>
    <button class="btn btn-primary" id="btn-export-excel">导出总表</button>
    <div class="btn-group">
      <button class="btn btn-primary" id="btn-go-to-info">报名数据</button>
      <button class="btn btn-primary" id="btn-go-to-confirm">高校审核</button>
      <button class="btn btn-primary" id="btn-check-unacitvated">尚未激活</button>
      <button class="btn btn-primary" id="btn-go-to-pay">缴费后台</button>
      <button class="btn btn-primary" id="btn-check-registrating">正在报名</button>
    </div>
    <button class="btn btn-warning" id="btn-logout">注销</button>
    <button class="btn btn-danger" id="btn-close-system">关闭系统</button>
  <div class="col-sm-1"></div>
  <br>
  <h5 style="text-align: center">编辑内容</h5>
  <div class="col-sm-1"></div>
  <div class="btn-group">
    <button class="btn btn-primary" id="btn-race-info">比赛基本信息</button>
    <button class="btn btn-primary" id="btn-race-info-process">比赛流程</button>
    <button class="btn btn-primary" id="btn-race-info-rule">比赛规则</button>
    <button class="btn btn-primary" id="btn-race-info-map">赛场与赛道</button>
    <button class="btn btn-primary" id="btn-race-info-award">比赛奖品</button>
    <button class="btn btn-primary" id="btn-race-info-racevideo">赛场视频</button>
  </div>
  <button class="btn btn-primary" id="btn-activity">活动通知</button>
  <button class="btn btn-primary" id="btn-register-readme">报名须知</button>
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
    $("#btn-go-to-confirm").click(function() {
        window.location.assign("<?=site_url('admin/confirm')?>");
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
    $("#btn-activity").click(function () {
        window.location.assign("<?=site_url('admin/edit/activity')?>");
    });
    $("#btn-register-readme").click(function () {
        window.location.assign("<?=site_url('admin/edit/register-readme')?>");
    });
    $("#btn-close-system").click(function() {
        if (confirm('本操作将关闭整个报名系统，且不可恢复。确定继续？')) {
            $.post("<?=site_url('admin/shutdown')?>", {}, function (response) {
                alert(response.msg);
            });
        }
    })
</script>
