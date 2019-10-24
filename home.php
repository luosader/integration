<?php 
// 列表初始化
$attr = '';// 额外共用属性
// 菜单 , 可用的分隔符 < > | \ / : * ? " 
$subject = 
        '支付:{p},支付宝;{p},微信;{p},网银在线;{p},财付通;{p},QQ钱包;{p},京东支付;{p},易宝|'.
        '提现:{w}alipay,支付宝;{w}weixin,微信;{w},网银在线;{w},财付通;{w},QQ钱包;{w},易宝|'.
        '授权:{o},微信;{o},QQ;{o},新浪;{o},淘宝;{o},身份认证;{o}zhima,芝麻信用;{o},人人网;{o},战旗|'.
        '消息:msg,消息;#,美洽;{m}yunpian,云片短信;{m}chonry,创瑞;{m}alidayu,阿里大于;{m},短信宝;{e},QQ邮箱;{e},新浪邮箱|'.
        '常用插件:{pl}ValidForm/demo.html,前端验证;{pl}Ueditor/ueditor.php,富文本;{pl}ganged,联动;{pl}My97DatePicker,日期时间;{pl}laydate,日期时间2;{pl}office,Excel等;{pl}JiaThis/JiaThis.php,分享;{pl}graph,图表;{pl}Map,地图;{pl}translate,翻译|'.
        '快递:shipping/kuaidi100,快递100;#,圆通速递;#,EMS|'.
        '多媒体:{pm}Huploadify,H5上传;{pm}preview/1,上传图片预览;{pm}preview/2,点击放大;{pm}canvas,JS压缩;{pm}Slice/slice.html,切片处理;{pm}CkPlayer/ckplayer6.8/demo2.htm,CkPlayer;{pm}shearphoto2.3,shearphoto2.3|'.
        '云存储:cloudstorage/qcloud/sample.php,腾讯云;#,七牛云;#,阿里云;#,百度云;#,网易云|'.
        '标准件:{s}idus/list.php,增删改查（列表/单页）;#,CheckBox;{s}category,无限分类;{s}Permission/power.php,权限管理;#,数据库操作;{s}sku,商品SKU;{s}cache,缓存应用|'.
        '拓展后端:{eb}rbac,RBAC;{eb}Smarty/readme.txt,Smarty引擎;#,三级分销;#,家谱图;#,步骤引导;#,消息队列;{eb}algo,算法;{eb}zip,压缩;ext/part,小零件|'.
        '拓展前端:#,HTML通用;#,artTemplate引擎;#,AngularJS(前端框架);{ef}JqueryMultiselect/demo.htm,下拉多选;#,zclip;{ef}lazyload/demo.htm,懒加载;{ef}game,游戏|'.
        '资源:source/lib,常用类库;source/js,常用JS;#,网站模板'
    ;
$search = array('{p}','{w}','{o}','{m}','{e}','{pl}','{pm}','{s}','{eb}','{ef}');
// samples/
$replace = array('samples/payment/','samples/withdraw/','samples/oauth/','samples/msg/sms/','samples/msg/email/','plugin/','plugin/media/','samples/standard/','samples/ext/backend/','samples/ext/frontend/');
$arrMenu = menuList($subject,$search,$replace,$attr,1);
debug($arrMenu,1);

/*$arrMenu = array(
        array(
            'href'  => '#','name'  => '支付',
            'ico'   => '1','tag'   => '1','attr'  => $attr,
            'sub' => array(
                    array('href'=>'payment/','name'=>'支付宝','attr'=>$attr),
                    array('href'=>'payment/','name'=>'微信','attr'=>$attr),
                    array('href'=>'payment/','name'=>'网银在线','attr'=>$attr),
                    array('href'=>'payment/','name'=>'财付通','attr'=>$attr),
                    array('href'=>'payment/','name'=>'QQ钱包','attr'=>$attr),
                    array('href'=>'payment/','name'=>'易宝','attr'=>$attr),
                ),
            ),
    );
print_r($arrMenu);*/

// include_once 'home.html';
?>