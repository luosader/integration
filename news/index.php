<?php 
require_once '../source/init.php';
debug('PHP_消息');
$subject = 
        '系统消息:{s}#,弹出消息;{e}#,消息提醒;{e}#,统计|'.
        '短信:{m}yunpian,云片;{m}chonry,创瑞;{m}alidayu,阿里大于;{m}#,短信宝|'.
        '邮件:{e}#,新浪邮箱;{e}#,QQ邮箱;{e}#,统计'
    ;
$search = array('{s}','{m}','{e}');
$replace = array('sys/','msg/','email/');
$arrMenu = MenuList($subject,$search,$replace);
debug($arrMenu,1);
?>