<?php
require_once __DIR__ . '/../../../models/transaksi/transaksi_peminjaman.php';

$transaksi_peminjaman = new transaksi_peminjaman;

// menampilkan data peminjaman berdasarkan id anggota
$data_peminjaman_byID = $transaksi_peminjaman->tampil_peminjaman_byID($id_anggota);
?>