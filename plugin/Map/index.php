<?php 
require_once '../../source/init.php';
// require_once 'Map.class.php';
$map = new Map();


debug('示例1：');
$ip = $map->getIP();
debug($ip);
$l_ip = $map->locationByIP($ip);
debug($l_ip);
echo "<hr>";
debug('示例2：');
$ip = '106.14.74.155';
debug($ip);
$l_ip = $map->locationByIP($ip);
debug($l_ip);

$lng = $l_ip['lng'];
$lat = $l_ip['lat'];
$l_gps = $map->locationByGPS($lng, $lat);
debug($l_gps);
?>