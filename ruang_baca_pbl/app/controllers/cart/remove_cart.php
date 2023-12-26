<?php
require '../pesan_kilat.php';
session_start();

// remove per item

// pengecekan pada variabel remove_from_cart 
if (isset($_POST['remove_from_cart']) && isset($_POST['remove_id'])) {
    $removeId = $_POST['remove_id'];

    // menghapus item sesuai id
    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]);

        // mengatur ulang index nya
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        pesan('success', "Berhasil menghapus buku dari cart.");
    } else {
        pesan('danger', "Gagal menghapus buku dari cart.");
    }
} else {
    pesan('danger', "Gagal menghapus buku dari cart.");
}
header("Location: ../../views/index.php?page=cart");
exit;