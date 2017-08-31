<?php  
// 获取上传文件名，检测该文件是否存在，如果存在，则追加，否则新建
$filename = $_POST['filename'];
$os = PHP_OS;
echo $os;
var_dump(strpos($os,"WIN"));
// 对于windows，由于中文乱码，故先进行转码
if(strpos($os,"WIN")!==false){
    echo 'here';
    $filename2 = iconv('utf-8','gbk',$filename);
}else{
    $filename2 = $filename;
}
if(!file_exists('upload/'.$filename2)){
    move_uploaded_file($_FILES['part']['tmp_name'],'upload/'.$filename2);
}else{
    $tmp = file_get_contents($_FILES['part']['tmp_name']);
    file_put_contents('upload/'.$filename2,$tmp,FILE_APPEND);
}
?>