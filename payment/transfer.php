<?php 
$cash = 0.01;
$username = 'lothar';
$strUrl = 'index.php?do=recharge&cash='.$cash;
$arrPayConfig = array(
        'pay_open' => 1,
        'mincash' => 0.01,
        'maxcash' => 10000,
    );
$referUrl = $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'-1';
$html_title = '';

if(floatval($_SESSION['chargecash']) != floatval($cash)){
    exit('金额错误');
}

if (isset($formhash)) {
    $payTitle = $username . '(' . $html_title . '在线充值' . trim ( sprintf ("%10.2f",$cash) ) .'元)';
    // $bankConfig = kekezu::get_payment_config($bank);
    // require S_ROOT . "/include/payment/" . $bank . "/order.php";
    // $form = get_pay_url('user_charge',$cash, $bankConfig, $payTitle, time(),'0','0',$service,'MD5','form','index.php?do=recharge&status=1&cash='.$cash);
    // if($bank == 'wxpay'){
    //     $wxpayUrl       = $form['url'];
    //     $wxpayOrderId   = $form['out_trade_no'];
    //     $_SESSION['wxpay'] = 1;
    // } else {
    //     echo $form;die();
    // }
}

?>