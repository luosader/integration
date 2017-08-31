<?php
header('Content-Type:text/html;charset=UTF-8');
require_once 'config.php';
// D:\WWW\_svn\_op\opcore\lib\Database\DBDAClass.php

$type = $_POST["type"];

switch($type) {
    case 0:
        $jid = $_POST["jid"];
        $sql = "select ruleid from qx_jwr where jueseid='{$jid}'";
        $r = $db->query($sql);
        $attr = $r->fetch_all();
        $str = '';
        foreach($attr as $v){
            $str .= implode('^',$v).'|';
        }
        echo substr($str,0,strlen($str)-1);
        break;

    case 1:
        $jid = $_POST["jid"];
        $rule = $_POST["rule"];
        $sdel = "delete from qx_jwr where jueseid='{$jid}'";
        $db->query($sdel);
        $arr = explode('|',$rule);
        foreach($arr as $v) {
            $sql = "insert into qx_jwr values ('','{$jid}','{$v}')";
            $db->query($sql);
            echo $v;
        }
        // echo "OK";
        break;
}
?>