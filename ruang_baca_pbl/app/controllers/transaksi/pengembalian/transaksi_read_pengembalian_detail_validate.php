<?php
require __DIR__ . '/../../../models/transaksi/transaksi_pengembalian.php';

$transaksi = new transaksi_pengembalian;

// menampilkan data detail pengembalian berdasarkan id pengembalian
$data_pengembalian = $transaksi->tampil_semua_pengembalian_detail($id_pengembalian);

?>