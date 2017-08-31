<?php 
require_once '../weather.func.php';
$url = 'http://www.weather.com.cn/weather/101220101.shtml';
/*
$pattern="/<div class=\"con-right\".*?>.*?<\/div>/ism";
$pattern1="/<h1>.*?<\/h1>/ism";
$pattern2="/<div class=\"btn\".*?>.*?<\/div>/ism";
$pattern3 = 'href=[\"\'](http:\/\/|\.\/|\/)?\w+(\.\w+)*(\/\w+(\.\w+)?)*(\/|\?\w*=\w*(&\w*=\w*)*)?[\"\']';
$pattern3="/<a href=\".*?\".*?class=\"button btn-demo\".*?>/ism";
$pattern3="/<a.*?href=[\'|\"](.*?(?:[\.html|\.zip|\.rar|\.7z]))[\'|\"].*?[\/]?>/";
*/
// $pattern = "/<div id=\"7d\" class=\"c7d\">.*?<\/div>/ism";
$pattern = "/<ul class=\"t clearfix\">.*?<\/ul>/ism";

$get_weather = get_weather($url, $pattern);
echo "合肥：<br>";
echo $get_weather[0];
// print_r($get_weather);
?>
<style type="text/css">
    ul{list-style: none;}
    li{float: left;margin-right: 15px;padding:10px;border:1px solid #CCC}
</style>