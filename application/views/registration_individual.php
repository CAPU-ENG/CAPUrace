<div class="regcontainer">
    <p> <h3>请录入人员信息</h3></p>
    <hr/>
    <div class="form-group reg">
        <label class="col-sm-1 control-label">序号</label>
        <label class="col-sm-2 control-label">姓名</label>
        <label class="col-sm-1 control-label">性别</label>
        <label class="col-sm-3 control-label">身份证号</label>
        <label class="col-sm-2 control-label">个人赛类型</label>
        <label class="col-sm-1 control-label">住宿</label>
        <label class="col-sm-1 control-label">就餐</label>
        <br /><hr />
        <div class="individual-form hidden">
            <div class="col-sm-1">
                <p class="order"></p>
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="name">
            </div>
            <div class="col-sm-1">
                <select class="form-control" name="gender">
                    <option value="1">男</option>
                    <option value="2">女</option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="id_card">
            </div>
            <div class="col-sm-2">
                <select class="form-control" name="race">
                    <option value="0">不参加个人赛</option>
                    <option value="1">男子大众组</option>
                    <option value="2">男子精英组</option>
                    <option value="3">女子组</option>
                </select>
            </div>
            <div class="col-sm-1">
                <input type="checkbox" name="accommodation" checked>
            </div>
            <div class="col-sm-1">
                <input type="checkbox" name="meal" checked>
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeIndividual($(this))">删除</button>
            </div>
            <br/>
            <br/>
        </div>
    </div>
    <hr/>
    <div class="col-sm-4">
        <button class="btn btn-primary btn-block" onclick="addIndividual()">添加一个队员</button>
    </div>
    <div class="col-sm-4">
        <button class="btn btn-warning btn-block" onclick="cacheIndividual()">暂时保存</button>
    </div>
    <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-block">提交，前往团体赛报名</button>
    </div>
    <br/>
</div>
<script>
    $(document).ready(function() {
        addIndividual();
    });
</script>
