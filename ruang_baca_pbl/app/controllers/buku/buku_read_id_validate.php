<?php
require_once __DIR__ . '/../../models/buku/buku_read.php';

$buku = new buku_read;

// menampilkan data buku berdasarkan ID
$data_buku = $buku->tampil_buku_byID($id_buku);
?>