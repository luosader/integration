<?php 
require_once 'init_base.php';
// set_include_path(),缺点：当两个目录下都有 test.php 文件时，以第一个为准
// get_include_path()获取当前目录     .;C:\php\pear
set_include_path(
    get_include_path() . __PS__ .
    // OPCORE . __PS__.
    OPCORE .'lib'. __PS__.
    OPCORE .'lib/func'. __PS__.
    OPCORE .'lib/class'. __PS__.
    OPCORE .'lib/Database'. __PS__.
    OPCORE .'lib/Permission'. __PS__.
    __ROOT__ . __DS__.'source'. __PS__.
    __ROOT__ . SOUR_COM 
);
// 经过set_include_path()后，直接引入文件名
// 引入配置文件
require_once 'config.php';
$db = db_connect($_DPS['DB']);
// require_once 'DbFactoryClass.php';
// 载入核心文件
require_once 'CommonFunc.php';
require_once 'CoreClass.php';

// 时间
define('CURTIME', time());
define('STARTTIME', mktime(0,0,0,date('m'),date('d'),date('Y')));
define('ENDTIME', mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1);

// 开启缓冲区
ob_start();

?>