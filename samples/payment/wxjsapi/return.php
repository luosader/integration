<?php
require_once '../config.php';
// 订单验证 
require_once ROOT_PATH . SOUR_WEI .'lib/WxPay.Api.php';
// $payment_config = kekezu::get_payment_config('wxjsapi');
// $payment_config or die("支付配置错误，支付无法完成，请联系管理员。");
// KEKE_DEBUG and  file_put_contents (S_ROOT.'data/log/alipayjs_log.txt', var_export ( $_GET, 1 ) , FILE_APPEND );
//查询订单 最好用$transaction_id , 也可用$out_trade_no
function QueryorderN($idno)
{
    $inputObj = new WxPayOrderQuery();
    // $inputObj->SetTransaction_id($transaction_id);
    $inputObj->SetOut_trade_no($idno);
    $result = WxPayApi::orderQuery($inputObj);
    // Log::DEBUG("query:" . json_encode($result));
    if(array_key_exists('return_code',$result) && array_key_exists('result_code',$result) && $result['return_code']=='SUCCESS' && $result['result_code']=='SUCCESS')
    {
        return true;
    }
    return false;
}

$out_trade_no = $_GET['out_trade_no']?$_GET['out_trade_no']:$_SESSION['wx_out_trade_no'];// 订单号
$total_fee = $_GET['total_fee']?$_GET['total_fee']:$_SESSION['wx_money'];
$check_order = QueryorderN($out_trade_no);
if ($check_order===false) {
    echo '<script type="text/javascript">alert("系统检测出您未支付，如有问题请联系管理员");location.href="'.ROOT_HOST.'payment/wxnative/native.php?money='.$total_fee.'";</script>';
    exit();
}

isset($get_brand_wcpay_request) && $result===false
if ((isset($get_brand_wcpay_request) && $get_brand_wcpay_request=='ok') || $check_order) {
    $uid = 1;
    if (!$uid) {
        echo "<script type='text/javascript'>alert('用户信息丢失！');</script>";
    }
    // $telephone = $_GET['telephone'];
    $payment = 'wx_native';
    // $sql = sprintf('UPDATE %s set is_finish=1,zhifiid=\'%s\',orderid=\'%s\',payment=\'%s\' where user_id=%d',$dou->table('user'),$out_trade_no,$payment,$uid);
    // $dou->query($sql);
    // $show_url = 'index.php?do=pay&type=order&id='.$order_id.'&status=1';
    $show_url = 'order.php';
} elseif ((isset($get_brand_wcpay_request) && $get_brand_wcpay_request=='bad') || !$check_order) {
    $show_url = 'index.php';
}
$show_url = $show_url ? $show_url : 'index.php';
echo '<script type="text/javascript">alert("订单号：'.$out_trade_no.'");location.href="'. ROOT_HOST .'payment/'. $show_url .'";</script>';
// header('Location:'. ROOT_HOST .'payment'. __DS__ . $show_url);
exit();
?>