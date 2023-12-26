<?php
require __DIR__ . '/../../core/Transaksi.php';
require '../pesan_kilat.php';
session_start();

$transaksi_pengembalian = new Transaksi;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan nilai dari input hidden id_peminjaman
    $id_pengembalian = $_POST['id_pengembalian'];

    // Mendapatkan nilai dari input hidden id_buku
    $id_buku_array = $_POST['id_buku'];

    // Loop melalui array id_buku untuk mendapatkan nilai setiap id_buku
    foreach ($id_buku_array as $id_buku) {

        // Lakukan sesuatu dengan nilai yang diperoleh, misalnya simpan ke database
        $transaksi_pengembalian->validate_pengembalian($id_pengembalian, $id_buku);
        // ...
    }

    // Redirect atau lakukan hal lain setelah pemrosesan data
    // header("Location: halaman_tujuan.php");
    header("Location: ../../views/index.php?page=validasi/pengembalian");
    pesan('success', "Validasi Pengembalian berhasil dilakukan.");
        // exit();
}
?>
