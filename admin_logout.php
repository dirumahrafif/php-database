<?php 
session_start();
$_SESSION['login_id'] = '';
unset($_SESSION['login_id']);
$_SESSION['username'] = '';
unset($_SESSION['username']);
session_unset();
session_destroy();
header("location:admin_login.php");