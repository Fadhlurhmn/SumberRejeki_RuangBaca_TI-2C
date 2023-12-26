<?php
require_once __DIR__ . '/../../../models/transaksi/transaksi_peminjaman.php';

$transaksi = new transaksi_peminjaman;

// menampilkan data detail peminjaman berdasarkan level user
if ($_SESSION['level'] == 'admin'){
    $data_peminjaman = $transaksi->tampil_semua_peminjaman_detail($id_peminjaman);
} elseif ($_SESSION['level'] == 'user' && $page == "peminjaman") {
    $data_peminjaman[$key] = $transaksi->tampil_semua_peminjaman_detail($id_peminjaman);
} elseif ($_SESSION['level'] == 'user' && $page == "pengembalian") {
    $data_peminjaman[$key] = $transaksi->tampil_semua_peminjaman_detail($id_peminjaman[$key]);
}
?>