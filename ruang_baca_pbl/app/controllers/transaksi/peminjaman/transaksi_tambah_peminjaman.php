<?php
session_start();
require '../../pesan_kilat.php';
require '../../../config/koneksi.php';
require_once '../../../models/transaksi/transaksi_peminjaman.php';
$transaksi_peminjaman = new Transaksi();

// menambahkan buku-buku ke detail peminjaman
function tambah_detail($id_pinjam,$id_buku){
    global $koneksi;
    $id_pinjam = mysqli_real_escape_string($koneksi, $id_pinjam);
    $id_buku = mysqli_real_escape_string($koneksi, $id_buku);
    $query = mysqli_query($koneksi, "INSERT INTO detail_peminjaman VALUES ('$id_pinjam', '$id_buku','',DEFAULT)");
    if($query){
        return true;
    }else{
        return false;
    }
}

if (isset($_SESSION['cart'])){
    $i = 0;
    $carts = $_SESSION['cart'];
    $id = $_SESSION['id'];

    // mengajukan peminjaman
    $id_pinjam = $transaksi_peminjaman->ajukan_peminjaman($id);

    // menambahkan buku ke detail peminjaman sesuai dengan cart 
    foreach ($carts as $cart){
        $current_cart = $_SESSION['cart'][$i];
        tambah_detail($id_pinjam, $current_cart);
        $i += 1;
    }

    unset($_SESSION['cart']);
    pesan('success', "Buku berhasil dipinjam, menunggu konfirmasi admin.");
    header("Location: ../../../views/index.php?page=peminjaman");
} else {
    pesan('danger', "Buku gagal dipinjam.");
    header("Location: ../../../views/index.php?page=cart");
}

