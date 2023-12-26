<?php
require __DIR__ . '/../../../models/transaksi/transaksi_pengembalian.php';

$transaksi = new transaksi_pengembalian;

// menampilkan data pengembalian yang telah dikonfirmasi admin
$data_pengembalian = $transaksi->tampil_semua_pengembalian_konfirm();
?>