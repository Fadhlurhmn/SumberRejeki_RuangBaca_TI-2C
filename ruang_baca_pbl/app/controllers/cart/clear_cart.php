<?php
require '../pesan_kilat.php';
session_start();

// pengecekan pada variabel clear_cart 
if (isset($_POST['clear_cart'])) {

    // menghapus cart
    unset($_SESSION['cart']);
    pesan('success', "Seluruh buku dihapus dari cart.");
} else {
    pesan('danger', "Gagal menghapus seluruh buku dari cart.");
}
header("Location: ../../views/index.php?page=cart");
exit;