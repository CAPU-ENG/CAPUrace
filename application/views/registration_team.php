<div class="regcontainer">
    <h3>请录入团队信息</h3>
    <hr/>
    <div class="form-group reg">
        <label class="col-sm-1">序号</label>
        <label class="col-sm-3">第一棒</label>
        <label class="col-sm-3">第二棒</label>
        <label class="col-sm-3">第三棒</label>
        <br/><br/>
        <div class="team-form hidden">
            <div class="col-sm-1">
                <p class="order"></p>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="first">

                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="second">

                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="third">

                </select>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-danger btn-block" onclick="removeTeam($(this))">删除</button>
            </div>
            <br/>
            <br/>
        </div>
    </div>
    <hr/>
    <div class="col-sm-3">
        <button class="btn btn-info btn-block" id="return">返回修改人员信息</button>
    </div>
    <div class="col-sm-3">
        <button class="btn btn-primary btn-block" onclick="addTeam()">添加一个团队</button>
    </div>
    <div class="col-sm-3">
        <button class="btn btn-warning btn-block" onclick="cacheTeam()">暂时保存</button>
    </div>
    <div class="col-sm-3">
        <button class="btn btn-success btn-block" id="btn-reg-team-submit">提交</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        addTeam();
    });
    $("#btn-reg-team-submit").click(function() {
        window.location.href = "<?=site_url('registration/result')?>";
    });
    $(window).on('beforeunload', function() {
        cacheTeam();
    });
    $("#return").click(function() {
        window.location.href = "<?=site_url('registration/individual')?>";
    });
</script>
