<?php
require_once __DIR__ . '/../../models/buku/buku_read.php';

$buku = new buku_read;

// menampilkan data buku secara keseluruhan
$data_buku = $buku->tampil_semua_buku();
?>
