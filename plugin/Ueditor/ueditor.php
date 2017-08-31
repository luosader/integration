<?php 
require_once './../../source/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>富文本编辑器 - Ueditor</title>
</head>

<body>
<script type="text/javascript" src="<?php echo OPJS ?>jquery-1.11.3.min.js"></script>
<script>
	//项目所在路径，在引入script脚本前声明并复制就可以正常使用了。
	// window.UEDITOR_HOME_URL = 'ueditor/';
	var UEDITOR_HOME_URL = 'ueditor/';
</script>

<!-- 配置文件 -->
<script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
<!-- 编辑器核心源码文件 -->
<script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>

<script type="text/javascript">
	//实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('container')就能拿到相关的实例
    // var ue = UE.getEditor('container');
	//实例化编辑器时传入配置参数
	var ue = UE.getEditor('container', {
		toolbars: [[ 'source', 'undo', 'redo', 'bold','italic','|','pasteplain','forecolor', 'backcolor','|','simpleupload', 'insertimage', 'emotion']],
		initialFrameWidth:'80%',		//初始化编辑器宽度,默认1000
		initialFrameHeight:400,			//初始化编辑器高度,默认320
		autoHeightEnabled:false,		//自动长高
		elementPathEnabled:false,		//是否启用元素路径，默认是显示
		iframeCssUrl: UEDITOR_HOME_URL+'themes/iframe.css',//自定义样式,UEDITOR_HOME_URL为最开始声明的
		indentValue:'2em',				//首行缩进距离
		wordCount:true,         		//是否开启字数统计
		maximumWords:10000,       		//允许的最大字符数

		//customstyle
		//自定义样式，不支持国际化，此处配置值即可最后显示值
		//block的元素是依据设置段落的逻辑设置的，inline的元素依据BIU的逻辑设置
		//尽量使用一些常用的标签
		//参数说明
		//tag 使用的标签名字
		//label 显示的名字也是用来标识不同类型的标识符，注意这个值每个要不同，
		//style 添加的样式
		//每一个对象就是一个自定义的样式
		//,'customstyle':[
		//    {tag:'h1', name:'tc', label:'', style:'border-bottom:#ccc 2px solid;padding:0 4px 0 0;text-align:center;margin:0 0 20px 0;'},
		//    {tag:'h1', name:'tl',label:'', style:'border-bottom:#ccc 2px solid;padding:0 4px 0 0;margin:0 0 10px 0;'},
		//    {tag:'span',name:'im', label:'', style:'font-style:italic;font-weight:bold'},
		//    {tag:'span',name:'hi', label:'', style:'font-style:italic;font-weight:bold;color:rgb(51, 153, 204)'}
		//]
	});
</script>

<!-- 加载编辑器的容器 -->
<!--style给定宽度可以影响编辑器的最终宽度-->
<script type="text/plain" id="container" name="content" style="max-width:1024px;max-height:500px;">
    <p>在这里填写内容……</p>
</script>
<!-- <script type="text/plain" id="container" name="{if $f[field]}{$f[field]}{elseif $uekey}{$uekey}{else}details{/if}" style="max-width:1024px;max-height:500px;">
    <p>{if $f[field]}{$page[$f[field]]}{elseif $uekey}{$page[$uekey]}{else}{$page[details]}{/if}</p>
</script> -->
</body>
</html>