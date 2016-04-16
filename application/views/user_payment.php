<div class="signcontainer">
    <h2 style="text-align: center"><?=$association_name?></h2>
    <p style="text-align: center">你们需要支付的金额为：</p>
    <h1 style="text-align: center; color: #ff0000"><?=$bill?>元</h1>
    <hr/>

    <p>请将参赛费用在5月2日之前转账至以下帐户：</p>
    <p>帐号：6228 4800 1864 1846 078</p>
    <p>开户行：中国农业银行 北大分理处</p>
    <p>姓名：苗卉</p>
    <p>手机号：15901102330</p>
    <p style="color: red">不接受其他任何缴费方式!</p>

    <hr/>
    <button id="return-to-index" class="btn-success btn btn-block">返回主页</button>
</div>
<script>
    $("#return-to-index").click(function() {
        window.location.assign("<?=site_url('index')?>");
    });
</script>