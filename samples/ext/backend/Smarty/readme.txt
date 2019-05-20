Smarty 3.1

1、初始化
require 'Smarty.class.php';
$smarty = new Smarty();
//Smarty自编口诀：五配置两方法
// 五配置
$smarty->left_delimiter = '{';// 左定界符
$smarty->right_delimiter = '}';// 右定界符
$smarty->template_dir = 'tpl';// html模板地址
$smarty->compile_dir = 'template_c';// 模板编译生成的文件（能让php脚本编译的）
$smarty->cache_dir = 'cache';// 缓存（数据库查询、临时数据）
// 以下是开启缓存的两个必要配置。通常不用smarty的缓存机制。
// $smarty->caching = true;// 开启缓存
// $smarty->cache_lifetime = 60;//缓存时间
// 两方法
$smarty->assign('str','str');
$smarty->assign('arr',array('name'=>'lothar','age'=>12));
$smarty->assign('arr3',array(array(10,20),2));
$smarty->display('sm.htm');
// HTML 文件
sm.htm
{$str}
{$arr.name}	{$arr.age}
{$arr['name']}	{$arr[age]}
{$arr3[0][1]}  {$arr3[1]}


2、注释
{*注释*}

3、变量调节器
(1)首字母大写
    {$title|capitalize}
(2)字符串拼接 cat
    {$title|cat:" ok."}
(3)日期格式化 date_format	感觉真不如php的date()函数
    {$date|date_format}
    {$date|date_format:" :"%A,%B %e,%Y %H:%M:%S"}
    {$date|date_format:"%A,%B %e,%Y %H:%M:%S"}
    {$date|date_format:"%H:%M:%S"}
    {$date|date_format:":"%Y-%m-%d %H:%M:%S"}
    %Y年%B月%e日%H时%M分%S秒
    %Y十进制年，%m十进制月，%d十进制日，%H十进制时，%M十进制分，%S十进制的秒。注意大小写
    和PHP中的 strftime()函数基本上相同
(4)变量值为 empty 时为变量赋默认值 default
    {$title|default:'no title'}
（5）转码escape
    用于html转码，url转码，在没有转码的变量上转换单引号，十六进制转码，十六进制美化，或者JavaScript转码。默认是html转码。
（6）小写lower 大写upper
    {$title|lower}	{$title|upper}
（7）所有的换行符将被替换成<br> nl2br功能同PHP的nl2br()函数一样
    {$title|nl2br}
（8）
（9）
    原则上少用smarty函数，例如：
    Wordwrap行宽，使用css样式解决；
    truncate截取，用php函数或css样式来解决

4、条件判断
（1）基本句式
    {if $a eq 1}
    {elseif $a eq 2}
    {else}
    {/if}
（2）条件修饰符
    eq	==
    neq	!=
    gt	>
    lt	<
（3）修饰符必须左右空格

5、循环遍历
（1）section,sectionelse 功能多，但不好
    具体属性：
    name	
    loop	
    start	循环执行的初始位置，负数表示从末尾算起
    step	循环步长，step=2,则只遍历下标为0,2,4
    max	最大循环次数
    show	是否显示该循环
    {section loop=$lists name=user}
        {$lists[user].id}
        {$lists[user].name}
    {sectionelse}
        暂无……
    {/section}
（2）foreach,foreachelse 类似php的写法
    {foreach from=$arr key=k item=v}
        {$v.id}
        {$v.name}
    {foreachelse}
        暂无……
    {/foreach}
    // Smarty3.0的写法
    {foreach $arr as $v}{/foreach}

6、文件引用，可以附带自定义变量
    include 
    {include file='header,tpl'}
    {include file='header,tpl' sn='into header'}
    // 在header.tpl 文件中
    {$sn}

7、类与对象的赋值与使用
    类的调用方法：
    （1）register_object，在Smarty3.0里已废除
    （2）用assign赋值类、对象
    $myobj = new Obj();
    $smarty->assign('myobj',$myobj);
    {$myobj->method()}

8、使用php内置函数和自定义函数,
    （1）PHP函数，|前传的是第一个参数，|后紧邻php函数，:后接第二、第三、第四……参数（每个参数前加:）
    $smarty->assign('time',time());
    错误写法：{$time|date:"Y-m-d"}
    正确写法：{"Y-m-d"|date:$time}
    {'search'|str_replace:'replace':$str}
（2）自定义 registerPlugin('体类型','在smarty里的名','php里的函数名')
    function test($params){
        print_r($params);die;
        $p1 = 'p1='.$params['p1'];
        $p2 = 'p2='.$params['p2'];
        // echo $p1.'，'.$p2;
        return $p1.'，'.$p2;
    }
    $smarty->registerPlugin('function','f','test');
    {f p1='a' p2='B'}

9、Smarty插件  插件名不能重复
（1）function 函数插件
（2）modifiers 修饰插件
（3）block function 区块函数插件
使用：
（1）使用registerPlugin
（2）php内置函数
（3）写好插件放入Smarty的lib目录下的plugin里
    <?php
    function smarty_function_test($params){
        $a = $params['a'];
        $b = $params['b'];
        return $a*$b;
    }
    ?>
    {test a=1 b=2}
    <?php
    function smarty_modifier_test($a,$b='Y-m-d H:i:s'){
        return date($b,$a);
    }
    ?>
    {$time|test:'Y-m-d'}
    <?php
    function smarty_block_test($params,$str){
        $r = $params['r'];
        $max = $params['max'];
        if($r){
            $str = str_replace('，',',',$str);
            $str = str_replace('。','.',$str);
        }
        return substr($str,0,$max);
    }
    ?>
    {test r='true' max=2}
    {$str}
    {/test}

10、借鉴Smarty设计MVC实例制作
function.php文件
/** 调用第三方类库
* $path 路径
* $name 第三方类名
* $params 参数
*/
function ORG($path, $name, $params=array()) {
    require_once('lib/ORG/'.$path.$name.'.class.php');
    // eval('$obj = new '.$name.'();');
    $obj = new $name();
    if(!empty($params)){
        foreach($params as $key=>$val){
            // eval('$obj->'.$key.'=\''.$val.'\';');
            $obj->$key = $val;
        }
    }
    return $obj;
}
调用文件
<?php
require_once 'function.php';
$view = ORG('Smarty/','Smarty',array('left_delimiter'=>'{','right_delimiter'=>'}','template_dir'=>'tpl','compile_dir'=>'template_c'));
$controller = $_GET['ctrl'];
$method = $_GET['mod'];
C($controller,$method);
?>


 
