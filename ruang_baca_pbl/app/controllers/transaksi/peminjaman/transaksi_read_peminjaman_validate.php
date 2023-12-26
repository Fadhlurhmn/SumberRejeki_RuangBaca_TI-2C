<?php
require __DIR__ . '/../../../models/transaksi/transaksi_peminjaman.php';

$transaksi = new transaksi_peminjaman;

// menampilkan semua data peminjaman 
$data_peminjaman = $transaksi->tampil_semua_peminjaman();
?>