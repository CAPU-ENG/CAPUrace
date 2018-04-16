<div class="indcontainer">
    <h3>报名结果</h3>

    <?php if (!$editable): ?>
    <h4 style="text-align: center; color: #ff0000">报名结果已经确认，无法修改，请尽快支付。如有疑问请联系北大车协外联人员！</h4>
    <?php endif; ?>
    <hr/>

    <table class="table">
        <thead>
        <tr>
            <th>学校名称</th>
            <th>车协名称</th>
            <th>领队姓名</th>
            <th>电子邮箱</th>
            <th>手机号</th>
            <th>邮寄地址</th>
            <th>邮政编码</th>
            <th>费用合计</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?=$userinfo['school']?></td>
            <td><?=$userinfo['association_name']?></td>
            <td><?=$userinfo['leader']?></td>
            <td><?=$userinfo['mail']?></td>
            <td><?=$userinfo['tel']?></td>
            <td><?=$userinfo['address']?></td>
            <td><?=$userinfo['zipcode']?></td>
            <td><?=$userinfo['bill']?></td>
        </tr>
        </tbody>
    </table>

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
            <th>费用</th>
        </tr>
        </thead>
        <tbody class="ind-list">
        <?php $i = 1; ?>
        <?php foreach ($individual as $item): ?>
        <tr class="ind-item">
            <td class="order"><?=$i?></td>
            <td class="name"><?=$item['name']?></td>
            <td class="gender"><?=$GLOBALS['GENDER'][$item['gender']]?></td>
            <td class="tel"><?=$item['tel']?></td>
            <td class="id_type"><?=$GLOBALS['ID_TYPE'][$item['id_type']]?></td>
            <td class="id_number"><?=$item['id_number']?></td>
            <td class="race">
                <?php
                if($item['race']) {
                    echo  '山地男子大众组';
                }
                if($item['race_elite']) {
                    echo  '山地男子精英组';
                }
                if($item['race_f']) {
                    echo  '山地女子组';
                }
                if ($item['ifteam']) {
                    echo ' 团体赛 ';
                }
                if ($item['rdb']) {
                    echo ' 公路男子大众组 ';
                }
                if ($item['rdb_elite']) {
                    echo ' 公路男子精英组 ';
                }
                if ($item['rdb_f']) {
                    echo ' 公路女子组 ';
                }
                if (!$item['race'] && !$item['race_elite'] && !$item['race_f'] && !$item['rdb'] && !$item['rdb_elite'] && !$item['rdb_f'] && !$item['ifteam']) {
                    echo ' 不参加 ';
                }
                ?>
            </td>
            <td class="dinner"><?=$GLOBALS['JUDGE'][$item['dinner']]?></td>
            <td class="lunch"><?=$GLOBALS['JUDGE'][$item['lunch']]?></td>
            <td class="islam"><?=$GLOBALS['JUDGE'][$item['islam']]?></td>
            <td class="fee"><?=$item['fee']?></td>
        </tr>
        <?php
            $i++;
            endforeach;
        ?>
        </tbody>
    </table>
    <hr/>


    <table class="table table-hover">
        <thead>
        <tr>
            <th>序号</th>
            <th>第一棒</th>
            <th>第二棒</th>
            <th>第三棒</th>
            <th>第四棒</th>
        </tr>
        </thead>
        <tbody class="team-list">
        <?php $i = 1; ?>
        <?php foreach ($team as $item): ?>
            <tr class="team-item">
                <td><?=$i?></td>
                <td><?=$item['first']?></td>
                <td><?=$item['second']?></td>
                <td><?=$item['third']?></td>
                <td><?=$item['fourth']?></td>
            </tr>
        <?php
            $i++;
            endforeach;
        ?>
        </tbody>
    </table>
    <hr/>

    <?php if ($userinfo['campusrace']): ?>
    <div class="content">
     <h4 style="text-align: center; color: #ff0000">您具备校内参赛资格，如需参加或了解更多信息，请联系北大车协外联人员!</h4>
    </div>
    <hr/>
    <?php endif; ?>

    <div style="margin:0 auto;">
        <div class="col-sm-3"></div>
        <div class="col-sm-2">
            <?php if ($editable): ?>
            <button id="btn-go-to-pay" class="btn btn-block btn-success">前往支付</button>
            <?php else: ?>
            <button id="btn-check-payment" class="btn btn-block btn-success">查看支付信息</button>
            <?php endif; ?>
        </div>
        <div class="col-sm-2">
            <?php if ($editable): ?>
            <button id="btn-return-to-signup" class="btn btn-block btn-warning">修改报名信息</button>
            <?php else: ?>
            <button id="btn-export-excel" class="btn btn-block btn-warning">导出Excel表格</button>
            <?php endif; ?>
        </div>
        <div class="col-sm-2">
            <button id="btn-return-to-index" class="btn btn-block btn-primary">返回主页</button>
        </div>
        <div class="col-sm-3"></div>
    </div>

</div>
<script>
    var directtoregistration = "<?=site_url('registration/individual')?>";
    var directtofreeze = "<?=site_url('user/freeze')?>";
    var controller = "<?=site_url('user/result')?>";
    $("#btn-return-to-index").click(function() {
        window.location.assign("<?=site_url('index')?>");
    });
    $("#btn-return-to-signup").click(function() {
        window.location.assign("<?=site_url('registration')?>");
    });
    $("#btn-go-to-pay").click(function() {
        var msg = "前往支付之后将无法再次修改，确定继续？";
        if (confirm(msg) == true) {
            this.disabled=true;
            $(this).text("正在验证剩余名额...");
            postForQuotaVerification();
            this.disabled=false;
            $(this).text("前往支付");
        }
    });
    $("#btn-check-payment").click(function() {
        window.location.assign("<?=site_url('user/payment')?>");
    })
    $("#btn-export-excel").click(function() {
        window.open("<?=site_url('user/export')?>");
    })
</script>
