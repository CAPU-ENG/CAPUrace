<div class="indcontainer">
    <h3>请确认报名信息</h3>
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
            <td class="id_card"><?=$item['id_card']?></td>
            <td class="race"><?=$GLOBALS['RACE_ALL'][$item['race']]?>
                <?php
                if ((($item['race'] == '1') || ($item['race'] == '2')) && ($item['ifteam'] == 1)) {
                    echo ' 团体赛 ';
                }
                ?>
            </td>
            <td class="shimano16"><?=$GLOBALS['SHIMANO_RDB'][$item['shimano16']]?></td>
            <td class="shimano17"><?=$GLOBALS['SHIMANO_MTB'][$item['shimano17']]?></td>
            <td class="accommodation"><?=$GLOBALS['ACCOMMODATION'][$item['accommodation']]?></td>
            <td class="meal16"><?=$GLOBALS['JUDGE'][$item['meal16']]?></td>
            <td class="meal17"><?=$GLOBALS['JUDGE'][$item['meal17']]?></td>
            <td class="islam"><?=$GLOBALS['JUDGE'][$item['islam']]?></td>
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
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
        <button id="btn-go-to-pay" class="btn btn-block btn-success disabled">前往支付（暂未开放）</button>
    </div>
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
        <button id="btn-return-to-index" class="btn btn-block btn-primary">返回主页</button>
    </div>
    <div class="col-sm-2"></div>

</div>
<script>
    $("#btn-return-to-index").click(function() {
        window.location.assign("<?=site_url('index')?>");
    })
</script>
