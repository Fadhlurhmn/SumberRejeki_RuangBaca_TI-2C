<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../controllers/anti_injection.php';
include '../models/validate_login.php';
include 'pesan_kilat.php'; // Include the file with flash message functions

$no_induk = antiinjection($koneksi, $_POST['no_induk']);
$password = antiinjection($koneksi, $_POST['password']);

$data = get_data_user($no_induk);

$salt = $data['salt'];
$hashed_password = $data['hashed_password'];

if ($salt !== null && $hashed_password !== null && $data['status_anggota'] == 'aktif')  {
    $combined_password = $salt . $password;

    if (password_verify($combined_password, $hashed_password)) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['no_induk'] = $data['no_induk'];
        $_SESSION['nama'] = $data['nama'];
        // $_SESSION['password'] = $data['hashed_password'];

        header("Location: ../views/index.php");
    } else {
        pesan('danger', "Login gagal. Password Anda Salah.");
        header("Location: ../views/login.php");
    }
} else {
    pesan('warning', "Username tidak ditemukan.");
    header("Location: ../views/login.php");
}
?>
