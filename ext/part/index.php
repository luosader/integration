<?php 
require_once '../../source/init.php';
debug('小零件');
$subject = 
        'HTML:#,登录注册;#,导航;#,菜单栏;#,面包屑;#,底部;#,回到顶部;#,底部;#,数据分页;#,列表页;#,详情页;#,单页;#,搜索页;#,留言板;#,友情提示;#,引导页;#,字符实体;#,special|'.
        'CSS:#,default;#,浏览器兼容;#,手机站;#,网站控制;#,视频控制;#,图片控制;#,文本处理;#,滚动条;#,列表页常用;#,字体图标;#,placeholder;#,斜角阴影|'.
        'JS:#,ajax;#,eq;#,each;#,打印|'.
        'PHP:{p}X-plore,文件管理系统;{p}search,全站/盘搜索;{p}count,统计;{p}verify,验证相关;{p}pscws4.php,中文分词;{p}serialize.php,序列化;{p}similar,相似度;#,定时器;{p}exec.php,执行系统命令;{p}uniqid.php,唯一ID|'.
        'MYSQL:/source/common/lib,常用类库;{m},优化;{m},异常处理|'.
        'SHELL:#,常用'
    ;
$search = array('{p}','{m}');
$replace = array('php/','mysql/');
$arrMenu = MenuList($subject,$search,$replace);
debug($arrMenu,1);
?>