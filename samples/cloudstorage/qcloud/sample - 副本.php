<?php
header('Content-Type:text/html;charset=UTF-8');//设置字符集,纯PHP中使用
require('./include.php');
use qcloudcos\Cosapi;// 不允许在这之前有任何输出
// $bucket = 'test';// Bucket名称
// $src = './1.jpg';// 要上传的文件
// $dst = '/666/1.jpg';// 上传文件储存位置
// // $folder = '/ok';// 创建文件夹，与$dst无关
Cosapi::setTimeout(180);
Cosapi::setRegion('gz'); // Set region to guangzou.


// ini_set('max_execution_time', '300');
// ini_set('memory_limit', '1024M');
// post_max_size、upload_max_filesize无法用ini_set设置，可在.htaccess中设置
// http://m.blog.csdn.net/article/details?id=18351919

// echo ini_get('max_execution_time');
// echo "<br>";
// echo ini_get('memory_limit');
// echo "<br>";
// echo ini_get('post_max_size');
// echo "<br>";
// echo ini_get('upload_max_filesize');
// echo ini_get('max_file_uploads');



$form = <<<FORM
	<form action='' method='POST' enctype='multipart/form-data' >
	<input type='file' name='myfile' value='' />
	<input type='submit' name='submit' value='上传文件' />
	<form>
FORM;
echo $form;




$bucket = '';
$src = '';
$dst = '';
$folder = '';
if (isset($_POST['submit'])) {
	print_r($_FILES);
	$upfile = 'myfile';

    // 没有命名规则默认以时间作为文件名
    if (empty($image_name)) {
        $image_name = time(); // 设定当前时间为图片名称
    }

    if (@empty($_FILES[$upfile]['name'])) {
        echo "文件不存在！";
    }
    $name = explode('.', $_FILES[$upfile]['name']); // 将上传前的文件以“.”分开取得文件类型
    $img_count = count($name); // 获得截取的数量
    $img_type = $name[$img_count - 1]; // 取得文件的类型


	// $images_dir = dirname(__FILE__).'/tmp/';
	$images_dir = '/tmp/';
	// $photo = $image_name . "." . $img_type; // 写入数据库的文件名
	$photo = $_FILES[$upfile]['name']; // 写入数据库的文件名
	$upfile_name = $images_dir . $photo; // 上传后的文件名称

	// move_uploaded_file()不会自己创建文件夹
	if (!move_uploaded_file($_FILES[$upfile]['tmp_name'],$images_dir.$_FILES[$upfile]['name'])){
		echo "文件上传失败，错误信息：".$_FILES['userfile']['error']."<br>";
	}else{
		$bucket = 'test';
		$src = $upfile_name;
		$dst = $upfile_name;// 上传文件储存位置
		$sliceSize = $_FILES[$upfile]['size'];
		$folder = '/tmp';

		// Create folder in bucket.
		// $ret = Cosapi::createFolder($bucket, $folder);
		// var_dump($ret);

		// Upload file into bucket.
		// $ret = Cosapi::upload($bucket, $src, $dst, null, $sliceSize);
		// $ret = Cosapi::upload($bucket, $src, $dst);
		// var_dump($ret);

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

		// // Delete folder.
		// $ret = Cosapi::delFolder($bucket, $folder);
		// var_dump($ret);
	}

	// if(file_exists($upfile_name))unlink($upfile_name);
	unset($_POST);

}


