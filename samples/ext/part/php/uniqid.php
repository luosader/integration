<?php
require_once '../../../source/init.php';
debug('uniqid');

// php生成GUID(全球唯一标识符)方法解析

// _check_uniqid(str1,str2):函数的作用是判断两个数(字符串)是否相同,如果不同就退出
// ============================================
$act = isset($_GET['act'])?$_GET['act']:'';
if ($act == 'register') {
    $_clean = array();
    // $_clean['uniqid'] = _check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
    print_r($_clean);
} else {
    $_SESSION['uniqid'] = $_uniqid =md5(uniqid(rand()));//这行代码写在这里或者写在下边(总之是写在提交内容之后的地方)
    echo uniqid();// 随机数
}
//$_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
?>
<form method="post" name="register" action="index.php?act=register">
    <input type="hidden" name="uniqid" value="<?php echo $_uniqid ?>" />
    <input type="hidden" name="submit" value="1">
    <button type="submit">提交</button>
</form>