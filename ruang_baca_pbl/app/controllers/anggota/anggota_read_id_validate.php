<?php
require __DIR__ . '/../../models/anggota/anggota_read.php';

$anggota = new anggota_read;

// menampilkan data anggota berdasarkan id nya
$data_anggota = $anggota->tampil_anggota_byID($id);
?>
