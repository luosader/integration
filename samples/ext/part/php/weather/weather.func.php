<?php 
function get_weather($url, $pattern='')
{
    /*CURL GET方式*/
    //初始化CURL
    $ch = curl_init();
    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);// 0直接显示在屏幕 1保存
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //执行并获取HTML文档内容
    $fdata = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);

    //处理获得的数据
    if (stripos($fdata,'您要找的页面不在地球上或者版权问题已经被删除')) { return false; }
    // print_r($fdata);
    // file_put_contents('cssmoban.htm', $fdata);
    // $fdata = file('cssmoban.htm');
    // $fdata = file_get_contents('cssmoban.htm');

    // 正则匹配
    // preg_match(pattern, subject);
    // preg_match_all(pattern, subject, matches);
    // $fdata = str_replace('  ', '', $fdata);
    $num = preg_match($pattern, $fdata, $html);
    return $html;
}
?>