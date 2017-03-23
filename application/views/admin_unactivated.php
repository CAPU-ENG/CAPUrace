<div class="indcontainer">
    <h3>未激活高校列表</h3>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>学校名称</th>
            <th>所在地区</th>
            <th>领队姓名</th>
            <th>电子邮箱</th>
            <th>手机号</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($unactivated as $user): ?>
            <tr class="school">
                <td class="school_id"><?=$user['id']?></td>
                <td class="school_name"><?=$user['school']?></td>
                <td><?=$GLOBALS['PROVINCES_SHORT'][$user['province']]?></td>
                <td><?=$user['leader']?></td>
                <td><?=$user['mail']?></td>
                <td><?=$user['tel']?></td>
                <td>
                  <button class="btn-xs btn-danger btn-delete">删除用户</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
  $(".btn-delete").click(function () {
      var id = $(this).closest(".school").find(".school_id").text();
      var school = $(this).closest(".school").find(".school_name").text();
      var data = {
          id: parseInt(id)
      };
      if (confirm('确认删除' + school + '的注册信息？此操作将不可恢复！')) {
          $.post("<?=site_url('admin/unactivated')?>", data, function (response) { });
          window.location.reload();
      }
  })
</script>
