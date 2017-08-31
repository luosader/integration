<?php
define('IN_DOUCO', true);
require (dirname(__FILE__) . '/include/init.php');
    $pro_list = $dou->fetchAll("SELECT cat_id FROM ".$dou->table('product'));
    $ids = array();
    foreach ($pro_list as $value) {
        $ids[] = $value['cat_id'];
    }
    $ids = array_unique($ids);

    $data = array();
    foreach ($ids as $value) {
        getpids($value,$data,$dou);
    }

    print_r($data);


    
    function getpids($id,&$data,$dou){
        $child = $dou->fetchRow("SELECT parent_id FROM ".$dou->table('product_category')." WHERE cat_id=".$id);
        if($child['parent_id']!=0){
            getpids($child['parent_id'],$data,$dou);
        }else{
            $data[] = $id;
        }
    }

?>