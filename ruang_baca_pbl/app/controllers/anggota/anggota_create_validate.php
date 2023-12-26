<?php
require __DIR__ . '/../../models/anggota/anggota_create.php';
require __DIR__ . '/../../models/anggota/anggota_read.php';
require '../pesan_kilat.php';

$anggota_c = new anggota_create;
$anggota_r = new anggota_read;
session_start();

// Check if the variable savePenggunaBaru is set
if (isset($_POST['savePenggunaBaru'])) {
    // Set variables in anggota_c with POST data
    $anggota_c->setNo_induk($_POST['no_induk']);
    $anggota_c->setNama($_POST['nama']);
    $anggota_c->setJenis_kelamin($_POST['jenis_kelamin']);
    $anggota_c->setAlamat($_POST['alamat']);
    $anggota_c->setNo_telp($_POST['no_telp']);
    $anggota_c->setJabatan($_POST['jabatan']);
    $anggota_c->setProdi($_POST['prodi']);

    // Set level based on jabatan
    if ($anggota_c->getJabatan() === 'Admin') {
        $anggota_c->setLevel('admin');
    } else if ($anggota_c->getJabatan() === 'Dosen' || $anggota_c->getJabatan() === 'Mahasiswa') {
        $anggota_c->setLevel('user');
    }

    $anggota_c->setJurusan($_POST['jurusan']);
    $anggota_c->setPassword($_POST['password']);

    // Create salt and hashed password
    $salt = bin2hex(random_bytes(16));
    $combined_password = $salt . $anggota_c->getPassword();
    $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

    // Check if no_induk already exists
    $no_induk_list = $anggota_r->tampil_semua_anggota();
    $cek = false;
    foreach ($no_induk_list as $induk_number) {
        if ($induk_number['no_induk'] === $anggota_c->getNo_induk()) {
            pesan('danger', "No Induk yang dimasukkan sudah tersedia");
            $cek = true;
        }
    }

    // Add anggota_c to the database
    if (!$cek) {
        if ($anggota_c->tambah_anggota(
            $anggota_c->getNo_induk(),
            $anggota_c->getNama(),
            $anggota_c->getAlamat(),
            $anggota_c->getJenis_kelamin(),
            $anggota_c->getNo_telp(),
            $anggota_c->getJabatan(),
            $anggota_c->getJurusan(),
            $anggota_c->getLevel(),
            $hashed_password,
            $salt,
            $anggota_c->getProdi()
        )) {
            pesan('success', "Data Anggota berhasil ditambahkan.");
        } else {
            pesan('danger', "Data Anggota gagal ditambahkan.");
        }
    }

    header("Location: ../../views/index.php?page=anggota");
} else {
    // Redirect if savePenggunaBaru is not set
    header("Location: ../../views/index.php?page=anggota");
}
?>