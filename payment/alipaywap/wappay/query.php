<?php
/* *
 * 功能：支付宝手机网站alipay.trade.query (统一收单线下交易查询)调试入口页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 请确保项目文件有可写权限，不然打印不了日志。
*/
header("Content-type: text/html; charset=utf-8");

require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'./../config.php';
require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'service/AlipayTradeService.php';
require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'buildermodel/AlipayTradeQueryContentBuilder.php';

if (!empty($_POST['WIDout_trade_no']) || !empty($_POST['WIDtrade_no'])){
    //商户订单号和支付宝交易号不能同时为空。 trade_no、  out_trade_no如果同时存在优先取trade_no
    
    //商户订单号，和支付宝交易号二选一
    $out_trade_no = trim($_POST['WIDout_trade_no']);
    //支付宝交易号，和商户订单号二选一
    $trade_no = trim($_POST['WIDtrade_no']);

    $RequestBuilder = new AlipayTradeQueryContentBuilder();
    $RequestBuilder->setTradeNo($trade_no);
    $RequestBuilder->setOutTradeNo($out_trade_no);

    $Response = new AlipayTradeService($config);
    $result=$Response->Query($RequestBuilder);
    return ;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>支付宝手机网站alipay.trade.query (统一收单线下交易查询)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../mobile.css">
</head>
<body text=#000000 bgColor="#ffffff" leftMargin=0 topMargin=4>
    <header class="am-header">
        <h1>支付宝手机网站alipay.trade.query (统一收单线下交易查询)</h1>
    </header>
    <div id="main">
        <form name=alipayment action='' method=post target="_blank">
            <div id="body" style="clear:left">
                <dl class="content">
                    <dt>商户订单号
                        ：</dt>
                        <dd>
                            <input id="WIDout_trade_no" name="WIDout_trade_no" />
                        </dd>
                        <hr class="one_line">
                        <dt>支付宝交易号：</dt>
                        <dd>
                            <input id="WIDtrade_no" name="WIDtrade_no" />
                        </dd>
                        <hr class="one_line">
                        <dt></dt>
                        <dd>
                            <span style="line-height: 28px; color:red;">注意：商户订单号和支付宝交易号不能同时为空。 trade_no、  out_trade_no如果同时存在优先取trade_no</span>
                        </dd>
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
</html>