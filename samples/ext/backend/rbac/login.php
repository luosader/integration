<?php
header('Content-Type:text/html;charset=UTF-8');
require_once 'config.php';

$name = $_POST["name"];
$pwd = $_POST["pwd"];

$sql="select uid,pwd from qx_user where name='{$name}'";
$query = $db->query($sql);
$info = $query->fetch_assoc();

if(!empty($pwd) && $info['pwd']==$pwd) {
    $_SESSION['uid'] = $info['uid'];
    header("location:main.php");exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>登录页面</title>
</head>

<body>
    <h1>登录页面</h1>
    <form action="" method="post">
        <input type="text" name="name" />
        <input type="password" name="pwd" value="123456" />
        <input type="submit" value="登录" />
    </form>
</body>
</html>