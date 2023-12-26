<?php
require __DIR__ . '/../../../models/transaksi/transaksi_peminjaman.php';

$transaksi = new transaksi_peminjaman;

// menampilkan data peminjaman yang sudah di konfirmasi admin
$data_peminjaman = $transaksi->tampil_semua_peminjaman_konfirm();
?>