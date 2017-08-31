<?php
header('Content-Type:text/html;charset=UTF-8');
require_once 'config.php';

unset($_SESSION);
session_destroy();
// session_unset();
header("location:login.php");exit;
?>