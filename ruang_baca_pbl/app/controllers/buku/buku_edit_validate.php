<?php
require __DIR__ . '/../../models/buku/buku_edit.php';
require '../pesan_kilat.php';
session_start();
$buku = new buku_edit;

// pengecekan apabila variabel editBuku sudah di set
if(isset($_POST['editBuku'])){
    
    // melakukan set pada variabel buku dengan variabel POST
    $buku->setISBN($_POST['isbn']);
    $buku->setJudul($_POST['judul']);
    $buku->setPenulis($_POST['penulis']);
    $buku->setJumlah($_POST['jumlah']);
    $buku->setTersedia($_POST['tersedia']);
    $buku->setDeskripsi($_POST['deskripsi']);
    $buku->setID($_POST['id']);
    $buku->setStatus_buku($_POST['status_buku']);

    $target_direktori = "../../../public/uploads/";
    $target_file = $target_direktori . basename($_FILES["userImage"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extension = array("jpg", "jpeg", "png");


    if (isset($_FILES['userImage']) && $_FILES['userImage']['error'] == 0) {
    // Ada file yang diunggah
    if (in_array($file_type, $allowed_extension) && $_FILES["userImage"]["size"] > 0) {
        if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
            $buku->setGambar(basename($_FILES["userImage"]["name"]));
            // Save to the database
            if ($buku->edit_buku($buku->getID(), $buku->getISBN(), $buku->getJudul(), $buku->getPenulis(), $buku->getJumlah(), $buku->getTersedia(), $buku->getDeskripsi(), $buku->getGambar(), $buku->getStatus_buku())) {
                header("Location: ../../views/index.php?page=buku");
                pesan('success', "Data Buku berhasil diedit.");
            } else {
                header("Location: ../../views/index.php?page=buku");
                pesan('danger', "Data Buku gagal diedit.");
            }
        } else {
            header("Location: ../../views/index.php?page=buku");
            pesan('danger', "Gambar Buku gagal diupload.");
        }
    } else {
        header("Location: ../../views/index.php?page=buku");
        pesan('danger', "Format Gambar Buku tidak sesuai.");
    }
    } else {
        // Tidak ada file yang diunggah
        header("Location: ../../views/index.php?page=buku");
        if ($buku->edit_buku_no_gambar($buku->getID(), $buku->getISBN(), $buku->getJudul(), $buku->getPenulis(), $buku->getJumlah(), $buku->getTersedia(), $buku->getDeskripsi(), $buku->getStatus_buku())) {
            pesan('success', "Data Buku berhasil diedit.");
        } else {
            pesan('danger', "Data Buku gagal diedit.");
        }
    }
} 
?>