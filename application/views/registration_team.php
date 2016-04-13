<div class="regcontainer">
    <h3>请录入团队信息（修改数据后请提交，否则无法保存！）</h3>
    <hr/>
    <div class="form-group reg">
        <label class="col-sm-2">序号</label>
        <label class="col-sm-2">第一棒（男生）</label>
        <label class="col-sm-2">第二棒（男生）</label>
        <label class="col-sm-2">第三棒（女生）</label>
        <label class="col-sm-2">第四棒（男生）</label>
        <br/><br/>
        <div class="team-form hidden">
            <div class="row team-item">
                <div class="col-sm-2">
                    <p class="order"></p>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="first">
                        <option value="">--请选择--</option>
                        <?php foreach ($male as $item): ?>
                        <option value="<?=$item['team_key']?>"><?=$item['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="second">
                        <option value="">--请选择--</option>
                        <?php foreach ($male as $item): ?>
                            <option value="<?=$item['team_key']?>"><?=$item['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="third">
                        <option value="">--请选择--</option>
                        <?php foreach ($female as $item): ?>
                            <option value="<?=$item['team_key']?>"><?=$item['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="fourth">
                        <option value="">--请选择--</option>
                        <?php foreach ($male as $item): ?>
                            <option value="<?=$item['team_key']?>"><?=$item['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-danger btn-block" id="btn-reg-team-delete">删除</button>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="col-sm-3">
        <button class="btn btn-info btn-block" id="return-to-ind">返回修改人员信息</button>
    </div>
    <div class="col-sm-3">
        <button class="btn btn-primary btn-block" id="btn-reg-team-add">添加一个团队</button>
    </div>
    <div class="col-sm-3">
        <button class="btn btn-warning btn-block" id="save-currently">暂时保存</button>
    </div>
    <div class="col-sm-3">
        <button class="btn btn-success btn-block" id="btn-reg-team-submit">提交</button>
    </div>
</div>
<script>
    var controller = "<?=site_url('registration/team')?>";
    var directto = "<?=site_url('user/result')?>";
    var data = [];
    if ($.cookie('team')) {
        data = $.parseJSON($.cookie('team'));
    } else if (<?=count($team)?>){
        data = <?=json_encode($team)?>;
        $.cookie('team', JSON.stringify(data));
    }
    $(document).ready(function() {
        reloadTeam();
    });
    $("#btn-reg-team-submit").click(function() {
        this.disabled=true;
        $(this).text("提交中...");
        postTeam();
        this.disabled=false;
        $(this).text("提交");
    });
    $("#btn-reg-team-add").click(function() {
        addTeam();
    });
    $("#btn-reg-team-delete").click(function() {
        if (confirm("确认删除？") == true) {
            removeTeam($(this));
        }
    });
/*    $(window).on('beforeunload', function() {
        cacheTeam();
    });*/

    $("#save-currently").click(function() {
        cacheTeam();
        alert("您已保存成功！可以返回个人信息页面继续修改，或点击“提交”完成报名。");
    });

    $("#return-to-ind").click(function() {
        cacheTeam();
        window.location.href = "<?=site_url('registration/individual')?>";
    });
</script>
