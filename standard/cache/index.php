<?php 
require_once '../../source/init_base.php';
$allow_catalog = array('memcache','redis');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>缓存系列</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT_HOST.SOUR_COM ?>css/common.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT_HOST.SOUR_COM ?>css/block2.css">
</head>
<body>
    <h1>Memcache</h1>
    <div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a href="memcache/intro.php">介绍</a></li>
            <li style="background-color:#698B22"><a href="memcache/install.php">安装</a></li>
            <li style="background-color:#8B6914"><a href="memcache/connect.php">连接</a></li>
            <li style="background-color:#CDCD00;"><a style="color:#F00" href="memcache/fetch.php">存取</a></li>
            <li style="background-color:#CD3278"><a href="memcache/delete.php">删除</a></li>
            <li style="background-color:#848484"><a href="memcache/replace.php">更新</a></li>
            <li style="background-color:#8EE5EE"><a href="memcache/close.php">关闭</a></li>
        </ul>
    </div>

    <div class="clear"></div>

    <h1>Redis</h1>
    <div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a href="redis/index.php">介绍</a></li>
            <li style="background-color:#698B22"><a href="redis/index.php">安装</a></li>
            <li style="background-color:#8B6914"><a href="redis">使用</a></li>
            <li style="background-color:#CDCD00"><a href="redis"></a></li>
        </ul>
    </div>

    <div class="clear"></div>

    <h1>数据缓存</h1>
    <div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a href="#"></a></li>
            <li style="background-color:#698B22"><a href="#"></a></li>
            <li style="background-color:#8B6914"><a href="#"></a></li>
            <li style="background-color:#CDCD00"><a href="#"></a></li>
            <li style="background-color:#848484"><a href="#"></a></li>
            <li style="background-color:#8EE5EE"><a href="#"></a></li>
        </ul>
    </div>

    <div class="clear"></div>

    <h1>页面缓存</h1>
    <div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a href="#"></a></li>
            <li style="background-color:#698B22"><a href="#"></a></li>
            <li style="background-color:#8B6914"><a href="#"></a></li>
            <li style="background-color:#CDCD00"><a href="#"></a></li>
            <li style="background-color:#848484"><a href="#"></a></li>
            <li style="background-color:#8EE5EE"><a href="#"></a></li>
        </ul>
    </div>

    <div class="clear"></div>

    <h1>其它</h1>
    <div align="center">
        <ul>
            <li style="background-color:#FF7F24"><a href="#">时间触发缓存、内容触发缓存</a></li>
            <li style="background-color:#698B22"><a href="#">静态缓存</a></li>
            <li style="background-color:#8B6914"><a href="#">php的缓冲器</a></li>
            <li style="background-color:#CDCD00"><a href="#">MYSQL缓存</a></li>
            <li style="background-color:#848484"><a href="#">基于反向代理的Web缓存</a></li>
            <li style="background-color:#8EE5EE"><a href="#">DNS轮询</a></li>
        </ul>
    </div>
</body>
</html>