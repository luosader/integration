<?php
require_once '../config.php';
require_once 'WxPay.class.php';

// echo "<br>";
// if (empty($_SESSION['openid'])) {
    // $wxpayjsapi = new WxPay();
    // $wxpayjsapi->GetOpenid();
// }
// echo $_SESSION['openid'];
// echo "<br>";
// print_r($wxpayjsapi->test());
// echo "<br>";
// print_r($wxpayjsapi->test2);

// $payment_config = db_factory::get_count("select config from ".TABLEPRE."witkey_pay_api where payment='wxjsapi'"); // 找到微信支付插件的配置
// $payment_config = unserialize($payment_config); // 配置反序列化
// print_r($payment_config);
// die;

function get_pay_url($charge_type, $pay_amount, $payment_config, $subject, $order_id, $model_id=null, $obj_id=null, $service=null, $sign_type='MD5', $form, $show_url='index.php?do=user&view=finance&op=details') {

    $out_trade_no = "{$uid}-{$order_id}-{$model_id}-".time();// 订单号长度不宜过长
    $return_url = ROOT_HOST . 'payment/wxjsapi/return.php';
    $notify_url = ROOT_HOST . 'payment/wxjsapi/notify.php';
    $charge_type == 'order_charge' and $t = "订单充值" or $t = "余额充值";
    $body       = $t . "(from:" . $username . ")";
    $attach     = $subject;

    //初始化日志
    // $logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
    // $log = Log::Init($logHandler, 15);

    //打印输出数组信息
    /*function printf_info($data)
    {
        foreach($data as $key=>$value){
            echo "<font color='#00ff55;'>$key</font> : $value <br/>";
        }
    }*/

    // 额外加的 order_id return_url show_url
    $order = array(
            'body'  => $body,
            'attach'  => $attach,
            'out_trade_no'  => $out_trade_no,
            'order_amount'  => $pay_amount,
            'notify_url'  => $notify_url,
            'charge_type'  => $charge_type,
            'order_id'  => $order_id,
            'return_url'  => $return_url,
            'show_url'  => $show_url
        );
    // 支付
    $wxpayjsapi = new WxPay($payment_config);
    // $_SESSION['openid'] = $wxpayjsapi->GetOpenid();
    $html_text = $wxpayjsapi->getJSAPI($order);
    return $html_text;

    //微信JS支付
    /*if($this->pay_code == 'weixin' && $_SESSION['openid'] && strstr($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')){
        $code_str = $this->payment->getJSAPI($order,$config_value);
        exit($code_str);
    }*/
}
?>