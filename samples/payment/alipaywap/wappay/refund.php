<?php
/* *
 * 功能：支付宝手机网站alipay.trade.refund (统一收单交易退款接口)调试入口页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 请确保项目文件有可写权限，不然打印不了日志。
*/
 header("Content-type: text/html; charset=utf-8");

 require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'./../config.php';
 require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'service/AlipayTradeService.php';
 require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'buildermodel/AlipayTradeRefundContentBuilder.php';

 if (!empty($_POST['WIDout_trade_no']) || !empty($_POST['WIDtrade_no'])){
    //商户订单号和支付宝交易号不能同时为空。 trade_no、  out_trade_no如果同时存在优先取trade_no

    //商户订单号，和支付宝交易号二选一
    $out_trade_no = trim($_POST['WIDout_trade_no']);
    //支付宝交易号，和商户订单号二选一
    $trade_no = trim($_POST['WIDtrade_no']);
    //退款金额，不能大于订单总金额
    $refund_amount=trim($_POST['WIDrefund_amount']);
    //退款的原因说明
    $refund_reason=trim($_POST['WIDrefund_reason']);
    //标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传。
    $out_request_no=trim($_POST['WIDout_request_no']);

    $RequestBuilder = new AlipayTradeRefundContentBuilder();
    $RequestBuilder->setTradeNo($trade_no);
    $RequestBuilder->setOutTradeNo($out_trade_no);
    $RequestBuilder->setRefundAmount($refund_amount);
    $RequestBuilder->setRefundReason($refund_reason);
    $RequestBuilder->setOutRequestNo($out_request_no);

    $Response = new AlipayTradeService($config);
    $result=$Response->Refund($RequestBuilder);
    return ;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>支付宝手机网站alipay.trade.refund (统一收单交易退款接口)</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../mobile.css">
</head>
<body text=#000000 bgColor="#ffffff" leftMargin=0 topMargin=4>
    <header class="am-header">
        <h1>支付宝手机网站alipay.trade.refund (统一收单交易退款接口)</h1>
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
                    <dt>支付宝交易号：</dt>
                    <dd>
                        <input id="WIDtrade_no" name="WIDtrade_no" />
                    </dd>
                    <hr class="one_line">
                    <dt></dt>
                    <dd>
                        <span style="line-height: 28px; color:red;">注意：商户订单号和支付宝交易号不能同时为空。 trade_no、  out_trade_no如果同时存在优先取trade_no</span>
                    </dd>
                    <hr class="one_line">
                    <dt>退款金额：</dt>
                    <dd>
                        <input id="WIDrefund_amount" name="WIDrefund_amount" />
                    </dd>
                    <hr class="one_line">
                    <dt>退款原因：</dt>
                    <dd>
                        <input id="WIDrefund_reason" name="WIDrefund_reason" />
                    </dd>
                    <hr class="one_line">
                    <dt>退款单号：</dt>
                    <dd>
                        <input id="WIDout_request_no" name="WIDout_request_no" />
                    </dd>
                    <hr class="one_line">
                    <dt></dt>
                    <dd>
                        <span style="line-height: 28px; color:red;">注意：如是部分退款，则参数退款单号（out_request_no）必传。</span>
                    </dd>
                    <hr class="one_line">
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