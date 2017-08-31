<?php
  // header('Content-Type:text/html;charset=UTF-8');//设置字符集,纯PHP中使用

  require_once 'Map.class.php';

  $map = new Map();
  $getIp = $map->getIP();
  // $getIp='120.76.72.193';
  $getIp='180.76.174.54';
  // $getIp='115.28.176.102';
  // $getIp='120.27.117.216';
  // $getIp='124.173.67.228';
  $getIp='219.239.223.158';
  $ll = $map->locationByIP($getIp);
  print_r($ll);
  echo '<br><br>';
  if ($ll) {
  	print_r($map->locationByGPS($ll['lng'], $ll['lat']));
  } else {
  	echo "无法获取正确的 GPS 位置信息。";
  }
  
  


?>