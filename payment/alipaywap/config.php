<?php
define('ROOT_URL', dirname(dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'])).DIRECTORY_SEPARATOR);
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
$config = array(	
	//应用ID,您的APPID。
	'app_id' => '2017042807044839',

	//商户私钥，您的原始格式RSA私钥
	'merchant_private_key' => 'e3itw569hhqt3drxgyjsjta3mxd8ghf6',
	
	//异步通知地址
	'notify_url' => ROOT_URL.'notify_url.php',
	
	//同步跳转
	'return_url' => ROOT_URL.'return_url.php',

	//编码格式
	'charset' => 'UTF-8',

	//签名方式
	'sign_type'=>'RSA2',

	//支付宝网关
	'gatewayUrl' => 'https://openapi.alipay.com/gateway.do',

	//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
	'alipay_public_key' => '',
);
// print_r($config);