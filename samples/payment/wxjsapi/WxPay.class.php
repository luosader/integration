<?php
// 微信支付插件
/**
 * 支付 逻辑定义
 * Class 
 * @package include\payment
*/

// require_once('wxpay/lib/WxPay.Api.php'); // 微信扫码支付 demo 中的文件         
// require_once('wxpay/example/WxPay.NativePay.php');
// require_once('wxpay/example/WxPay.JsApiPay.php');


class WxPay
{
    public $tableName = 'ig_pay_api'; // 插件表        
    public $payment_config = array();// 支付配置参数
    public $test;// test 为测试专用
    public $test2;// test 为测试专用

    /**
     * 析构流函数
    */
    public function  __construct($payment_config=array()) {
        require_once(ROOT_PATH . SOUR_WEI .'lib/WxPay.Api.php'); // 微信扫码支付 demo 中的文件         
        require_once(ROOT_PATH . SOUR_WEI .'example/WxPay.NativePay.php');
        require_once(ROOT_PATH . SOUR_WEI .'example/WxPay.JsApiPay.php');

        // $payment_config = db_factory::get_count("select config from {$this->tableName} where payment='wxjsapi'"); // 找到微信支付插件的配置
        // $payment_config = unserialize($payment_config); // 配置反序列化
        // $payment_config = array(
        //         'appid' => '',
        //         'appsecret' => '',
        //         'mchid' => '',
        //         'key' => '',
        //     );

        WxPayConfig::$appid = $payment_config['appid']; // * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
        WxPayConfig::$mchid = $payment_config['mchid']; // * MCHID：商户号（必须配置，开户邮件中可查看）
        WxPayConfig::$key = $payment_config['key']; // KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
        WxPayConfig::$appsecret = $payment_config['appsecret']; // 公众帐号secert（仅JSAPI支付的时候需要配置)
        // WxPayConfig::APPID = $payment_config['appid'];
        // WxPayConfig::MCHID = $payment_config['mchid'];
        // WxPayConfig::KEY = $payment_config['key'];
        // WxPayConfig::APPSECRET = $payment_config['appsecret'];
        // $this->test = WxPayConfig::MCHID;
        // $this->test2 = $payment_config['mchid'];
    }

    public function test()
    {
        return $this->test;
    }

    /*
     * 获取用户openid
    */
    public function GetOpenid()
    {
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();// 多次CURL后只能用cookie获取其它参数
        return $openId;
    }

    /**
     * 获取当前的url 地址
     * @return type
    */
    private function get_url() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }

    /**
     * 服务器点对点响应操作给支付接口方调用
     * 
     */
    function response()
    {                        
        require_once('wxpay/example/notify.php');  
        $notify = new PayNotifyCallBack();
        $notify->Handle(false);       
    }
    
    /**
     * 页面跳转响应操作给支付接口方调用
    */
    function respond2()
    {
        // 微信扫码支付这里没有页面返回
    }

    /**
     * 生成扫码支付代码
     * @param   array   $order      订单信息
     * @param   array   $payment_config    支付方式信息
     */
    function get_code($order, $payment_config)
    { 
        /*
        global $_K, $uid, $username;
        $notify_url = $_K['siteurl'].'/include/payment/wxjsapi/notify.php';// 接收微信支付异步通知回调地址，通知url必须为直接可访问的url，不能携带参数。
        //$notify_url = C('site_url').U('Home/Payment/notifyUrl',array('pay_code'=>'weixin')); // 接收微信支付异步通知回调地址，通知url必须为直接可访问的url，不能携带参数。
        //$notify_url = C('site_url')."/index.php?m=Home&c=Payment&a=notifyUrl&pay_code=weixin";
        */
        if (empty($order['attach'])) $order['attach'] = 'weixin';

        $input = new WxPayUnifiedOrder();
        $input->SetBody($order['body']); // 商品描述
        $input->SetAttach($order['attach']); // 附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
        $input->SetOut_trade_no($order['out_trade_no']); // 商户系统内部的订单号,32个字符内、可包含字母, 其他说明见商户订单号
        $input->SetTotal_fee($order['order_amount']*100); // 订单总金额，单位为分，详见支付金额
        $input->SetNotify_url($order['notify_url']); // 接收微信支付异步通知回调地址，通知url必须为直接可访问的url，不能携带参数。
        $input->SetTrade_type('NATIVE'); // 交易类型   取值如下：JSAPI，NATIVE，APP，详细说明见参数规定    NATIVE--原生扫码支付
        $input->SetProduct_id($order['order_id']); // 商品ID trade_type=NATIVE，此参数必传。此id为二维码中包含的商品ID，商户自行定义。
        $notify = new NativePay();
        $result = $notify->GetPayUrl($input); // 获取生成二维码的地址
        $url2 = $result['code_url'];
        return '<img alt="模式二扫码支付" src="/index.php?m=Home&c=Index&a=qr_code&data='.urlencode($url2).'" style="width:110px;height:110px;"/>';        
    }

    /**
     * JSAPI支付
    */
    function getJSAPI($order){
        if ($order['show_url']) {
            $show_url = urlencode($order['show_url']);
        }
        /*if(stripos($order['out_trade_no'],'user_charge') !== false){
            $go_url = $order['return_url'].'?charge_type=user_charge&status=ok';//充值成功
            $back_url = $order['return_url'].'?charge_type=user_charge&status=bad';// 充值失败
        } else {
            $go_url = $order['return_url'].'?charge_type=order_charge&status=ok';// 支付成功
            $back_url = $order['return_url'].'?charge_type=order_charge&status=bad';// 支付失败
        }
        $go_url .= '&show_url='.$show_url;
        $back_url .= '&show_url='.$show_url;*/
        $go_url = $order['return_url'].'?out_trade_no='. $order['out_trade_no'] .'&total_fee='. $order['order_amount'] .'&charge_type='. $order['charge_type'] .'&show_url='. $show_url;
        $back_url = $go_url .'&get_brand_wcpay_request=bad';
        $go_url .= '&get_brand_wcpay_request=ok';
        
        if (empty($order['attach'])) $order['attach'] = 'weixin';

        //①、获取用户openid
        $tools = new JsApiPay();
        // $openId = $tools->GetOpenid();
        $openId = $_SESSION['openid'];

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody($order['body']);
        $input->SetAttach($order['attach']);
        $input->SetOut_trade_no($order['out_trade_no']);
        $input->SetTotal_fee($order['order_amount']*100);
        $input->SetTime_start(date('YmdHis'));
        $input->SetTime_expire(date('YmdHis', time() + 600));
        $input->SetGoods_tag('wx_pay_jsapi');
        $input->SetNotify_url($order['notify_url']);
        $input->SetTrade_type('JSAPI');
        $input->SetOpenid($openId);
        $order2 = WxPayApi::unifiedOrder($input);
        //echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        // $this->printf_info($order2);exit;
        $jsApiParameters = $tools->GetJsApiParameters($order2);

        //获取共享收货地址js函数参数
        // $editAddress = $tools->GetEditAddressParameters();

        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
        */

        $html = <<<EOF
        <script type="text/javascript">
            //调用微信JS api 支付
            function jsApiCall()
            {
                WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',$jsApiParameters,
                    function(res){
                        // WeixinJSBridge.log(res.err_msg);
                        // alert(res.err_code+res.err_desc+res.err_msg);
                        switch (res.err_msg){
                            case 'get_brand_wcpay_request:cancel':  //取消支付 
                                alert('您已取消，请耐心等待跳转');
                                location.href='$back_url';
                                break;
                            case 'get_brand_wcpay_request:fail'://支付失败
                                alert(res.err_desc);
                                //location.href='$back_url';
                                break;
                            case 'get_brand_wcpay_request:ok'://支付成功
                                alert('您已支付成功，请耐心等待跳转');
                                location.href='$go_url';
                                break;
                        }
                    }
                );
            }

            function callpay()
            {
                if (typeof WeixinJSBridge=='undefined'){
                    if( document.addEventListener ){
                        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                    }else if (document.attachEvent){
                        document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                    }
                }else{
                    jsApiCall();
                }
            }
            callpay();
        </script>
EOF;
        return $html;
    }

    //打印数组信息
    function printf_info($data)
    {
        foreach($data as $key=>$value){
            echo "<font color='#00ff55;'>$key</font> : $value <br/>";
        }
    }
}
?>