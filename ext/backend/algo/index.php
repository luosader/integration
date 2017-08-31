<?php 
/*
http://blog.csdn.net/kirsten_z/article/details/52515573
http://blog.csdn.net/qishouzhang/article/details/47208843
*/
require_once 'config.php';
$attr = '';
$algorithm = array(
        array(
            'name'  => '四种基础排序算法',
            'sub' => array(
                    array('href'=>'base.php?rec=pao','name'=>'冒泡排序','attr'=>$attr),
                    array('href'=>'base.php?rec=sel','name'=>'选择排序','attr'=>$attr),
                    array('href'=>'base.php?rec=ist','name'=>'插入排序','attr'=>$attr),
                    array('href'=>'base.php?rec=quik','name'=>'快速排序','attr'=>$attr),
                ),
            ),
        array(
            'name'  => '常用查找算法',
            'sub' => array(
                    array('href'=>'search.php?rec=binary','name'=>'二分法','attr'=>$attr),
                    array('href'=>'search.php?rec=sq','name'=>'顺序查找','attr'=>$attr),
                ),
            ),
        array(
            'name'  => '常用数据结构',
            'sub' => array(
                    array('href'=>'data_structure.php?rec=dae','name'=>'线性表的删除','attr'=>$attr),
                    array('href'=>'chain_table.php?rec=show','name'=>'拟链表的基本操作','attr'=>$attr),
                    array('href'=>'Stack.php?rec=show','name'=>'模拟顺序栈的基本操作','attr'=>$attr),
                    array('href'=>'Deque.php?rec=show','name'=>'双向队列','attr'=>$attr),
                    array('href'=>'data_structure.php?rec=ysf','name'=>'约瑟夫环问题','attr'=>$attr),
                ),
            ),
        array(
            'name'  => 'PHP模拟链表的基本操作',
            'sub' => array(
                    array('href'=>'chain_table.php?rec=createHead','name'=>'头插法创建链表','attr'=>$attr),
                    array('href'=>'chain_table.php?rec=createTail','name'=>'尾插法创建链表','attr'=>$attr),
                    array('href'=>'chain_table.php?rec=insert','name'=>'在指定位置插入指定元素','attr'=>$attr),
                    array('href'=>'chain_table.php?rec=delete','name'=>'删除指定位置的元素','attr'=>$attr),
                    array('href'=>'chain_table.php?rec=show','name'=>'输出链表数据','attr'=>$attr),
                ),
            ),
        array(
            'name'  => '用PHP模拟顺序栈的基本操作',
            'sub' => array(
                    array('href'=>'Stack.php?rec=push','name'=>'入栈','attr'=>$attr),
                    array('href'=>'Stack.php?rec=pop','name'=>'出栈','attr'=>$attr),
                    array('href'=>'Stack.php?rec=show','name'=>'打印栈','attr'=>$attr),
                ),
            ),
        array(
            'name'  => '使用PHP实现双向队列',
            'sub' => array(
                    array('href'=>'Deque.php?rec=addFirst','name'=>'头入队','attr'=>$attr),
                    array('href'=>'Deque.php?rec=addLast','name'=>'尾入队','attr'=>$attr),
                    array('href'=>'Deque.php?rec=removeFirst','name'=>'头出队','attr'=>$attr),
                    array('href'=>'Deque.php?rec=removeLast','name'=>'尾出队','attr'=>$attr),
                    array('href'=>'Deque.php?rec=ist','name'=>'打印','attr'=>$attr),
                ),
            ),
        array(
            'name'  => '其它',
            'sub' => array(
                    array('href'=>'more.php?rec=file_ext','name'=>'从一个标准url中取出文件的扩展名','attr'=>$attr),
                    array('href'=>'more.php?rec=scandir','name'=>'遍历所有目录、文件','attr'=>$attr),
                ),
            ),
    );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP 四大算法</title>
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT_HOST . SOUR_COM .'css/common.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT_HOST . SOUR_COM .'css/block.css' ?>">
</head>

<body>
    <?php foreach ($algorithm as $val) : ?>
        <h1><?php echo $val['name'] ?></h1>
        <div align="center">
            <ul>
                <?php foreach ($val['sub'] as $v): ?>
                    <li <?php echo $v['attr'] ?> style="background-color: <?php echo randColor() ?>">
                    <a href="<?php echo $v['href'] ?>"><?php echo $v['name'] ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="clear"></div>
    <?php endforeach; ?>
    <div style="height: 100px;"></div>
</body>
</html>