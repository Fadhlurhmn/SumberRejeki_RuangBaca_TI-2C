<?php
require_once __DIR__ . '/../../../models/transaksi/transaksi_pengembalian.php';

$transaksi_pengembalian = new transaksi_pengembalian;

// menampilkan data pengembalian berdasarkan id anggota
$data_pengembalian = $transaksi_pengembalian->tampil_pengembalian_byID($id_anggota);
?>