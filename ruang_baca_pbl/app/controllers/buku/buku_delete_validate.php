<?php
require __DIR__ . '/../../models/buku/buku_delete.php';

$buku = new buku_delete;

// pengecekan apabila variabel hapusBuku sudah di set
if(isset($_POST['hapusBuku'])) {
    $id = $_POST['id'];

    // melakukan penghapusan buku
    if($buku->delete_buku($id)) {
        header("Location: ../../views/index.php?page=buku");
    
    // gagal melakukan penghapusan buku
    } else {
        header("Location: ../../views/index.php");            
    }
}
?>