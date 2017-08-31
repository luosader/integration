<?php 
require_once '../../source/init_base.php';
require_once SOUR_EXCEL.'excel.class.php';

/**
 * +----------------------------------------------------------
 * 导出的接口数据
 * +----------------------------------------------------------
 * title excel标题
 * head th头信息
 * list tr信息
 * +----------------------------------------------------------
 */
function excel_api_list($id, $Scode, $limit='', $where='', $fields='&fields=') {
    $limit = $limit ? '&top='.$limit : '&top=20';

    /* if (!empty($where)) {
        $tj = '';
        foreach ($where as $v) {
            if ($v) {
                $tj .= stripcslashes($v);
            }
        }
        // $tj = strrev($tj);
        $where = $tj ? '&where='.substr($tj,0,-3) : '';
    } */
    if ($where) {
        $where = (array)$where;
        // $last = count($where['r']);
        $wh = array();
        foreach ($where['f'] as $k => $v) {
            if ($v) {
                $wh[$k] = $v.' ';
            }
        }
        foreach ($where['o'] as $k => $v) {
            if ($wh[$k]) {
                $wh[$k].= $v.' ';
            }
        }
        foreach ($where['v'] as $k => $v) {
            if ($v) {
                if (is_numeric($v)) {
                    $wh[$k].= $v.' ';
                } elseif (strpos('^'.$wh[$k],' like')) {
                    $wh[$k].= "'%".$v."%' ";
                } elseif (strpos('^'.$wh[$k],' in')) {
                    $wh[$k].= '('.$v.') ';
                } else {
                    $wh[$k].= '\''.$v.'\' ';
                }
            }
        }
        foreach ($where['r'] as $k => $v) {
            if ($wh[$k]) {
                $wh[$k].= $v.' ';
            }
        }
        krsort($wh);
    }
    $where = '';
    foreach ($wh as $val) {
        $where .= $val;
    }
    $where = $where ? '&where='.substr($where,0,-4) : '';
    // return $where;
    
    $proinfo = $GLOBALS['dou']->fetchRow("SELECT name,price,url,resource FROM ".$GLOBALS['dou']->table('product')." WHERE id=".$id);
    $excel_list['title'] = $proinfo['name'];
    $excel_list['price'] = $proinfo['price'];
    foreach ((array)$Scode as $k => $v) {
        $key = $GLOBALS['dou']->apiresource($proinfo['resource'],$v,'key');
        // 导出的字段名称,生成表格标题栏内容
        $excel_list['head'][] = $key;
        if ($k==0) {
            $fields .= $v;
        } else {
            $fields .= ','.$v;
        }
    }

    $url = $proinfo['url'].$limit.$fields.$where;
    $url = str_replace(' ','%20',$url);
    $data = file_get_contents($url);

    // 处理json数据
    $json = $GLOBALS['dou']->obj_arr(json_decode($data));

    // 导出列表
    foreach ($json as $v) {
        foreach ($v as $key => $val) {
            $excel_list['list'][] = array_values($val);
        }
    }
    return $excel_list;
}
$TXT = excel_api_list($id, $Scode, $down, $where);

if (file_exists($excel_file)) {
    include_once $excel_file;
    $excel = new Excel();
}else{ 
    $dou->dou_msg('Excel类库不存在！',ROOT_URL,3,true);
}
$excel->export_excel('api', $TXT);exit;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>接口测试</title>
</head>
<body>
<div>()</div>
<div>()</div>
<div>()</div>
<div>()</div>
</body>
</html>