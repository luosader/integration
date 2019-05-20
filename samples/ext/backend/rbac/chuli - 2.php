<?php
header('Content-Type:text/html;charset=UTF-8');
require_once 'config.php';
// D:\WWW\_svn\_op\opcore\lib\Database\DBDAClass.php

$type = $_POST["type"];

switch($type)
{
    case 0:
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

    case 1:
        $uid = $_POST["uid"];
        $juese = $_POST["juese"];
        // $sdel = "delete from qx_uij where useid='{$uid}'";
        // $db->query($sdel);
        if ($uid) {
            $res = $db->query("SELECT jueseid from qx_uij where useid={$uid}")
            $rows = $res->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $key => $value) {
                $ids .= $ids ? ','.$value : $value;
            }
        }
        
        $arr = explode("|",$juese);
        $ids = explode(',', $ids);
        $diff = array_diff($arr, $ids);
        foreach($arr as $v) {
            $res = $db->query("SELECT ids from qx_uij where useid={$uid} and jueseid={$v}");
            $num = $res->num_rows;
            if (empty($num)) {
                $sql = "insert into qx_uij values ('','{$uid}','{$v}')";
                $db->query($sql);
                echo $v;
            } else {
                if ($diff) {
                    # code...
                }
            }
        }
        // echo "OK";
        break;
}
?>