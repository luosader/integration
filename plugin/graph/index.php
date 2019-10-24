<?php 
require_once './source/init.php';
debug('图表');
$subject = 
        'EChart:EChart,基本;#,柱状图;#,折线图;#,扇形图;#,热力图;#,地图;#,ER;#,更多|'.
        'gvChart:gvChart,常用'
    ;
$arrMenu = menuList($subject);
debug($arrMenu,1);

?>