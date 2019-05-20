<?php 
  header('Content-Type:text/html;charset=UTF-8');//设置字符集,纯PHP中使用
  function getIP() {
    if (getenv('HTTP_CLIENT_IP')) {
      $ip = getenv('HTTP_CLIENT_IP'); 
    }
    elseif (getenv('HTTP_X_FORWARDED_FOR')) { //获取客户端用代理服务器访问时的真实ip地址
      $ip = getenv('HTTP_X_FORWARDED_FOR');
    }
    elseif (getenv('HTTP_X_FORWARDED')) { 
      $ip = getenv('HTTP_X_FORWARDED');
    }
    elseif (getenv('HTTP_FORWARDED_FOR')) {
      $ip = getenv('HTTP_FORWARDED_FOR'); 
    }
    elseif (getenv('HTTP_FORWARDED')) {
      $ip = getenv('HTTP_FORWARDED');
    }
    else { 
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }


  //14行PHP代码获取客户端IP地址经纬度及所在城市
  // http://lbsyun.baidu.com/
  // $getIp=$_SERVER["REMOTE_ADDR"];
  // $getIp=getIP();
  echo "华创在线";
  echo '<br/>';
  $getIp='120.76.72.193';
  echo 'IP:',$getIp;
  echo '<br/>';
  $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=7IZ6fgGEGohCrRKUE9Rj4TSQ&ip={$getIp}&coor=bd09ll");
  $json = json_decode($content);

  if ($json->status == 240) {
    echo $json->message;
  } else {
    echo 'log(经度)：',$json->{'content'}->{'point'}->{'x'};//按层级关系提取经度数据
    echo '<br/>';
    echo 'lat(纬度)：',$json->{'content'}->{'point'}->{'y'};//按层级关系提取纬度数据
    echo '<br/>';
    print $json->{'content'}->{'address'};//按层级关系提取address数据
  }
?>