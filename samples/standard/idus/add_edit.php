<?php
require_once 'init.php';


$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

switch ($rec) {
case 'ajax':
	# code...
	break;
case 'op':
	if ($_POST['submit']) {
		if ($id) {
			# update...
		} else {
			# insert...
		}
		
		$data = $_POST['fields'];
		print_r($data);
	}
	exit();
	break;

default:
	$res = $db->query(sprintf('SELECT id,cid,name,addtime,modtime,ip,is_rec,tpls FROM %s WHERE id=%d','ig_article',$id));
	$page = $res->fetch_assoc();
	break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新增、编辑</title>
	<!-- <link rel="stylesheet" href="default.css" /> -->
</head>
<script language="javascript">

</script>
<body>
	<div>
		<!-- enctype 的属性
		application/x-www-form-urlencoded	在发送前编码所有字符（默认）
		multipart/form-data					不对字符编码。在使用包含文件上传控件的表单时，必须使用该值。
		text/plain							空格转换为 "+" 加号，但不对特殊字符编码。 -->
		<form action="" method="post" enctype="multipart/form-data" >
			<div>
				<label for="name">标题:</label>
				<input type="text" name="fields[name]" id="name" value="<?php echo $page['name'] ?>" tabindex="1" />
			</div>
		
			<div>
				<h4>状态:</h4>
				<label for="radio-choice-1">隐藏</label>
				<input <?php if ($page['is_rec']==-1): ?>checked<?php endif ?> type="radio" name="fields[is_rec]" id="radio-choice-1" tabindex="2" value="-1" />
				<label for="radio-choice-2">显示</label>
				<input <?php if ($page['is_rec']==0): ?>checked<?php endif ?> type="radio" name="fields[is_rec]" id="radio-choice-2" tabindex="3" value="0" />
				<label for="radio-choice-2">推荐</label>
				<input <?php if ($page['is_rec']==1): ?>checked<?php endif ?> type="radio" name="fields[is_rec]" id="radio-choice-2" tabindex="3" value="1" />
			</div>
		
			<div>
				<label for="select-choice">重新分类:</label>
				<select name="fields[cid]" id="select-choice">
					<option <?php if ($page['cid']==0) {echo 'selected';} ?> value="0">--请选择--</option>
					<option value="1">Choice 1</option>
					<option value="2">Choice 2</option>
					<option value="3">Choice 3</option>
				</select>
			</div>
			
			<div>
				<label for="textarea">IP地址:</label>
				<textarea cols="40" rows="8" name="fields[ip]" id="textarea"><?php echo $page['ip'] ?></textarea>
			</div>
			
			<div>
				<label for="checkbox">Checkbox:</label>
				<input type="checkbox" name="checkbox" id="checkbox" />
			</div>
		
			<div>
				<input type="hidden" name="rec" value="op">
				<input type="hidden" name="id" value="<?php echo $page['id'] ?>">
				<input type="submit" name="submit" value="提交" />
			</div>
		</form>
	</div>
</body>
</html>

<?php include 'footer.php';?>