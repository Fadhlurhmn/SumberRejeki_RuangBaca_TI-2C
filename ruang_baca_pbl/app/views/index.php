<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!empty($_SESSION['level'])){
    require '../config/koneksi.php';
    include '../controllers/pesan_kilat.php';
    if($_SESSION['level'] == 'admin'){
        include 'admin/template/header.php';
        if(!empty($_GET['page'])){
            include 'admin/module/'. $_GET['page'] . '/index.php';
        }else{
            include 'admin/template/home.php';
        }
        include 'admin/template/footer.php';
    } else if($_SESSION['level'] == 'user'){
        include 'user/template/header.php';
        if(!empty($_GET['page'])){
            include 'user/module/'. $_GET['page']. '/index.php';
        }else{
            include 'user/template/home.php';
        }
        include 'user/template/footer.php';
    }
} else {
    header("Location: login.php");
}
?>
