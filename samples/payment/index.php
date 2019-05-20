<?php 
# 支付总目录
require_once '../source/init_base.php';
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>集成支付样例</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT_HOST.SOUR_COM ?>css/common.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT_HOST.SOUR_COM ?>css/block2.css">
</head>
<body>
    <h1>微信支付</h1>
    <div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a href="http://paysdk.weixin.qq.com/example/jsapi.php">JSAPI支付</a></li>
            <li style="background-color:#698B22"><a href="http://paysdk.weixin.qq.com/example/micropay.php">刷卡支付</a></li>
            <li style="background-color:#8B6914"><a href="http://paysdk.weixin.qq.com/example/native.php">扫码支付</a></li>
            <li style="background-color:#CDCD00"><a href="http://paysdk.weixin.qq.com/example/orderquery.php">订单查询</a></li>
            <li style="background-color:#CD3278"><a href="http://paysdk.weixin.qq.com/example/refund.php">订单退款</a></li>
            <li style="background-color:#848484"><a href="http://paysdk.weixin.qq.com/example/refundquery.php">退款查询</a></li>
            <li style="background-color:#8EE5EE"><a href="http://paysdk.weixin.qq.com/example/download.php">下载订单</a></li>
        </ul>
    </div>

    <div class="clear"></div>

    <h1>支付宝支付</h1>
    <div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a href="alipayjs/index.php">支付宝即时到账</a></li>
            <li style="background-color:#698B22"><a href="alipaydual/index.php">支付宝双接口</a></li>
            <li style="background-color:#8B6914"><a href="#">扫码支付</a></li>
            <li style="background-color:#CDCD00"><a href="alipaywap/index.php">手机站支付2.0</a></li>
        </ul>
    </div>

    <div class="clear"></div>

    <h1>网银在线</h1>
    <div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a href="chinabank/boc/index.php">中国银行</a></li>
            <li style="background-color:#698B22"><a href="chinabank/ccb/index.php">建行</a></li>
            <li style="background-color:#8B6914"><a href="chinabank/icbc/index.php">工行</a></li>
            <li style="background-color:#CDCD00"><a href="chinabank/abchina/index.php">农行</a></li>
            <li style="background-color:#848484"><a href="chinabank/unionpay/index.php">中国银联</a></li>
            <li style="background-color:#8EE5EE"><a href="chinabank/motopay/index.php">网银在线</a></li>
        </ul>
    </div>
</body>
</html>