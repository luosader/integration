<?php
header('Content-Type:text/html;charset=UTF-8');
require_once 'config.php';
// D:\WWW\_svn\_op\opcore\lib\Database\DBDAClass.php

$mark = $_POST["mark"];

switch($mark) {
    case 1:
        $uid = $_POST["uid"];
        $sql = "select jueseid from qx_uij where useid='{$uid}'";
        $r = $db->query($sql);
        $attr = $r->fetch_all();
        $str = '';
        foreach($attr as $v){
            $str .= implode('^',$v).'|';
        }
        echo substr($str,0,strlen($str)-1);
        break;

    case 2:
        $uid = $_POST["uid"];
        $juese = $_POST["juese"];
        $sdel = "delete from qx_uij where useid='{$uid}'";
        $db->query($sdel);
        $arr = explode('|',$juese);
        foreach($arr as $v) {
            $sql = "insert into qx_uij values ('','{$uid}','{$v}')";
            $db->query($sql);
            echo $v;
        }
        // echo "OK";
        break;
}
?>