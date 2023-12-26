<?php
require_once __DIR__ . '/../../core/Anggota.php';
require __DIR__ . '/../../config/koneksi.php';

class anggota_read extends Anggota {
    // tampil semua anggota
    public function tampil_semua_anggota() {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT id,no_induk, nama, alamat, jenis_kelamin, no_telp, jabatan, jurusan, prodi, status_anggota FROM anggota WHERE level = 'user'");

        // mengumpulkan data anggota ke dalam array
        $anggota = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $anggota[] = $row;
        }

        return $anggota;
    }
    public function tampil_anggota_byID($id) {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT id,no_induk, nama, alamat, jenis_kelamin, no_telp, jabatan, jurusan, prodi, salt, password FROM anggota WHERE level = 'user' AND no_induk = '$id' AND status_anggota = 'aktif'");

        // mengumpulkan data anggota ke dalam array
        $anggota = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $anggota[] = $row;
        }

        return $anggota;
    }
    
}
?>
