<?php 
// 配置数据
$_DPS = array();
/*数据库*/
$_DPS['DB'] = array(
        'host'      => 'localhost',
        'user'      => 'root',
        'pass'      => 'root',
        'name'      => 'integration',
        'charset'   => 'utf8',
        'port'      => '3306',
        'pre'       => 'ig_',
        'type'      => 'mysqli'
    );
require_once OPCORE.'conn.php';

// 自定义位置
define('CSS', SOUR_COM.__DS__.'css'.__DS__);
define('IMG', SOUR_COM.__DS__.'images'.__DS__);
define('JS', SOUR_COM.__DS__.'js'.__DS__);
define('LAYOUT', SOUR_COM.__DS__.'layout'.__DS__);
?>