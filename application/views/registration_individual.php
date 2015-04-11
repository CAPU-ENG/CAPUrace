<div class="indcontainer">
    <p><h3>请录入人员信息（每输入一个人员信息之后点击保存进入下一个）</h3></p>
    <hr/>
    <div class="form-group reg">
        <input name="order" class="hidden">
        <div class="row">
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
        </div>
        <div class="row">
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
        </div>
        <div class="show-if-attend">
            <div class="row">
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
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <button class="btn btn-warning btn-block" id="btn-reg-ind-cache">保存</button>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</div>
<!-- The code above creates the individual form -->

<div class="indcontainer">
    <p><h3>已保存人员列表</h3></p>
    <hr/>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>手机号</th>
            <th>身份证号</th>
            <th>北大赛</th>
            <th>公路日</th>
            <th>山地日</th>
            <th>住宿</th>
            <th>5.16晚餐</th>
            <th>5.17午餐</th>
            <th>清真</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="ind-list">
        <tr class="hidden ind-item">
            <td class="order"></td>
            <td class="name"></td>
            <td class="gender"></td>
            <td class="tel"></td>
            <td class="id_card"></td>
            <td class="race"></td>
            <td class="shimano16"></td>
            <td class="shimano17"></td>
            <td class="accommodation"></td>
            <td class="meal16"></td>
            <td class="meal17"></td>
            <td class="islam"></td>
            <td>
                <div class="btn-group-xs btn-group">
                    <button class="btn btn-primary btn-reg-ind-update">修改</button>
                    <button class="btn btn-danger btn-reg-ind-delete">删除</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <hr/>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <button class="btn btn-primary btn-block" id="return-to-index">返回</button>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <button class="btn btn-success btn-block" id="btn-reg-ind-submit">提交，前往团体赛报名</button>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
<script>
    $("#btn-reg-ind-submit").click(function() {
        window.location.href = "<?=site_url('registration/team')?>";
    });
    $("#return-to-index").click(function() {
        window.location.href = "<?=site_url('registration')?>";
    });
    $("#btn-reg-ind-cache").click(function() {
        cacheIndividual($(".reg").find("[name='order']").val());
    });
    $(".btn-reg-ind-update").click(function() {
        editIndividual($(this));
    });
    $(".btn-reg-ind-delete").click(function() {
        removeIndividual($(this));
    });
    var controller = "<?=site_url('registration/individual')?>";
    var directto = "<?=site_url('registration/team')?>";
    var ACCOMMODATION = <?=json_encode($GLOBALS['ACCOMMODATION'])?>;
    var CAPURACE = <?=json_encode($GLOBALS['CAPURACE'])?>;
    var SHIMANO_RDB = <?=json_encode($GLOBALS['SHIMANO_RDB'])?>;
    var SHIMANO_MTB = <?=json_encode($GLOBALS['SHIMANO_MTB'])?>;
    var GENDER = <?=json_encode($GLOBALS['GENDER'])?>;
    var JUDGE = <?=json_encode($GLOBALS['JUDGE'])?>;
    var TF = <?=json_encode($GLOBALS['TF'])?>;
    var IFRACE = <?=json_encode($GLOBALS['IFRACE'])?>;
    var data = [];
    if ($.cookie('individual')) {
        data = $.parseJSON($.cookie('individual'));
    } else if (<?=count($individual)?>){
        data = <?=json_encode($individual)?>;
    }
    $(document).ready(function() {
        reloadIndividual();
        refreshOrder();
    });
</script>
