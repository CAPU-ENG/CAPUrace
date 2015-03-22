<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/style.css" rel="stylesheet">
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/race.js"></script>
</head>
<body>
    <div class="mycontainer">
        <p> <h3>请录入人员信息</h3></p>
        <hr/>
        <div class="reg">
            <div class="individual-form" id="individual-info">
                <label for="inputName" class="col-sm-1 control-label">姓名</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="inputName">
                </div>
                <label for="inputSex" class="col-sm-1 control-label">性别</label>
                <div class="col-sm-2">
                    <select class="form-control" name="gender">
                        <option value="1">男</option>
                        <option value="2">女</option>
                    </select>
                </div>
                <label for="inputID" class="col-sm-1 control-label">身份证号</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputID">
                </div>
                <br><br><br>
                <label for="inputRace" class="col-sm-1 control-label">个人赛类型</label>
                <div class="col-sm-2">
                    <select class="form-control" name="race">
                        <option value="0">不参加个人赛</option>
                        <option value="1">男子大众组</option>
                        <option value="2">男子精英组</option>
                        <option value="3">女子组</option>
                    </select>
                </div>
                <label for="inputAccommodation" class="col-sm-1 control-label">住宿</label>
                <div class="col-sm-2">
                    <select class="form-control" name="accommodation">
                        <option value="1">需要</option>
                        <option value="0">不需要</option>
                    </select>
                </div>
                <label for="inputMeal" class="col-sm-1 control-label">吃饭</label>
                <div class="col-sm-2">
                    <select class="form-control" name="meal">
                        <option value="1">需要</option>
                        <option value="0">不需要</option>
                    </select>
                </div>
                <button type="button" class="btn btn-default btn-sm">删除</button>
                <br><hr>
            </div>
        </div>
        <div class="col-sm-6">
            <button class="btn btn-primary" onclick="addIndividual()">添加</button>
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </div>
</body>
</html>
