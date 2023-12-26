<?php
require '../config/koneksi.php';

function get_data_user($no_induk){
    global $koneksi;
    $query = "SELECT id, nama, no_induk, level, salt, password as hashed_password, status_anggota FROM anggota WHERE no_induk = '$no_induk'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

?>