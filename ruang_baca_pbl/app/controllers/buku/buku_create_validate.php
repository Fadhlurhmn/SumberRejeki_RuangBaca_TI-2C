<?php
require __DIR__ . '/../../models/buku/buku_create.php';
require '../pesan_kilat.php';
session_start();

$buku = new buku_create;

// pengecekan apabila variabel saveBukuBaru sudah di set
if (isset($_POST['saveBukuBaru'])) {

    // melakukan set pada variabel buku dengan variabel POST
    $buku->setISBN($_POST['isbn']);
    $buku->setJudul($_POST['judul']);
    $buku->setPenulis($_POST['penulis']);
    $buku->setJumlah($_POST['jumlah']);
    $buku->setTersedia($_POST['tersedia']);
    $buku->setDeskripsi($_POST['deskripsi']);

    $target_direktori = "../../../public/uploads/";
    $target_file = $target_direktori . basename($_FILES["userImage"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extension = array("jpg", "jpeg", "png");

    // melakukan pengecekan ekstensi inputan file
    if (in_array($file_type, $allowed_extension) && $_FILES["userImage"]["size"] > 0) {
        if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
            $buku->setGambar(basename($_FILES["userImage"]["name"]));

            // Save to the database
            $result = $buku->tambah_buku(
                $buku->getISBN(),
                $buku->getJudul(),
                $buku->getPenulis(),
                $buku->getJumlah(),
                $buku->getTersedia(),
                $buku->getDeskripsi(),
                $buku->getGambar()
            );

            header("Location: ../../views/index.php?page=buku");
            if ($result) {
                pesan('success', "Data Buku berhasil ditambahkan.");
                exit();
                
                // apabila gagal menyimpan ke database
            } else {
                pesan('danger', "Data Buku gagal ditambahkan.");
            }
            
            // apabila gagal dalam mengupload file 
        } else {
            header("Location: ../../views/index.php?page=buku");
            pesan('danger', "Data Buku gagal ditambahkan.");
        }
        
        // apabila inputan file tidak sesuai format
    } else {
        header("Location: ../../views/index.php?page=buku");
        pesan('danger', "Format Gambar Buku tidak sesuai.");
    }
    
    // variabel saveBukuBaru tidak di set
} else {
    header("Location: ../../views/index.php?page=buku");
    exit();
}
?>
