<?php
require __DIR__ . '/../../../models/transaksi/transaksi_pengembalian.php';

$transaksi = new transaksi_pengembalian;

// menampilkan semua data pengembalian
$data_pengembalian = $transaksi->tampil_semua_pengembalian();
?>