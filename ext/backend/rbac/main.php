<?php
header('Content-Type:text/html;charset=UTF-8');
require_once 'config.php';

if(empty($_SESSION["uid"])) {
    header("location:login.php");exit;
}

//登录者
$uid = $_SESSION["uid"];

//根据用户名查角色
$sql = "select jueseid from qx_uij where useid='{$uid}'";
$query = $db->query($sql);
$ajs = $query->fetch_all();

//定义一个存放功能代号的数组
$arr = array();
//根据角色代号查功能代号
foreach($ajs as $vjs) {
    $jsid = $vjs[0]; //角色代号
    $sql = "select ruleid from qx_jwr where jueseid='{$jsid}'";
    $r = $db->query($sql);
    $attr = $r->fetch_all();
    $str = '';
    foreach($attr as $v) {
        $str .= implode('^',$v).'|';
    }
    $strgn = substr($str,0,strlen($str)-1);// 删掉最后一个 '|'

    $agn = explode('|',$strgn);
    foreach($agn as $vgn) {
        array_push($arr,$vgn);
    }    
}

//去重，显示
$arr = array_unique($arr);
// debug($arr,1);
foreach($arr as $v) {
    $sql = "select code,name from qx_rules where code='{$v}'";
    $r = $db->query($sql);
    // $attr = $r->fetch_all();
    $attr = $r->fetch_all(MYSQL_ASSOC);
    // $attr_code = iconv('gb2312', 'utf-8', $attr[0][0]);
    // $attr_name = iconv('gb2312', 'utf-8', $attr[0][1]);
    foreach ($attr as $val) {
        $val['name'] = iconv('gb2312','utf-8',$val['name']);
        $rules[] = $val;
    }
}
// debug($rules,1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>主页面</title>
</head>

<body>
    <h1>主页面&nbsp;&nbsp;&nbsp;&nbsp;<a href="loginout.php">注销</a></h1>

    <div></div>
    <div>
        <?php foreach ($rules as $v): ?>
        <div code="<?php echo $v['code'] ?>"><?php echo $v['name'] ?></div>
        <?php endforeach ?>
    </div>

</body>
</html>