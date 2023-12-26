<?php
// koneksi dengan database
date_default_timezone_set("Asia/Jakarta");
$koneksi = mysqli_connect("localhost", "root", "", "ruang_baca_new");

// jika koneksi gagal
if(mysqli_connect_errno()){
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>