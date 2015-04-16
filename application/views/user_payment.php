<div class="signcontainer">
    <h2 style="text-align: center"><?=$association_name?></h2>
    <p style="text-align: center">你们需要支付的金额为：</p>
    <h1 style="text-align: center; color: #ff0000"><?=$bill?>元</h1>
    <hr/>

    <p>请将参赛费用在5月1日之前围巾至以下帐户：</p>
    <p>帐号：6226 2201 1586 4885</p>
    <p>开户行：中国民生银行</p>
    <p>姓名：申劭婧</p>
    <p>手机号：18811728323</p>

    <hr/>
    <button id="return-to-index" class="btn-success btn btn-block">返回主页</button>
</div>
<script>
    $("#return-to-index").click(function() {
        window.location.assign("<?=site_url('index')?>");
    });
</script>