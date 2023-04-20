<script type="text/javascript">
    var controller = "<?=site_url('user/edit')?>";
    var directto = "<?=base_url()?>";
    var editable = <?=$start_register?>;
    var province = <?=$province?>;
</script>
<div class="signcontainer">
    <h3><?php if (! $start_register): ?>修改<?php endif; ?>学校资料 </h3>
    <div>您的邮箱：<?=$mail?></div>
    <div style="color: red">
    <?php if (! $start_register): ?>开始报名后将不可修改学校资料。
    <?php else: ?>您已开始报名，不能修改资料！<?php endif; ?>
    </div>
    <hr/>
    <label class="col-sm-4">学校名称</label>
    <div class="col-sm-8">
        <input type="text" name="school" class="form-control" id="school" value="<?=$school?>">
    </div><br/><br/>
    <label class="col-sm-4">车协名称</label>
    <div class="col-sm-8">
        <input type="text" name="association_name" class="form-control" id="assoc" value="<?=$association_name?>">
    </div><br/><br/>
    <label class="col-sm-4">所在地区</label>
    <div class="col-sm-8">
        <?=form_dropdown('province', $GLOBALS['PROVINCES'], set_value('province',$province), 'class="form-control" id="province"')?>
    </div><br/><br/>
    <label class="col-sm-4">邮寄地址</label>
    <div class="col-sm-8">
        <input type="text" name="address" class="form-control" id="add" value="<?=$address?>">
    </div><br/><br/>
    <label class="col-sm-4">邮政编码</label>
    <div class="col-sm-8">
        <input type="text" name="zipcode" class="form-control" id="zip" value="<?=$zipcode?>">
    </div><br/><br/>
    <hr/>
    <label class="col-sm-4">领队姓名</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="leader" id="leader" value="<?=$leader?>">
    </div><br/><br/>
    <label class="col-sm-4">联系电话</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="tel" id="tel" value="<?=$tel?>">
    </div><br/><br/>
    <hr/>
    <div class="col-sm-6">
        <button class="btn btn-warning btn-block" id="btn-back">返回</button>
    </div>
    <div class="col-sm-6">
        <button class="btn btn-success btn-block" id="btn-signup">确认</button>
    </div>
</div>
<script>
    $("#btn-back").click(function() {
        window.location.href = "<?=base_url()?>";
    });
    $("#btn-signup").click(function() {
        this.disabled=true;
        $(this).text("修改中...");
        postEdit();
        this.disabled=false;
        $(this).text("确认");
    });
</script>
