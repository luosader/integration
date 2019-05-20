<?php 
// header('Content_Type:text/html;charset=utf-8');
// ob_start();
// session_start();
require_once '../../source/init.php';

$rec = isset($_REQUEST['rec']) ? trim($_REQUEST['rec']) : '';
$op = isset($_REQUEST['op']) ? trim($_REQUEST['op']) : '';

?>