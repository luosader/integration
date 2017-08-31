<?php 
require_once '../../source/init_base.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>接口测试</title>
    <script type="text/javascript" src="<?php echo OPJS ?>jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="laydate.js"></script>
</head>
<body>
<div>
    <p>开始日：</p><input name="start" class="inline laydate-icon" id="start">
    <p>结束日：</p><input name="end" class="inline laydate-icon" id="end" >
    <script type="text/javascript" src="laydatedefine.js"></script>
</div>
</body>
</html>