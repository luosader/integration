<?php
require_once 'init.php';

// echo strtotime('2017-01-01');
// echo time();

switch ($rec) {
case 'ajax':
	# code...
	break;
case 'del':
	# code...
	break;

default:
	# list
	$res = $db->query(sprintf('SELECT id,name,addtime,ip,is_rec from %s','ig_article'));
	$rows = $res->fetch_all(MYSQLI_ASSOC);
	/*if ($res && $res->num_rows>0) {
	  while ($row=$res->fetch_assoc()) {
	    $rows[] = $row;
	  }
	}*/
	// print_r($rows);
	break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>列表页</title>
	<!-- <link rel="stylesheet" href="default.css" /> -->
</head>

<body>
	<div>
		<h2>搜索</h2>
		<form action="#" method="post">
			<div>
				<label for="select-choice">请选择类型:</label>
				<select name="select_choice" id="select-choice">
					<option value="Choice 1">Choice 1</option>
					<option value="Choice 2">Choice 2</option>
					<option value="Choice 3">Choice 3</option>
				</select>
			</div>
			<div>
				<label for="name">Text Input:</label>
				<input type="text" name="key" id="name" value="" tabindex="1" />
			</div>
			<div>
				<input type="submit" value="搜索" />
			</div>
		</form>
	</div>

	<div><p><a href="add_edit.php">新增</a></p></div>

	<div>
		<div><p>面包屑</p></div>
		<table>
			<thead>
				<tr>
					<th>编号</th>
					<th>标题</th>
					<th>日期</th>
					<th>IP</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($rows as $key => $v): ?>
				<tr>
					<td><?php echo $v['id'] ?></td>
					<td><?php echo $v['name'] ?></td>
					<td><?php echo date('Y-m-d H:i:s',$v['addtime']) ?></td>
					<td><?php echo $v['ip'] ?></td>
					<td><a href="page.php?id=<?php echo $v['id'] ?>">查看</a> <a href="add_edit.php?id=<?php echo $v['id'] ?>">修改</a> <a href="del.php?rec=recycle&id=<?php echo $v['id'] ?>">删除</a></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<div>数据分页：</div>
</body>
</html>

<?php include 'footer.php';?>