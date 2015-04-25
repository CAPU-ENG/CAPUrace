<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript">
var zhengZaiShuaXin = false;
var shuaXinJianGe = 60000;
var cuoWuShiDeShuaXinJianGe = 2000;
var shuaXinTimeout = null;
var dangQianGuoLüQi = function () {return true;};

function sheZhiShuaXin(jianGe) {
    if (shuaXinTimeout == null) {
        clearTimeout(shuaXinTimeout);
    }
    shuaXinTimeout = setTimeout(shuaXin, jianGe);
}

function shuaXin() {
    var xhr = new XMLHttpRequest();
    if (zhengZaiShuaXin) {
        return;
    }
    zhengZaiShuaXin = true;
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (genJüFanHuiSheZhiYeMianNeiRong(JSON.parse(xhr.responseText))) {
                sheZhiShuaXin(shuaXinJianGe);
            }
            else {
                sheZhiShuaXin(cuoWuShiDeShuaXinJianGe);
            }
            zhengZaiShuaXin = false;
            shuaXinTimeout = null;
        }
    }
    xhr.open('GET', '/index.php/admin/suoYouShuJu/', true);
    xhr.send(null);
}

function genJüFanHuiSheZhiYeMianNeiRong(fanHui) {
    if (fanHui.stat == 'chengGongLe') {
        tianChongShuJü(fanHui.shuJü);
        document.getElementById('dengLuRongQi').style.display = 'none';
        return true;
    }
    else if(fanHui.stat == 'shiBaiLe') {
        if (fanHui.shiBaiYuanYin == 'meiDengLu') {
            rangTaDengLu();
            return true;
        }
        else {
            chuCuoLe('刷新失败');
            return false;
        }
    }
}

var cuoWuLan = null;
function chuCuoLe(cuoWuXiaoXi) {
    if (cuoWuLan == null) {
        cuoWuLan = document.getElementById('cuoWuLan');
    }
    cuoWuLan.innerHTML = cuoWuXiaoXi;
    cuoWuLan.style.display = 'absolute';
    setTimeout(function () {cuoWuLan.style.display = 'none';}, 5000);
}

function rangTaDengLu() {
    document.getElementById('jiLuRongQi').style.display = 'none';
    document.getElementById('dengLuRongQi').style.display = 'block';
    document.getElementById('dengLuCuoWu').innerHTML = '';
    document.forms.namedItem('dengLuBiaoDan').elements.namedItem('kouLing').value = '';
}

function dengLu() {
    var fd = new FormData(document.forms.namedItem('dengLuBiaoDan'));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var f = JSON.parse(xhr.responseText);
            if (f.stat == 'chengGongLe') {
                document.getElementById('dengLuRongQi').style.display = 'none';
                sheZhiShuaXin(0);
            }
            else {
                document.getElementById('dengLuCuoWu').innerHTML = f.msg;
            }
        }
    }
    xhr.open('POST', '/index.php/admin/dengLu/', true);
    xhr.send(fd);
}

var shuJüBiao = null;
var beiYongJieDian = [];
function tianChongShuJü(shuJü) {
    document.getElementById('jiLuRongQi').style.display = 'block';
    document.getElementById('dengLuRongQi').style.display = 'null';
    if (shuJüBiao == null) {
        shuJüBiao = document.getElementById('jiLuMen');
    }
    jiLuZhiZhen = shuJüBiao.firstElementChild;
    for (var k in shuJü) {
        id = shuJü[k].id;
        while (jiLuZhiZhen.nodeName != 'THEAD' && id >= jiLuZhiZhen.id) {
            gangCaiNaGe = jiLuZhiZhen;
            jiLuZhiZhen = jiLuZhiZhen.nextElementSibling;
            beiYongJieDian.push(shuJüBiao.removeChild(gangCaiNaGe));
        }
        shuJüBiao.insertBefore(genJüShuJüChuangJianYiGeBiaoGeHang(shuJü[k], beiYongJieDian), jiLuZhiZhen);
    }
}

function genJuDangQianGuoLüQiGuoLüBiaoGe() {
    if (shuJüBiao == null) {
        shuJüBiao = document.getElementById('jiLuMen');
    }
    jiLuZhiZhen = shuJüBiao.firstElementChild;
    while (jiLuZhiZhen.nodeName != 'THEAD') {
        if (!dangQianGuoLüQi(jiLuZhiZhen)) {
            jiLuZhiZhen.style.display = 'none';
        }
        else {
            jiLuZhiZhen.style.display = 'table-row';
        }
        jiLuZhiZhen = jiLuZhiZhen.nextElementSibling;
    }
}

function genJüShuJüChuangJianYiGeBiaoGeHang(shuJüHang, beiYong) {
    if (beiYong.length == 0) {
        xinHang = chuangJianXinHang();
    }
    else {
        xinHang = beiYong.pop();
    }
    wangHangLiTianShuJü(xinHang, shuJüHang);
    xinHang.id = shuJüHang.id;
    if (!dangQianGuoLüQi(xinHang)) {
        xinHang.style.display = 'none';
    }
    else {
        xinHang.style.display = 'table-row';
    }
    return xinHang;
}

function chuangJianXinHang() {
    xinHang = document.createElement('TR');
    xinHang.innerHTML = '<td class="xueXiao"></td><td class="lingDui"></td><td class="dianHua"></td><td class="huiMing"></td><td class="youXiang"></td><td class="diZhi"></td><td class="youBian"></td><td class="jiHuo"></td><td class="shenHe"></td><td class="queRen"></td><td class="jiaoQian"></td><td class="shanChu"></td>';
    return xinHang;
}

function wangHangLiTianShuJü(xinHang, shuJüHang) {
    ge = xinHang.firstChild;
    while (ge) {
        if (ge.className == 'shenHe') {
            if (!shuJüHang.shenHe) {
                ge.innerHTML = '<a href="javascript:void(0);">设成已审核</a>';
                ge.firstElementChild.onclick = (function (ge) {
                    return function () {setConfirmed(ge);}
                }(ge));
            }
            else {
                ge.innerHTML = '已审核';
            }
        }
        else if (ge.className == 'jiaoQian') {
            if (!shuJüHang.jiaoQian) {
                ge.innerHTML = '<a href="javascript:void(0);">设成已交钱</a>';
                ge.firstElementChild.onclick = (function (ge) {
                    return function () {setPaid(ge);}
                }(ge));
            }
            else {
                ge.innerHTML = '已交钱';
            }
        }
        else if (ge.className == 'jiHuo') {
            if (!shuJüHang.jiHuo) {
                ge.innerHTML = '还没有激活';
            }
            else {
                ge.innerHTML = '已激活';
            }
        }
        else if (ge.className == 'queRen') {
            if (!shuJüHang.queRen) {
                ge.innerHTML = '还没有确认';
            }
            else {
                ge.innerHTML = '已确认';
            }
        }
        else if (ge.className == 'shanChu') {
            ge.innerHTML = '<a href="javascript:void(0);">删除</a>';
            ge.onclick = (function (n, ge) {
                return function () {
                    if ((n & 7) == 7) {
                        shanChu(ge);
                    }
                    else if ((n & 7) == 0) {
                        ge.firstElementChild.innerHTML = '真的要' + ge.firstElementChild.innerHTML + '吗？';
                    }
                    else {
                        ge.firstElementChild.innerHTML = '真的' + ge.firstElementChild.innerHTML;
                    }
                    n += 1;
                };
            })(0, ge);
        }
        else {
            ge.innerHTML = shuJüHang[ge.className];
        }
        ge = ge.nextElementSibling;
    }
}

function shanChu(ge) {
    id = ge.parentNode.id;
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // zhong jian ke neng shua xin guo
                if (id == ge.parentNode.id) {
                    hang = ge.parentNode.parentNode.removeChild(ge.parentNode);
                    beiYongJieDian.push(hang);
                }
            }
            else {
                ge.firstElementChild.innerHTML = '删除';
                chuCuoLe('删除失败。。。');
            }
        }
    }
    xhr.open('POST', '/index.php/admin/shanChu/', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('id=' + id);
}

function setConfirmed(ge) {
    setXxxed(ge, 'confirmed', '已审核');
}

function setPaid(ge) {
    setXxxed(ge, 'paid', '已交钱');
}

function setXxxed(ge, what, show) {
    id = ge.parentNode.id;
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // zhong jian ke neng shua xin guo
                if (id == ge.parentNode.id) {
                    ge.innerHTML = show;
                }
            }
            else {
                chuCuoLe('更新失败。。。');
            }
        }
    }
    xhr.open('POST', '/index.php/admin/setXxxed/', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('what=' + what + '&id=' + id);
}

function kaiShi() {
    document.getElementById('wuGuoLüQi').onclick = function () {
        dangQianGuoLüQi = function () {return true;};
        genJuDangQianGuoLüQiGuoLüBiaoGe();
    }
    document.getElementById('weiJiHuo').onclick = function () {
        dangQianGuoLüQi = function (hang) {
            return hang.getElementsByClassName('jiHuo')[0].innerHTML != '已激活';
        };
        genJuDangQianGuoLüQiGuoLüBiaoGe();
    }
    document.getElementById('weiShenHe').onclick = function () {
        dangQianGuoLüQi = function (hang) {
            return hang.getElementsByClassName('shenHe')[0].innerHTML != '已审核';
        };
        genJuDangQianGuoLüQiGuoLüBiaoGe();
    }
    document.getElementById('weiQueRen').onclick = function () {
        dangQianGuoLüQi = function (hang) {
            return hang.getElementsByClassName('queRen')[0].innerHTML != '已确认';
        };
        genJuDangQianGuoLüQiGuoLüBiaoGe();
    }
    document.getElementById('weiJiaoQian').onclick = function () {
        dangQianGuoLüQi = function (hang) {
            return hang.getElementsByClassName('jiaoQian')[0].innerHTML != '已交钱';
        };
        genJuDangQianGuoLüQiGuoLüBiaoGe();
    }
    sheZhiShuaXin(0);
}

window.onload = kaiShi;
</script>
</head>
<body>
<div id="jinDuTiao">
</div>
<div id="cuoWuLan">
</div>
<div id="dengLuRongQi">
<form methad="post" name="dengLuBiaoDan">
<p id="dengLuCuoWu"></p>
<label>口令</label>
<input type="text" name="kouLing">
<input type="button" value="登陆" onclick="javascript:dengLu();">
</form>
</div>
<div id="jiLuRongQi">
<ul id="guoLüQi">
<li><a id="wuGuoLüQi" href="javascript:void(0);">显示全部</a></li>
<li><a id="weiJiHuo" href="javascript:void(0);">未激活</a></li>
<li><a id="weiShenHe" href="javascript:void(0);">未审核</a></li>
<li><a id="weiQueRen" href="javascript:void(0);">未确认</a></li>
<li><a id="weiJiaoQian" href="javascript:void(0);">未交钱</a></li>
</ul>
<table id="jiLuMen">
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
