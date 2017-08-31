<?php 
header('Content-Type:text/html;charset=UTF-8');
require_once 'config.php';
require_once 'rbac.class.php';
/** mysqli查询
$result = $dbi->query('select part,mfg_part,price from ic_product where id<10');
// $result = $dbi->query('select count(*) from ic_product');
// $result = $dbi->query('select SQL_CALC_FOUND_ROWS id from dbi_user');

// 对结果集进行处理
// $rows = $result->fetch_row();// 这种写法，呵呵
// $rows = $result->fetch_assoc();
// $rows = $result->fetch_array(MYSQLI_NUM);
// $rows = $result->fetch_object();
// $rows = $result->fetch_all(MYSQLI_ASSOC);// MYSQLI_BOTH;MYSQLI_ASSOC;默认:MYSQLI_NUM;如果fetch_all不可用，则可用循环的形式获取结果集中所有记录
if ($result && $result->num_rows>0) {
  while ($row=$result->fetch_assoc()) {
    $rows[] = $row;
  }
}
*/
/**
foreach($attr as $v) {
    $str .= implode('^',$v).'|';// 当count($v)==1时，implode('^',$v)相当于$v[0]或$v['mid']
    // $str .= $str?'|'.$v[0]:$v[0];// 不建议在循环体内做判断
}
*/
// $query = $db->query($sql);
// $res = $query->fetch_all();
// echo "http://tx.ext6<br>";
// print_r($_SERVER);


$rbac = new RBAC($db);
$is_access = $rbac->__access_check();
debug($is_access);

?>