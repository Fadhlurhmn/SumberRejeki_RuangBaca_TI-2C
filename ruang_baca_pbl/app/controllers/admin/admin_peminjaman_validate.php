<?php
require __DIR__ . '/../../core/Transaksi.php';
require '../pesan_kilat.php';
session_start();


$transaksi_peminjaman = new Transaksi;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan nilai dari input hidden id_peminjaman
    $id_peminjaman = $_POST['id_peminjaman'];

    // Mendapatkan nilai dari input hidden id_buku
    $id_buku_array = $_POST['id_buku'];

    // Mendapatkan nilai dari input teks keterangan
    $keterangan_array = $_POST['keterangan'];

    // Mendapatkan nilai dari input radio status
    $status_array = $_POST['status'];

    // Loop melalui array id_buku untuk mendapatkan nilai setiap id_buku
    foreach ($id_buku_array as $id_buku) {
        // Dapatkan nilai keterangan dan status untuk setiap id_buku
        $keterangan = $keterangan_array[$id_buku];
        $status = $status_array[$id_buku];

        // Lakukan sesuatu dengan nilai yang diperoleh, misalnya simpan ke database
        $transaksi_peminjaman->validate_peminjaman($id_peminjaman, $id_buku, $status, $keterangan);
        // ...
    }

    // Redirect atau lakukan hal lain setelah pemrosesan data
    // header("Location: halaman_tujuan.php");
    header("Location: ../../views/index.php?page=validasi/peminjaman");
    pesan('success', "Validasi Peminjaman berhasil dilakukan.");
        // exit();
}
?>
