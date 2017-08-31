<?php
header('Content-Type:text/html;charset=UTF-8');
// ini_set('max_execution_time', '300');
// ini_set('memory_limit', '1024M');
// post_max_size、upload_max_filesize无法用ini_set设置，可在.htaccess中设置

/*
 * 腾讯云 COS_v4
*/

require('./include.php');
use qcloudcos\Cosapi;// 不允许在这之前有任何输出
use qcloudcos\Conf;
// $bucket = 'test';// Bucket名称
// $src = './1.jpg';// 要上传的文件
// $dst = '/666/1.jpg';// 上传文件储存位置
// // $folder = '/ok';// 创建文件夹，与$dst无关
Cosapi::setTimeout(180);
Cosapi::setRegion('gz'); // Set region to guangzou.


$bucket = '';$src = '';$dst = '';$folder = '';
if (isset($_POST['submit'])) {
	$upfile = 'myfile';
    if (@empty($_FILES[$upfile]['name'])) {
        echo "文件不存在！";
    }

	$bucket = 'test';
	$src = $_FILES[$upfile]['tmp_name'];
	$folder = '/'.date('YmdHis',time());
	// $folder = '/tmp';
	$dst = $folder.'/'.$_FILES[$upfile]['name'];// 上传文件储存位置
	// $dst = $folder.'/1.pdf';// 上传文件储存位置
	$sliceSize = $_FILES[$upfile]['size'];

	echo "<pre>";
	// Create folder in bucket.
	$ret = Cosapi::createFolder($bucket, $folder);
	// var_dump($ret);

	// Upload file into bucket.
	$ret = Cosapi::upload($bucket, $src, $dst, null, $sliceSize);
	// $ret = Cosapi::upload($bucket, $src, $dst);
	// var_dump($ret);
	// echo $resource_path = str_replace('/'.(Conf::APP_ID).'/'.$bucket,'',$ret['data']['resource_path']);
	// mysql_query("INSERT INTO `op_photo` (resource_path) VALUES ('$resource_path');");
	// mysql_query("INSERT INTO `op_photo` (resource_path) VALUES ('$dst');");
	echo ($ret) ? '上传成功！' : '上传失败！' ;

	// // List folder.
	// $ret = Cosapi::listFolder($bucket, $folder);
	// var_dump($ret);

	// // Update folder information.
	// $bizAttr = "";
	// $ret = Cosapi::updateFolder($bucket, $folder, $bizAttr);
	// var_dump($ret);

	// // Update file information.
	// $bizAttr = '';
	// $authority = 'eWPrivateRPublic';
	// $customerHeaders = array(
	//     'Cache-Control' => 'no',
	//     'Content-Type' => 'application/pdf',
	//     'Content-Language' => 'ch',
	// );
	// $ret = Cosapi::update($bucket, $dst, $bizAttr,$authority, $customerHeaders);
	// var_dump($ret);

	// // Stat folder.
	// $ret = Cosapi::statFolder($bucket, $folder);
	// var_dump($ret);

	// // Stat file.
	// $ret = Cosapi::stat($bucket, $dst);
	// var_dump($ret);

	// // Delete file.
	// $ret = Cosapi::delFile($bucket, $dst);
	// var_dump($ret);

	// Delete folder.
	// $ret = Cosapi::delFolder($bucket, $folder);
	// var_dump($ret);


	unset($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>腾讯云 COS_v4</title>
</head>
<body>
	<form action='' method='POST' enctype='multipart/form-data' >
		<input type='file' name='myfile' value='' />
		<input type='submit' name='submit' value='上传文件' />
	<form>
</body>
</html>


