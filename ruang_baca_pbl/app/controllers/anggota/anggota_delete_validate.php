<?php
require __DIR__ . '/../../models/anggota/anggota_delete.php';

$anggota = new anggota_delete;

// pengecekan apabila variabel hapusPengguna sudah di set
if(isset($_POST['hapusPengguna'])) {
    $id = $_POST['id'];

    // melakukan penghapusan anggota
    if($anggota->delete_anggota($id)) {
        header("Location: ../../views/index.php?page=anggota");            
    } else {
        header("Location: ../../views/index.php");            
    }

// variabel hapusPengguna tidak ter-set
} else {
    header("Location: ../../views/index.php");            
}
?>