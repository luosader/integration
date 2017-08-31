<?php 
require_once '../../source/init_base.php';
if (file_exists(ROOT_PATH . SOUR_WEI .'lib/WxPay.Api.php')) {
    // require_once dirname(__FILE__) . '/include/weixin/lib/WxPay.Api.php';
    // require_once dirname(__FILE__) . '/include/weixin/example/WxPay.JsApiPay.php';
    // $tools = new JsApiPay();
    // $tools->GetOpenid();
    echo "openid";
} else {
    exit('核心文件丢失！');
}
?>