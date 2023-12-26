<?php
require_once __DIR__ . '/../../models/buku/buku_read.php';

$buku_top = new buku_read;

// menampilkan data buku untuk 3 buku teratas yang telah dipinjam
$data_buku_top = $buku_top->tampil_buku_top3();
?>