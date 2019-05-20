<?php 
require_once 'config.php';

switch ($rec) {
    case 'file_ext':
        debug('思路：​');
        // 高效的从一个标准url中取出文件的扩展名
        function getExt($url)
        {
            $arr = parse_url($url);//parse_url解析一个 URL 并返回一个关联数组，包含在 URL 中出现的各种组成部分
            //'scheme' => string 'http' (length=4)
            //'host' => string 'www.sina.com.cn' (length=15)
            //'path' => string '/abc/de/fg.php' (length=14)
            //'query' => string 'id=1' (length=4)
            $file = basename($arr['path']);// basename函数返回路径中的文件名部分
            $ext = explode('.', $file);
            return $ext[count($ext)-1];
        }
 
        debug(getExt('http://www.sina.com.cn/abc/de/fg.html.php?id=1'));
        break;

    case 'scandir':
        debug('思路：​');
        // 遍历一个文件下的所有文件和子文件夹
        function my_scandir($dir) {
            $files = array();
            if($handle = opendir($dir)) {
                while (($file = readdir($handle))!== false)  {
                    if($file != '..' && $file != '.') {
                        if(is_dir($dir."/".$file)) {
                            $files[$file]=my_scandir($dir."/".$file);
                        } else {
                            $files[] = $file;
                        }
                    }
                }
                closedir($handle);
                return $files;
            }
        }
        debug(my_scandir('../'),'',true);
        break;
}
?>