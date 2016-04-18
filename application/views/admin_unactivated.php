<div class="indcontainer">
    <h3>未激活高校列表</h3>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>学校名称</th>
            <th>车协名称</th>
            <th>所在地区</th>
            <th>领队姓名</th>
            <th>电子邮箱</th>
            <th>手机号</th>
            <th>邮寄地址</th>
            <th>邮政编码</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($unactivated as $user): ?>
            <tr class="school">
                <td class="school_id"><?=$user['id']?></td>
                <td class="school_name"><?=$user['school']?></td>
                <td><?=$user['association_name']?></td>
                <td><?=$GLOBALS['PROVINCES_SHORT'][$user['province']]?></td>
                <td><?=$user['leader']?></td>
                <td><?=$user['mail']?></td>
                <td><?=$user['tel']?></td>
                <td><?=$user['address']?></td>
                <td><?=$user['zipcode']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
