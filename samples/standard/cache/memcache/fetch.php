<?php 
/*简单来一波*/
// memcache简单使用
if (extension_loaded('memcache')) {
    $m = new memcache();
    $m->connect('localhost',11211) or die('shit');
    $m->set('memcache','hello memcache!<br>');
    echo 'Memcache拓展开启：<br>';
    echo $m->get('memcache');
} else {
    echo 'Memcache拓展未开启！';
}
echo "<hr>";
// memcached简单使用
if (extension_loaded('Memcached')) {
    $d = new memcached();
    $d->addServer('127.0.0.1',11211);
    $d->set('memcached','hello memcached!<br>');
    echo 'Memcached拓展开启：<br>';
    echo $d->get('memcached');
} else {
    echo 'Memcached拓展未开启！';
}

/*说明*/
### memcache_debug()
// memcache_debug()在参数 on_off设置为TRUE时打开调试输出，在值为 FALSE时关闭调试输出。
// memcache_debug()仅仅在PHP以--enable-debug方式编译时可以访问，并且 总是返回TRUE，其他情况下此函数不会产生任何影响并总是返回FALSE。
// memcache_debug(on_off);
### 
// set方法是add方法和replace方法的集合体。



// 【测试代码】

// // 判断是否开启memcache拓展
// extension_loaded('memcache');
// get_loaded_extensions();//查看所有已开启的拓展
// get_extension_funcs('memcache');// 查看此拓展所有方法
// class_exists('memcache');//判断此拓展是否存在
// dl(library);// 
// // Example loading an extension based on OS
// if (!extension_loaded('sqlite')) {
//     if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
//         dl('php_sqlite.dll');
//     } else {
//         dl('sqlite.so');
//     }
// }
// // Or using PHP_SHLIB_SUFFIX constant
// if (!extension_loaded('sqlite')) {
//     $prefix = (PHP_SHLIB_SUFFIX === 'dll') ? 'php_' : '';
//     dl($prefix . 'sqlite.' . PHP_SHLIB_SUFFIX);
// }

// //连接
// $mem = new Memcache;
// $mem->connect("192.168.0.200", 12000);

// //保存数据
// $mem->set('key1', 'This is first value', 0, 60);
// $val = $mem->get('key1');
// echo "Get key1 value: " . $val ."
// ";

// //替换数据
// $mem->replace('key1', 'This is replace value', 0, 60);
// $val = $mem->get('key1');
// echo "Get key1 value: " . $val . "
// ";

// //保存数组
// $arr = array('aaa', 'bbb', 'ccc', 'ddd');
// $mem->set('key2', $arr, 0, 60);
// $val2 = $mem->get('key2');
// echo "Get key2 value: ";
// print_r($val2);
// echo "
// ";

// //删除数据
// $mem->delete('key1');
// $val = $mem->get('key1');
// echo "Get key1 value: " . $val . "
// ";

// //清除所有数据
// $mem->flush();
// $val2 = $mem->get('key2');
// echo "Get key2 value: ";
// print_r($val2);
// echo "
// ";

// //关闭连接
// $mem->close();

// //添加多台memcached服务器
// $b = new Memcache();
// $b->addServer("10.55.38.18",11271);
// $b->addServer("10.55.38.18",11272);
// $b->addServer("10.55.38.18",11273);



?>