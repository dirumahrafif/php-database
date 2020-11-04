<?php 
session_start();
require_once("koneksi.php");
require_once("fungsi.php");
$url = $_SERVER['REQUEST_URI'];
if(isset($_SESSION['login_id']) == '' & strpos($url,"admin_login.php") == false){
    header("location:admin_login.php");
    exit();
}
?>
<html>
    <head><title>Admin Web Company Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <link rel="stylesheet" href="admin_style.css"/>
    <script type="text/javascript" src="javascript.js"></script>
</head>
<body>
    <div id="wrapper">
        <?php if(strpos($url,"admin_login.php") == false) {?>
        <div id="header">Admin Web</div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_tulisan.php">Admin Tulisan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_dokumen.php">Admin Dokumen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_galeri.php">Admin Galeri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_kategori_galeri.php">Admin Kategori Galeri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_event.php">Admin Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_logout.php">Logout &raquo;</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <?php } ?>
            <div id="content">