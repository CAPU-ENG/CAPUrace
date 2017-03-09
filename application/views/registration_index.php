<div class="regcontainer">
  <div class="content">
      <?php
      if ($publish) {
          echo $GLOBALS['NOT_AVAILABLE_TEXT'];
      } else {
          echo $text;
      }
      ?>
  </div>
  <div class="text-center red">
    <b>注意：比赛当日前未满18岁的选手请&nbsp;<a href="<?=base_url()?>assets/images/statement.pdf" target="_blank"><u>下载免责声明</u></a></b>
  </div>

  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4 text-center">
      <div class="checkbox">
        <label><input type="checkbox" id="checkbox-reg-agree">我已阅读并同意以上协议</label>
      </div>
    </div>
    <div class="col-sm-4">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-block" id="btn-reg-agree" disabled>开始报名</button>
    </div>
    <div class="col-sm-4">
    </div>
  </div>
</div>
<script>
    $("#checkbox-reg-agree").change(function() {
        $('#btn-reg-agree').prop('disabled', !this.checked);
    });
    $("#btn-reg-agree").click(function() {
        window.location.href = "<?=site_url('registration/individual')?>";
    });
</script>
