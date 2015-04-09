<div class="indcontainer">
    <p> <h3>请录入人员信息</h3></p>
    <hr/>
    <div class="form-group reg">
        <label class="col-sm-1">姓名</label>
        <div class="col-sm-2">
            <input class="form-control" name="name" type="text">
        </div>
        <label class="col-sm-1">性别</label>
        <div class="col-sm-1">
            <select class="form-control" name="gender">
                <?php foreach ($GLOBALS['GENDER'] as $key => $value): ?>
                    <option value="<?=$key?>"><?=$value?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <label class="col-sm-1">手机</label>
        <div class="col-sm-2">
            <input class="form-control" name="tel" type="text">
        </div>
        <label class="col-sm-1">参赛情况</label>
        <div class="col-sm-1">
            <select class="form-control" name="ifrace">
                <option value="0">观赛</option>
                <option value="1">参赛</option>
            </select>
        </div>
        <label class="col-sm-1">清真</label>
        <div class="col-sm-1">
            <select class="form-control" name="islam">
                <option value="0">否</option>
                <option value="1">是</option>
            </select>
        </div>
        <br/>
        <br/>
        <label class="col-sm-1">身份证号</label>
        <div class="col-sm-4">
            <input class="form-control" name="id_card" type="text">
        </div>
        <label class="col-sm-1">住宿方式</label>
        <div class="col-sm-2">
            <select class="form-control" name="accommodation">
                <?php foreach ($GLOBALS['ACCOMMODATION'] as $key => $value): ?>
                    <option value="<?=$key?>"><?=$value?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <label class="col-sm-1">5.16晚餐</label>
        <div class="col-sm-1">
            <input type="checkbox" name="meal16">
        </div>
        <label class="col-sm-1">5.17午餐</label>
        <div class="col-sm-1">
            <input type="checkbox" name="meal17">
        </div>
        <br/>
        <br/>
        <div class="show-if-attend">
            <label class="col-sm-1">个人赛</label>
            <div class="col-sm-2">
                <select class="form-control" name="race">
                    <?php foreach ($GLOBALS['CAPURACE'] as $key => $value): ?>
                        <option value="<?=$key?>"><?=$value?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label class="col-sm-1">团体赛</label>
            <div class="col-sm-1">
                <input type="checkbox" name="ifteam">
            </div>
            <div class="show-if-race">
                <label class="col-sm-1">赠送项目</label>
                <label class="col-sm-1">5.16公路</label>
                <div class="col-sm-2">
                    <select class="form-control" name="shimano16">
                        <?php foreach ($GLOBALS['SHIMANO_RDB'] as $key => $value): ?>
                            <option value="<?=$key?>"><?=$value?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <label class="col-sm-1">5.17山地</label>
                <div class="col-sm-2">
                    <select class="form-control" name="shimano17">
                        <?php foreach ($GLOBALS['SHIMANO_MTB'] as $key => $value): ?>
                            <option value="<?=$key?>"><?=$value?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br/>
            <br/>
        </div>
    </div>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-primary btn-block" id="return-to-index">返回</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block" id="cache">保存</button>
    </div>
    <br/>
</div>
<div class="col-sm-4"></div>
<div class="col-sm-4">
    <button class="btn btn-success btn-block" id="btn-reg-ind-submit">提交，前往团体赛报名</button>
</div>
<div class="col-sm-4"></div>
<script>
    $(document).ready(function() {
        if ($(".order:last").text() == "0") {
            addIndividual();
        } else {
            refreshOrder();
        }
    });
    $("#btn-reg-ind-submit").click(function() {
        window.location.href = "<?=site_url('registration/team')?>";
    });
    $("#return-to-index").click(function() {
        cacheIndividual();
        window.location.href = "<?=site_url('registration')?>";
    });
    $(window).on('beforeunload', function() {
        cacheIndividual();
    });
</script>
