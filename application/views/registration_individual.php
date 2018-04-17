<div class="indcontainer">
    <h3>请录入人员信息（每输入一个人员信息之后点击保存进入下一个）</h3>
    <hr/>

    <p style="color: red">名额剩余：
    <?php if ($race_m_status < 50): ?>
        山地男子大众组: <?=$race_m_status?>个，
    <?php else: ?>
        山地男子大众组: 充足，
    <?php endif; ?>

    <?php if ($race_elite_status < 50): ?>
        山地男子精英组: <?=$race_elite_status?>个，
    <?php else: ?>
        山地男子精英组: 充足，
    <?php endif; ?>

    <?php if ($race_f_status < 50): ?>
        山地女子组: <?=$race_f_status?>个，
    <?php else: ?>
        山地女子组：充足，
    <?php endif; ?>

    <?php if ($rdb_m_status < 50): ?>
        公路男子大众组: <?=$rdb_m_status?>个，
    <?php else: ?>
        公路男子大众组：充足，
    <?php endif; ?>

    <?php if ($rdb_elite_status < 50): ?>
        公路男子精英组: <?=$rdb_elite_status?>个，
    <?php else: ?>
        公路男子精英组：充足，
    <?php endif; ?>

    <?php if ($rdb_f_status < 50): ?>
        公路女子组: <?=$rdb_f_status?>个
    <?php else: ?>
        公路女子组：充足
     <?php endif; ?>
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
            <div class="col-sm-3">
                <input class="form-control" name="tel" type="text">
            </div>
            <label class="col-sm-1">清真</label>
            <div class="col-sm-1">
                <div class="col-sm-1">
                <input type="checkbox" name="islam">
            </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-1">证件类型</label>
            <div class="col-sm-2" style="float: left;">
                <select class="form-control" name="id_type">
                    <option value="identity">身份证</option>
                    <option value="passport">护照</option>
                </select>
            </div>
            <div class="col-sm-3">
                <input class="form-control" name="id_number" placeholder="证件编号" type="text">
            </div>
            <label class="col-sm-2">5.5午餐+晚餐</label>
            <div class="col-sm-1">
                <input type="checkbox" name="dinner">
            </div>
            <label class="col-sm-1">5.6午餐</label>
            <div class="col-sm-1">
                <input type="checkbox" name="lunch">
            </div>
        </div>
        <div class="show-if-attend">
            <div class="row">
                <label class="col-sm-1">参赛情况</label>
                <div class="col-sm-2">
                <select class="form-control" name="ifrace">
                    <option value="0">观赛</option>
                    <option value="1">参赛</option>
                </select>
                </div>
                <label class="col-sm-2">山地大众赛</label>
                <div class="col-sm-1">
                    <input type="checkbox" name="race">
                </div>
                <label class="col-sm-2">山地精英赛</label>
                <div class="col-sm-1">
                    <input type="checkbox" name="race_elite">
                </div>
                <label class="col-sm-1">团体赛</label>
                <div class="col-sm-1">
                    <input type="checkbox" name="ifteam">
                </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
              </div>
              <label class="col-sm-2">公路大众赛</label>
              <div class="col-sm-1">
                  <input type="checkbox" name="roadbike">
              </div>
              <label class="col-sm-2">公路精英赛</label>
              <div class="col-sm-1">
                  <input type="checkbox" name="roadbike_elite">
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
    <!-- The code above creates the individual form -->
    <h3>已保存人员列表（修改数据后请提交，否则无法保存！）</h3>
    <hr/>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>手机号</th>
            <th>证件类型</th>
            <th>证件编号</th>
            <th>参赛项目</th>
            <th>5.5午餐+晚餐</th>
            <th>5.6午餐</th>
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
            <td class="id_type"></td>
            <td class="id_number"></td>
            <td class="race"></td>
            <td class="dinner"></td>
            <td class="lunch"></td>
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
    var controller = "<?=site_url('registration/individual')?>";
    var directto = "<?=site_url('registration/team')?>";
    var GENDER = <?=json_encode($GLOBALS['GENDER'])?>;
    var ID_TYPE = <?=json_encode($GLOBALS['ID_TYPE'])?>;
    var JUDGE = <?=json_encode($GLOBALS['JUDGE'])?>;
    var TF = <?=json_encode($GLOBALS['TF'])?>;
    var IFRACE = <?=json_encode($GLOBALS['IFRACE'])?>;
    var data = [];
    // Load cached individual data.
    if (localStorage.getItem('individual')) {
        data = JSON.parse(localStorage.getItem('individual'));
    } else {
        data = <?=json_encode(load_db_individual())?>;
        localStorage.setItem('individual', JSON.stringify(data));
        $.each(data, function(order, item) {
            item.dinner = (item.dinner == 1);
            item.lunch = (item.lunch == 1);
            item.ifteam = (item.ifteam == 1);
            item.rdb = (item.rdb == 1);
        });

    }
    $("#btn-reg-ind-submit").click(function() {
        this.disabled=true;
        $(this).text("提交中...");
        postIndividual();
        this.disabled=false;
        $(this).text("提交，前往团体赛报名");
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
        if (confirm("确认删除？") == true) {
            removeIndividual($(this));
        }
    });
    $(document).ready(function() {
        reloadIndividual();
        refreshOrder();
        restrictIndividual();
        $("select[name='ifrace']").change(function() {
            restrictIndividual();
        });
        $("[name='gender']").change(function () {
            restrictIndividual();
        });
        $("[name='race']").change(function () {
            race_elite = $("[name='race_elite']");
            race_elite.prop('checked',false);
            restrictIndividual();
        });
        $("[name='race_elite']").change(function () {
            race = $("[name='race']");
            race.prop('checked',false);
            restrictIndividual();
        });
        $("[name='roadbike']").change(function () {
            rdb_elite = $("[name='roadbike_elite']");
            rdb_elite.prop('checked',false);
            restrictIndividual();
        });
        $("[name='roadbike_elite']").change(function () {
            rdb = $("[name='roadbike']");
            rdb.prop('checked',false);
            restrictIndividual();
        });
        $("[name='ifteam']").change(function () {
            restrictIndividual();
        });
    });
</script>
