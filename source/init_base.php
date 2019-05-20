<?php 
header('content-type:text/html;charset=utf-8');
// error_reporting(E_ALL);// 报告所有错误
error_reporting(E_ALL & ~E_NOTICE);// 屏蔽警告
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));// 显示除了E_NOTICE(提示)和E_WARNING(警告)外的所有错误
// error_reporting(E_ERROR);

define('IN_INTE', true);
// 关闭 set_magic_quotes_runtime
@set_magic_quotes_runtime(0);
// 调整时区
if (PHP_VERSION >= '5.1') date_default_timezone_set('PRC');

// 预定义常量、包
define('__DS__', DIRECTORY_SEPARATOR);//路径分隔符 在linux上是一个"/"号,WIN上是一个"\"号
define('__PS__', PATH_SEPARATOR);//目录分隔符 在linux上是一个":"号,WIN上是一个";"号

// 当前项目位置 D:\WWW\Github\_lothar-org\integration\index.php
// 定义 opcore 位置 D:\WWW\Github\_lothar\op\opcore\
define('OPCORE', dirname(dirname(dirname(__FILE__))).__DS__.'op'.__DS__.'opcore'.__DS__);

// 定义基础常量
define('__ROOT__', dirname(dirname(__FILE__)).__DS__);//定义根目录，物理路径 D:\WWW\_svn\_op\integration\
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].__DS__);// D:/WWW/_svn/_op/integration\ 
define('ROOT_HOST', 'http://'.$_SERVER['HTTP_HOST'].__DS__);// http://tx.ig\ 
define('ROOT_URL', dirname(ROOT_HOST)  .$_SERVER['PHP_SELF']);// http://tx.ig/index.php 当前入口
// define('ROOT_URL', dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']).__DS__);

// 定义资源包位置
// 公共
define('LIB', OPCORE.'lib'.__DS__);
define('OPCSS', OPCORE.'css'.__DS__);
define('OPIMG', OPCORE.'images'.__DS__);
define('OPJS', OPCORE.'js'.__DS__);
// 当前项目
define('SOUR_COM', 'source'.__DS__.'common'.__DS__);
define('SOUR_ALI', 'source'.__DS__.'alipay'.__DS__);
define('SOUR_WEI', 'source'.__DS__.'weixin'.__DS__.'WxpayAPI_php_v3'.__DS__);
define('SOUR_EXCEL', 'source'.__DS__.'PHPExcel'.__DS__);
define('CSS', SOUR_COM.__DS__.'css'.__DS__);
define('IMG', SOUR_COM.__DS__.'images'.__DS__);
define('JS', SOUR_COM.__DS__.'js'.__DS__);
define('LAYOUT', SOUR_COM.__DS__.'tpl'.__DS__.'layout'.__DS__);

?>