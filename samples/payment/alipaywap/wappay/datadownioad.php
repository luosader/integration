<?php
/* *
 * 功能：支付宝手机网站alipay.data.dataservice.bill.downloadurl.query (查询对账单下载地址)接口调试入口页面
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 请确保项目文件有可写权限，不然打印不了日志。
*/
header("Content-type: text/html; charset=utf-8");

require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'./../config.php';
require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'service/AlipayTradeService.php';
require_once dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'buildermodel/AlipayDataDataserviceBillDownloadurlQueryContentBuilder.php';

if (!empty($_POST['WIDbill_type']) && !empty($_POST['WIDbill_date'])){
    //账单类型，商户通过接口或商户经开放平台授权后其所属服务商通过接口可以获取以下账单类型：trade、signcustomer；

    //trade指商户基于支付宝交易收单的业务账单；signcustomer是指基于商户支付宝余额收入及支出等资金变动的帐务账单；
    $bill_type = trim($_POST['WIDbill_type']);
    //账单时间：日账单格式为yyyy-MM-dd，月账单格式为yyyy-MM。
    $bill_date = trim($_POST['WIDbill_date']);

    $RequestBuilder = new AlipayDataDataserviceBillDownloadurlQueryContentBuilder();
    $RequestBuilder->setBillType($bill_type);
    $RequestBuilder->setBillDate($bill_date);
    $Response = new AlipayTradeService($config);
    $result=$Response->downloadurlQuery($RequestBuilder);
    return ;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>alipay.data.dataservice.bill.downloadurl.query(查询对账单下载地址)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../mobile.css">
</head>
<body text=#000000 bgColor="#ffffff" leftMargin=0 topMargin=4>
    <header class="am-header">
        <h1>支付宝手机网站查询对账单下载地址(接口名：alipay.data.dataservice.bill.downloadurl.query)</h1>
    </header>
    <div id="main">
        <form name=alipayment action='' method=post target="_blank">
            <div id="body" style="clear:left">
                <dl class="content">
                    <dt>账单类型：</dt>
                    <dd>
                        <input id="WIDbill_type" name="WIDbill_type" value="trade" />
                    </dd>
                    <hr class="one_line">
                    <dt>账单时间：</dt>
                    <dd>
                        <input id="WIDbill_date" name="WIDbill_date" />
                    </dd>
                    <hr class="one_line">
                    <dt></dt>
                    <dd>
                        <span style="line-height: 28px; color:red;">注意：账单类型和账单时间不能为空！账单时间：日账单格式为yyyy-MM-dd，月账单格式为yyyy-MM。</span>
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