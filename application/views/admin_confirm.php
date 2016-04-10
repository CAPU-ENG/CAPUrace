<div class="indcontainer">
    <h3>待审核高校列表</h3>
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
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($unconfirmed as $user): ?>
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
        <td>
            <button class="btn-xs btn-success btn-confirm">通过审核</button>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
</div>
<script>
    $(".btn-confirm").click(function() {
        var id = $(this).closest(".school").find(".school_id").text();
        var school = $(this).closest(".school").find(".school_name").text();
        var data = {
            id: parseInt(id)
        };
        if (confirm('确认' + school + '通过审核?')) {
            $.post("<?=site_url('admin/confirm')?>", data, function (response) {});
            window.location.reload();
        }
    });
</script>