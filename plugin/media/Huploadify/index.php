<?php 
// require "./Huploadify.php";
require_once '../../../source/init_base.php';

$_POST and extract($_POST);
if (isset($submit)) {
    echo $file_ids;
    echo "<br>";
    echo $filepath;
    die;
}


include_once 'home.html';
?>