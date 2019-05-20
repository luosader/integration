<?php 
// header('Content-Type:text/html;charset=GBK');//设置文本类型和编码
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once '../../source/init_base.php';
require_once ROOT_PATH . SOUR_WEI .'lib/WxPay.Api.php';
require_once ROOT_PATH . SOUR_WEI .'example/WxPay.NativePay.php';
// require_once 'log.php';

session_start();
$baseurl = 'http://'.$_SERVER['HTTP_HOST'].'/include/weixin/';

// $openId = $_SESSION['openid'];
$_REQUEST['money'] = $_REQUEST['money']?$_REQUEST['money']:1;
$money = $_REQUEST['money']*100;
// $telephone = $_SESSION['telephone'];
$out_trade_no = WxPayConfig::MCHID.date('YmdHis');
$_SESSION['wx_money'] = $_REQUEST['money'];
$_SESSION['wx_out_trade_no'] = $out_trade_no;


//模式一
$notify = new NativePay();
$url1 = $notify->GetPrePayUrl('123456789');

//模式二
$input = new WxPayUnifiedOrder();
$input->SetBody('shihuahuijs');
$input->SetAttach('native');
$input->SetOut_trade_no($out_trade_no);
$input->SetTotal_fee($money);
$input->SetTime_start(date('YmdHis'));
$input->SetTime_expire(date('YmdHis',time()+600));
$input->SetGoods_tag('more');
// $input->SetNotify_url('http://paysdk.weixin.qq.com/example/notify.php');
$input->SetNotify_url($baseurl.'return.php');// 不起作用
$input->SetTrade_type('NATIVE');
$input->SetProduct_id($_SESSION[DOU_ID]['user_id']);
$result = $notify->GetPayUrl($input);
$url2 = $result['code_url'];
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>阳光国际派遣-微信扫码支付</title>
</head>
<body>
    <div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式一</div><br/>
    <img alt="模式一扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data=<?php echo urlencode($url1);?>" style="width:150px;height:150px;"/>
    <br/><br/><br/>
    <div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式二</div><br/>
    <img alt="模式二扫码支付" src="<?php echo $baseurl ?>example/qrcode.php?data=<?php echo urlencode($url2);?>" style="width:150px;height:150px;"/><br/><br/><br/>
    <div><font style="color: red;font-size: 20px;">我已在微信端完成支付：</font><a href="<?php echo $baseurl ?>return.php"> 立即跳转</a></div><br>
</body>
</html>