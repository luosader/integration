<?php 
header("content-type:text/html;charset=utf-8");
require_once '../../../source/init.php';
// require_once '/source/common/lib/CommonFunc.php';

$rec = isset($_REQUEST['rec'])?trim($_REQUEST['rec']):'pao';

$arr = array(3,5,8,4,9,6,1,7,2);
// echo implode(" ",$arr)."<br/>";
$array1 = array(1,2,3,6,1);
$file1 = '';
$file2 = '';

?>