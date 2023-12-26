<?php
require __DIR__ . '/../../models/anggota/anggota_read.php';

$anggota = new anggota_read;

// menampilkan seluruh data anggota
$data_anggota = $anggota->tampil_semua_anggota();
?>
