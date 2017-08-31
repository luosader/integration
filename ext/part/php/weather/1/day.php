<?php
header("content-type:text/html;charset=utf-8");
// $weather = file_get_contents("http://www.weather.com.cn/data/sk/101280601.html");//深圳
// $weather = file_get_contents("http://www.weather.com.cn/data/sk/101220101.html");//合肥
$weather = file_get_contents("http://www.weather.com.cn/weather/101220101.shtml");//合肥
echo $weather;
?> 