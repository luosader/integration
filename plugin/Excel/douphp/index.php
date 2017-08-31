<?php 
require_once '../../source/init_base.php';
require_once SOUR_EXCEL.'excel.class.php';

// 判断是否安装会员导出功能
if (file_exists($excel_file = ROOT_PATH . ADMIN_PATH . '/include/phpexcel/excel.class.php')) {
    include_once($excel_file);
    $excel = new Excel();
}

if (is_array($_POST['checkbox'])) {
    if ($_POST['action'] == 'del_all') { // 批量删除会员
        $dou->del_all('user', $_POST['checkbox'], 'user_id');
    } elseif ($_POST['action'] == 'excel') { // 导出所选会员
        $excel->export_excel('user', excel_user_list($_POST['checkbox']));
    } else {
        $dou->dou_msg($_LANG['select_empty']);
    }
} else {
    if ($_POST['action'] == 'excel_all') { // 导出所有
        $excel->export_excel('user', excel_user_list());
        exit;
    }
    
    $dou->dou_msg($_LANG['user_select_empty']);
}

/**
 * +----------------------------------------------------------
 * 导出的会员的订单数据
 * +----------------------------------------------------------
 * $checkbox 所选的会员条目
 * +----------------------------------------------------------
 */
function excel_order_list($checkbox = '') {
    // 需要导出的字段
    $field = array('email', 'nickname', 'telephone', 'contact', 'address', 'postcode', 'sex');
    
    // 导出的字段名称
    foreach ((array) $field as $value) {
        $excel_list['head'][] = $GLOBALS['_LANG']['user_' . $value];
    }
    
    // 导出列表
    if ($checkbox) $where = " WHERE user_id IN (" . implode(',', $checkbox) . ")";
    $sql = "SELECT * FROM " . $GLOBALS['dou']->table('user') . $where . " ORDER BY user_id DESC";
    $query = $GLOBALS['dou']->query($sql);
    while ($user = $GLOBALS['dou']->fetch_array($query)) {
        // 格式化数据
        $user['sex'] = $user['sex'] ? $GLOBALS['_LANG']['user_man'] : $GLOBALS['_LANG']['user_woman'];
        
        unset($list);
        foreach ((array) $field as $value) {
            $list[] = $user[$value];
        }
        $excel_list['list'][] = $list;
    }
    
    return $excel_list;
}
?>