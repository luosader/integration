<?php
require_once '../../../source/init.php';
debug('执行系统命令');

// `dir/b e:\\video` 这一句表示执行系统命令 dir,列出e:\\video 目录下的文件列表，每个文件名一行，以换行分隔;这里的 ` (键盘上Esc键下面那个键)，在php里表示执行外部命令。

$s=explode("\n",trim(`dir/b E:\\WXS`));
print_r($s);

// $s=explode("\n",trim(`dir/b e:\\`));
// print_r($s);

// 执行Window命令
// exec();
// execute();
?>
