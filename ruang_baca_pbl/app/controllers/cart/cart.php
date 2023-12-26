<?php
require '../pesan_kilat.php';
session_start();

// pengecekan pada variabel add_to_cart dan id_buku
if (isset($_POST['add_to_cart']) && isset($_POST['id_buku'])) {
    $productId = $_POST['id_buku'];

    // pengecekan apabila session cart sudah belum set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // menambahkan buku pada cart
    if (!in_array($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $productId;
        pesan('success', "Buku ditambahkan ke cart.");
    } else {
        pesan('danger', "Buku gagal ditambahkan ke cart., 1 judul hanya dapat dipinjam 1!");
    }
}
header("Location: ../../views/index.php?page=detail_buku&id=" . $_POST['id_buku']);
exit;



