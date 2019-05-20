<?php
require_once 'init.php';

$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
switch ($rec) {
	case 'ajax':
		# code...
		break;
	
	default:
		$res = $db->query(sprintf('SELECT id,name,addtime,modtime,ip,is_rec,tpls FROM %s WHERE id=%d','ig_article',$id));
		$page = $res->fetch_assoc();
		// var_dump($page);
		break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>详情页</title>
</head>
<body>
	<div>
		<p>详情页：</p>
		<p>添加时间：<?php echo date('Y-m-d H:i:s',$page['addtime']) ?></p>
		<p>上次修改时间：<?php echo date('Y-m-d H:i:s',$page['modtime']) ?></p>
	</div>

	<div>
		<form action="add_edit.php" method="post">
			<label>标题：<input type="text" name="name" value="<?php echo $page['name'] ?>"></label><br>
			<label>IP：<input type="text" name="name" value="<?php echo $page['ip'] ?>"></label><br>
			状态：<label>隐藏：<input <?php if ($page['is_rec']==-1): ?>checked<?php endif ?> type="radio" name="is_rec" value="-1"></label>
				  <label>显示：<input <?php if ($page['is_rec']==0) {echo 'checked';} ?> type="radio" name="is_rec" value="0"></label>
				  <label>推荐：<input <?php if ($page['is_rec']==1): ?>checked<?php endif ?> type="radio" name="is_rec" value="1"></label><br>
			<input type="hidden" name="id" value="<?php echo $page['id'] ?>">
			<!-- <input type="submit" name="submit" value="提交"> -->
		</form>
	</div>
</body>
</html>

<?php include 'footer.php';?>