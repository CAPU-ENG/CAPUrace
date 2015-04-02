<div class="regcontainer">
  <h3>报名须知</h3>
  <p class="text-justify">
    balabala
    <br/>
    balabala
  </p>
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
</script>
