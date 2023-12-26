<?php
require '../../core/Anggota.php';
require '../../config/koneksi.php';
class anggota_edit extends Anggota{

    // with password
    public function edit_anggota_with_password($id, $no_induk, $nama, $alamat, $jenis_kelamin, $no_telp, $jabatan, $jurusan, $level, $password, $salt, $prodi, $status_anggota) {
        global $koneksi;
    
        // update data anggota
        $query = "UPDATE anggota SET 
                    no_induk = '$no_induk',
                    nama = '$nama',
                    alamat = '$alamat',
                    jenis_kelamin = '$jenis_kelamin',
                    no_telp = '$no_telp',
                    jabatan = '$jabatan',
                    jurusan = '$jurusan',
                    level = '$level',
                    password = '$password',
                    salt = '$salt',
                    prodi = '$prodi',
                    status_anggota = '$status_anggota'
                  WHERE id = $id";
    
        $result = mysqli_query($koneksi, $query);
    
        // Cek hasil query, mungkin perlu penanganan error
        if ($result) {
            return true; // Berhasil
        } else {
            return false; // Gagal
        }
    }
    
    
    // no password
    public function edit_anggota_no_password($id, $no_induk, $nama, $alamat, $jenis_kelamin, $no_telp, $jabatan, $jurusan, $level, $prodi, $status_anggota) {
        global $koneksi;
        
        // update data anggota
        $query = "UPDATE anggota SET 
        no_induk = '$no_induk',
        nama = '$nama',
        alamat = '$alamat',
        jenis_kelamin = '$jenis_kelamin',
        no_telp = '$no_telp',
        jabatan = '$jabatan',
        jurusan = '$jurusan',
        level = '$level',
        prodi = '$prodi',
        status_anggota = '$status_anggota'
        WHERE id = $id";

        $result = mysqli_query($koneksi, $query);

        // Cek hasil query, mungkin perlu penanganan error
        if ($result) {
            return true; // Berhasil
        } else {
            return false; // Gagal
        }

    }

    public function edit_password($id, $password, $salt){
        global $koneksi;
        
        // pengeditan password
        $query = "UPDATE anggota SET 
        password = '$password',
        salt = '$salt'
        WHERE id = $id";

        $result = mysqli_query($koneksi, $query);

        // Cek hasil query, mungkin perlu penanganan error
        if ($result) {
            return true; // Berhasil
        } else {
            return false; // Gagal
        }
    }
    
}
?>