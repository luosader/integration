<?php
// header('Content-Type:text/html;charset=GBK');//设置文本类型和编码
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
// require_once 'log.php';

session_start();
$baseurl = 'http://'.$_SERVER['HTTP_HOST'].'/include/weixin/';

// $openId = $_SESSION['openid'];
$_GET['money'] = $_GET['money']?$_GET['money']:1;
$money = $_GET['money']*100;
// $telephone = $_SESSION['telephone'];
$out_trade_no = WxPayConfig::MCHID.date("YmdHis");
$_SESSION['wx_money'] = $_GET['money'];
$_SESSION['wx_out_trade_no'] = $out_trade_no;



//模式一
/**
 * 流程：
 * 1、组装包含支付信息的url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
 * 5、支付完成之后，微信服务器会通知支付成功
 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$notify = new NativePay();
// $url1 = $notify->GetPrePayUrl("123456789");

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
// $input = new WxPayUnifiedOrder();
// $input->SetBody("details");//商品描述    编码问题,不能为中文
// $input->SetAttach("add");// 附加数据 编码问题,不能为中文  非必填
// $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));//商户订单号   编码问题,只能是字母、数字
// $input->SetTotal_fee("2");//总金额 单位：分。不能为小数
// $input->SetTime_start(date("YmdHis"));//交易起始时间   非必填
// $input->SetTime_expire(date("YmdHis", time() + 600));//交易结束时间    非必填
// $input->SetGoods_tag("mark");//商品标记  编码问题,不能为中文
// $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");//通知地址
// $input->SetTrade_type("NATIVE");//交易类型   原生NATIVE
// $input->SetProduct_id("123456789");//商品ID    编码问题,不能为中文
// $result = $notify->GetPayUrl($input);//转
// $url2 = $result["code_url"];

$input = new WxPayUnifiedOrder();
$input->SetBody("shihuahuijs");
$input->SetAttach("native");
$input->SetOut_trade_no($out_trade_no);
$input->SetTotal_fee($money);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis",time()+600));
$input->SetGoods_tag("more");
// $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
$input->SetNotify_url($baseurl."return.php");// 不起作用
$input->SetTrade_type("NATIVE");
$input->SetProduct_id($_SESSION[DOU_ID]['user_id']);
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>阳光国际派遣-微信扫码支付</title>
</head>
<body>
    <!-- <div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式一</div><br/>
    <img alt="模式一扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data=<?php echo urlencode($url1);?>" style="width:150px;height:150px;"/>
    <br/><br/><br/> -->
    <div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式二</div><br/>
    <img alt="模式二扫码支付" src="<?php echo $baseurl ?>example/qrcode.php?data=<?php echo urlencode($url2);?>" style="width:150px;height:150px;"/><br/><br/><br/>
    <div><font style="color: red;font-size: 20px;">我已在微信端完成支付：</font><a href="<?php echo $baseurl ?>return.php"> 立即跳转</a></div><br>
</body>
</html>