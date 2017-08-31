<?php 
require_once '../../source/init.php';
debug('小零件PHP');
$subject = 
        '验证码:{v}#,通用;{v}#,滑动;{v}#,点击;{v}#,密码强度|'.
        '搜索:{s}#,全盘搜索;{s}#,全网搜索'
    ;
$search = array('{v}','{s}');
$replace = array('verify/','search/');
$arrMenu = MenuList($subject,$search,$replace);
debug($arrMenu,1);
?>