<?php
session_start();
require '../../pesan_kilat.php';
require '../../../config/koneksi.php';
require '../../../models/transaksi/transaksi_pengembalian.php';

$transaksi_pengembalian = new Transaksi();

// mengajukan pengembalian
if (isset($_POST['id'])){
    $id_peminjaman = $_POST['id'];
    $transaksi_pengembalian->ajukan_pengembalian($id_peminjaman);
    pesan('success', "Buku berhasil dikembalikan, menunggu konfirmasi admin.");
} else {
    pesan('danger', "Gagal melakukan pengembalian buku.");
}
header("Location: ../../../views/index.php?page=peminjaman");

