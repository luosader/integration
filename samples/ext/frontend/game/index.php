<?php 
require_once '../../../source/init.php';
debug('小零件');
$subject = 
        'jQuery:tkdz,坦克大战;#,推箱子;#,俄罗斯方块'
    ;
$search = array('{p}','{m}');
$replace = array('php/','mysql/');
$arrMenu = menuList($subject,$search,$replace);
debug($arrMenu,1);
?>