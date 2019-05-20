<?php
/* *
* 功能：支付宝手机网站支付接口(alipay.trade.wap.pay)接口调试入口页面
* 版本：2.0
* 修改日期：2016-11-01
* 说明：
* 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
请确保项目文件有可写权限，不然打印不了日志。
*/
header("Content-type: text/html; charset=utf-8");

require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'./../config.php';
require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'service/AlipayTradeService.php';
require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'buildermodel/AlipayTradeWapPayContentBuilder.php';

if (!empty($_POST['WIDout_trade_no'])&& trim($_POST['WIDout_trade_no'])!=""){
//商户订单号，商户网站订单系统中唯一订单号，必填
  $out_trade_no = $_POST['WIDout_trade_no'];
//订单名称，必填
  $subject = $_POST['WIDsubject'];
//付款金额，必填
  $total_amount = $_POST['WIDtotal_amount'];
//商品描述，可空
  $body = $_POST['WIDbody'];
//超时时间
  $timeout_express="1m";

  $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
  $payRequestBuilder->setBody($body);
  $payRequestBuilder->setSubject($subject);
  $payRequestBuilder->setOutTradeNo($out_trade_no);
  $payRequestBuilder->setTotalAmount($total_amount);
  $payRequestBuilder->setTimeExpress($timeout_express);

  $payResponse = new AlipayTradeService($config);
  $result = $payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

  return ;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>支付宝手机网站支付接口</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../mobile.css">
</head>
<body text=#000000 bgColor="#ffffff" leftMargin=0 topMargin=4>
  <header class="am-header">
    <h1>支付宝手机网站支付接口快速通道(接口名：alipay.trade.wap.pay)</h1>
  </header>
  <div id="main">
    <form name=alipayment action='' method=post target="_blank">
      <div id="body" style="clear:left">
        <dl class="content">
          <dt>商户订单号：</dt>
          <dd>
            <input id="WIDout_trade_no" name="WIDout_trade_no" />
          </dd>
          <hr class="one_line">
          <dt>订单名称：</dt>
          <dd>
            <input id="WIDsubject" name="WIDsubject" />
          </dd>
          <hr class="one_line">
          <dt>付款金额：</dt>
          <dd>
            <input id="WIDtotal_amount" name="WIDtotal_amount" />
          </dd>
          <hr class="one_line">
          <dt>商品描述：</dt>
          <dd>
            <input id="WIDbody" name="WIDbody" />
          </dd>
          <hr class="one_line">
          <dt></dt>
          <dd id="btn-dd">
            <span class="new-btn-login-sp">
              <button class="new-btn-login" type="submit" style="text-align:center;">确 认</button>
            </span>
            <span class="note-help">如果您点击“确认”按钮，即表示您同意该次的执行操作。</span>
          </dd>
        </dl>
      </div>
    </form>
    <div id="foot">
      <ul class="foot-ul">
        <li>
          支付宝版权所有 2015-2018 ALIPAY.COM 
        </li>
      </ul>
    </div>
  </div>
</body>
<script language="javascript">
  function GetDateNow() {
    var vNow = new Date();
    var sNow = "";
    sNow += String(vNow.getFullYear());
    sNow += String(vNow.getMonth() + 1);
    sNow += String(vNow.getDate());
    sNow += String(vNow.getHours());
    sNow += String(vNow.getMinutes());
    sNow += String(vNow.getSeconds());
    sNow += String(vNow.getMilliseconds());
    document.getElementById("WIDout_trade_no").value =  sNow;
    document.getElementById("WIDsubject").value = "测试";
    document.getElementById("WIDtotal_amount").value = "0.01";
    document.getElementById("WIDbody").value = "购买测试商品0.01元";
  }
  GetDateNow();
</script>
</html>