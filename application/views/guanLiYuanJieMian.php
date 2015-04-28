<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript">
var 正在刷新 = false;
var 刷新间隔 = 60000;
var 错误时的刷新间隔 = 2000;
var 刷新Timeout = null;
var 当前过滤器 = function () {return true;};

function 设置刷新(间隔) {
    if (刷新Timeout == null) {
        clearTimeout(刷新Timeout);
    }
    刷新Timeout = setTimeout(刷新, 间隔);
}

function 刷新() {
    var xhr = new XMLHttpRequest();
    if (正在刷新) {
        return;
    }
    正在刷新 = true;
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (根据返回设置页面内容(JSON.parse(xhr.responseText))) {
                设置刷新(刷新间隔);
            }
            else {
                设置刷新(错误时的刷新间隔);
            }
            正在刷新 = false;
            刷新Timeout = null;
        }
    }
    xhr.open('GET', '/index.php/admin/suoYouShuJu/', true);
    xhr.send(null);
}

function 根据返回设置页面内容(返回) {
    if (返回.状态 == '成功了') {
        填充数据(返回.数据);
        document.getElementById('登陆容器').style.display = 'none';
        return true;
    }
    else if(返回.状态 == '失败了') {
        if (返回.消息 == '没登陆') {
            让它登陆();
            return true;
        }
        else {
            出错了('刷新失败');
            return false;
        }
    }
}

var 错误栏 = null;
function 出错了(错误消息) {
    if (错误栏 == null) {
        错误栏 = document.getElementById('错误栏');
    }
    错误栏.innerHTML = 错误消息;
    错误栏.style.display = 'absolute';
    setTimeout(function () {错误栏.style.display = 'none';}, 5000);
}

function 让它登陆() {
    document.getElementById('记录容器').style.display = 'none';
    document.getElementById('登陆容器').style.display = 'block';
    document.getElementById('登陆错误').innerHTML = '';
    document.forms.namedItem('登陆表单').elements.namedItem('kouLing').value = '';
}

function 登陆() {
    var fd = new FormData(document.forms.namedItem('登陆表单'));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var f = JSON.parse(xhr.responseText);
            if (f.状态 == '成功了') {
                document.getElementById('登陆容器').style.display = 'none';
                设置刷新(0);
            }
            else {
                document.getElementById('登陆错误').innerHTML = f.消息;
            }
        }
    }
    xhr.open('POST', '/index.php/admin/dengLu/', true);
    xhr.send(fd);
}

var 数据表 = null;
var 备用节点 = [];
function 填充数据(数据) {
    document.getElementById('记录容器').style.display = 'block';
    document.getElementById('登陆容器').style.display = 'null';
    if (数据表 == null) {
        数据表 = document.getElementById('记录们');
    }
    记录指针 = 数据表.firstElementChild;
    for (var k in 数据) {
        id = 数据[k].id;
        while (记录指针.nodeName != 'THEAD' && id >= 记录指针.id) {
            刚才那个 = 记录指针;
            记录指针 = 记录指针.nextElementSibling;
            备用节点.push(数据表.removeChild(刚才那个));
        }
        数据表.insertBefore(根据数据创建一个表格行(数据[k], 备用节点), 记录指针);
    }
}

function 根据当前过滤器过滤表格() {
    if (数据表 == null) {
        数据表 = document.getElementById('记录们');
    }
    记录指针 = 数据表.firstElementChild;
    while (记录指针.nodeName != 'THEAD') {
        if (!当前过滤器(记录指针)) {
            记录指针.style.display = 'none';
        }
        else {
            记录指针.style.display = 'table-row';
        }
        记录指针 = 记录指针.nextElementSibling;
    }
}

function 根据数据创建一个表格行(数据行, 备用) {
    if (备用.length == 0) {
        新行 = 创建新行();
    }
    else {
        新行 = 备用.pop();
    }
    往里填数据(新行, 数据行);
    新行.id = 数据行.id;
    if (!当前过滤器(新行)) {
        新行.style.display = 'none';
    }
    else {
        新行.style.display = 'table-row';
    }
    return 新行;
}

function 创建新行() {
    新行 = document.createElement('TR');
    新行.innerHTML = '<td class="学校"></td><td class="领队"></td><td class="电话"></td><td class="会名"></td><td class="邮箱"></td><td class="地址"></td><td class="邮编"></td><td class="激活"></td><td class="审核"></td><td class="确认"></td><td class="交钱"></td><td class="删除"></td>';
    return 新行;
}

function 往里填数据(新行, 数据行) {
    格 = 新行.firstChild;
    while (格) {
        if (格.className == '审核') {
            if (!数据行.审核) {
                格.innerHTML = '<a href="javascript:void(0);">设成已审核</a>';
                格.firstElementChild.onclick = (function (格) {
                    return function () {setConfirmed(格);}
                }(格));
            }
            else {
                格.innerHTML = '已审核';
            }
        }
        else if (格.className == '交钱') {
            if (!数据行.交钱) {
                格.innerHTML = '<a href="javascript:void(0);">设成已交钱</a>';
                格.firstElementChild.onclick = (function (格) {
                    return function () {setPaid(格);}
                }(格));
            }
            else {
                格.innerHTML = '已交钱';
            }
        }
        else if (格.className == '激活') {
            if (!数据行.激活) {
                格.innerHTML = '还没有激活';
            }
            else {
                格.innerHTML = '已激活';
            }
        }
        else if (格.className == '确认') {
            if (!数据行.确认) {
                格.innerHTML = '还没有确认';
            }
            else {
                格.innerHTML = '已确认';
            }
        }
        else if (格.className == '删除') {
            格.innerHTML = '<a href="javascript:void(0);">删除</a>';
            格.onclick = (function (n, 格) {
                return function () {
                    if ((n & 7) == 7) {
                        删除(格);
                    }
                    else if ((n & 7) == 0) {
                        格.firstElementChild.innerHTML = '真的要' + 格.firstElementChild.innerHTML + '吗？';
                    }
                    else {
                        格.firstElementChild.innerHTML = '真的' + 格.firstElementChild.innerHTML;
                    }
                    n += 1;
                };
            })(0, 格);
        }
        else {
            格.innerHTML = 数据行[格.className];
        }
        格 = 格.nextElementSibling;
    }
}

function 删除(格) {
    id = 格.parentNode.id;
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                //中间可能刷新过
                if (id == 格.parentNode.id) {
                    行 = 格.parentNode.parentNode.removeChild(格.parentNode);
                    备用节点.push(行);
                }
            }
            else {
                格.firstElementChild.innerHTML = '删除';
                出错了('删除失败。。。');
            }
        }
    }
    xhr.open('POST', '/index.php/admin/shanChu/', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id);
}

function setConfirmed(格) {
    setXxxed(格, 'confirmed', '已审核');
}

function setPaid(格) {
    setXxxed(格, 'paid', '已交钱');
}

function setXxxed(格, 啥, 完成后填的文字) {
    id = 格.parentNode.id;
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                //中间可能刷新过
                if (id == 格.parentNode.id) {
                    格.innerHTML = 完成后填的文字;
                }
            }
            else {
                出错了('更新失败。。。');
            }
        }
    }
    xhr.open('POST', '/index.php/admin/setXxxed/', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('what=' + 啥 + '&id=' + id);
}

function 开始() {
    document.getElementById('无过滤器').onclick = function () {
        当前过滤器 = function () {return true;};
        根据当前过滤器过滤表格();
    }
    document.getElementById('未激活').onclick = function () {
        当前过滤器 = function (行) {
            return 行.getElementsByClassName('激活')[0].innerHTML != '已激活';
        };
        根据当前过滤器过滤表格();
    }
    document.getElementById('未审核').onclick = function () {
        当前过滤器 = function (行) {
            return 行.getElementsByClassName('审核')[0].innerHTML != '已审核';
        };
        根据当前过滤器过滤表格();
    }
    document.getElementById('未确认').onclick = function () {
        当前过滤器 = function (行) {
            return 行.getElementsByClassName('确认')[0].innerHTML != '已确认';
        };
        根据当前过滤器过滤表格();
    }
    document.getElementById('未交钱').onclick = function () {
        当前过滤器 = function (行) {
            return 行.getElementsByClassName('交钱')[0].innerHTML != '已交钱';
        };
        根据当前过滤器过滤表格();
    }
    设置刷新(0);
}

window.onload = 开始;
</script>
</head>
<body>
<div id="进度条">
</div>
<div id="错误栏">
</div>
<div id="登陆容器">
<form methad="post" name="登陆表单">
<p id="登陆错误"></p>
<label>口令</label>
<input type="text" name="kouLing">
<input type="button" value="登陆" onclick="javascript:登陆();">
</form>
</div>
<div id="记录容器">
<ul id="过滤器">
<li><a id="无过滤器" href="javascript:void(0);">显示全部</a></li>
<li><a id="未激活" href="javascript:void(0);">未激活</a></li>
<li><a id="未审核" href="javascript:void(0);">未审核</a></li>
<li><a id="未确认" href="javascript:void(0);">未确认</a></li>
<li><a id="未交钱" href="javascript:void(0);">未交钱</a></li>
</ul>
<table id="记录们">
<thead>
<tr>
<th>学校</th>
<th>领队</th>
<th>电话</th>
<th>会名</th>
<th>邮箱</th>
<th>地址</th>
<th>邮编</th>
<th>激活</th>
<th>审核</th>
<th>确认</th>
<th>交钱</th>
<th>删除</th>
</tr>
</thead>
</table>
</div>
</body>
</html>
