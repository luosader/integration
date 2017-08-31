<?php 
require_once '../../../../source/init.php';
/*
 * 文本相似度
 * 图片相似度
 * 听歌识曲
*/

debug('文本相似度');
debug('<hr>similar_text：');
/*
similar_text() 函数主要是用来计算两个字符串的匹配字符的数目，也可以计算两个字符串的相似度（以百分比计）。
*/
$first = "abcdefg"; 
$second = "aeg";
debug(similar_text($first, $second));
// 结果输出3.如果想以百分比显示，则可使用它的第三个参数,如下： 
similar_text($first, $second, $percent); 
debug($percent);
// 不过这个函数感觉对中文计算很不准确
$res = similar_text("吉林禽业公司火灾已致112人遇难","吉林宝源丰禽业公司火灾已致112人遇难");
debug($res);

/*
levenshtein(str1, str2) 函数返回两个字符串之间的 Levenshtein 距离。
*/
debug('<hr>levenshtein：');
debug(levenshtein("Hello World","ello World"));
debug(levenshtein("Hello World","ello World",10,20,30));

require_once 'LCS.class.php';
$lcs = new LCS();
//返回最长公共子序列
$lcs->getLCS("hello word","hello china");
//返回相似度
debug($lcs->getSimilar("吉林禽业公司火灾已致112人遇难","吉林宝源丰禽业公司火灾已致112人遇难"));
debug('同样输出结果为：0.90322580645161，明显准确的多。');



debug('<hr>图片相似度：');
require_once "ImageHash.class.php";
// $res = ImageHash::isImageFileSimilar('chenyin/IMG_3214.png', 'chenyin/IMG_3212.JPG');
// debug($res);


debug('<hr>音频相似度对比');
// require_once 'file';
debug('基本思路和流程
1. 录音，保存音频数据
2. 从二进制文件中获取音频原始数据
3. 音频滤波
4. 计算音频信号短时能量
5. 截取音频信号有效数据
6. 对对比音频数据进行同上操作
7. 计算标准音频与对比音频数据的余弦距离');



debug('<hr>PHP处理海量样本相似度聚类算法');
debug('http://www.cnblogs.com/LittleHann/p/5737765.html');

?>