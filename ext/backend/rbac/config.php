<?php 
require_once '../../../source/init_base.php';
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
// 配置数据
$_DPS = array();
/*数据库*/
$_DPS['DB'] = array(
        'host'      => 'localhost',
        'user'      => 'root',
        'pass'      => 'root',
        'name'      => 'rbac',
        'charset'   => 'utf8',
        'port'      => '3306',
        'pre'       => 'qx_',
        'type'      => 'mysqli'
    );
require_once OPCORE.'conn.php';

// 自定义位置
define('CSS', SOUR_COM.__DS__.'css'.__DS__);
define('IMG', SOUR_COM.__DS__.'images'.__DS__);
define('JS', SOUR_COM.__DS__.'js'.__DS__);
define('LAYOUT', SOUR_COM.__DS__.'layout'.__DS__);
$db = db_connect($_DPS['DB']);
// require_once 'DbFactoryClass.php';
// 载入核心文件
require_once 'CommonFunc.php';
require_once 'CoreClass.php';

// 时间
define('CTIME', $_SERVER['REQUEST_TIME']);
define('STIME', mktime(0,0,0,date('m'),date('d'),date('Y')));
define('ETIME', mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1);

if (empty(session_id())) {
    session_start();
}
// 开启缓冲区
// ob_start();

?>