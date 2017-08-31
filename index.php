<?php
/** 入口文件
+--------------------------------+
* __ROOT_PATH__   绝对路径到根目录
* __ROOT_HOST__   域名
* __ROOT_URL__    网址URL
* $_DPS 全局
* 
* ``是为了避免关键词冲突
+--------------------------------+
*/
header("Content-Type:text/html;charset=utf-8");
require_once './source/init.php';
// debug(ROOT_URL);
// echo 'HTTP_HOST: '.$_SERVER['HTTP_HOST'].'<br>';# tx.ig
// echo 'PHP_SELF: '.$_SERVER['PHP_SELF'].'<br>';# /payment/alipayjs/index.php
// echo 'QUERY_STRING: '.$_SERVER['QUERY_STRING'].'<br>';# a=1&b=dsad
// echo 'REQUEST_URI: '.$_SERVER['REQUEST_URI'].'<br>';# /payment/alipayjs/index.php?a=1&b=dsad
// // echo 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER'].'<br>';# 上一个url , http://tx.ig/payment/
// echo 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD'].'<br>';# GET
// echo 'DOCUMENT_ROOT: '.$_SERVER['DOCUMENT_ROOT'].'<br>';# D:/WWW/_op/integration
// echo 'DOCUMENT_URI: '.$_SERVER['DOCUMENT_URI'].'<br>';# /payment/alipayjs/index.php
// echo 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT'].'<br>';# Mozilla/5.0 (Windows NT 6.1; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0




/*对URL的传参处理*/
$http_param = http_param();
// debug($http_param,1);

if ($http_param) {
    extract($http_param);
    template($http_param);
} else {
    if ($m) {
        include_once $m.'index.php';
    } else {
        include 'home.php';
    }
}
?>