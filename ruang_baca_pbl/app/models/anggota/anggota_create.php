<?php
require_once '../../core/Anggota.php';
require '../../config/koneksi.php';
class anggota_create extends Anggota{

    public function tambah_anggota($no_induk,$nama, $alamat, $jenis_kelamin, $no_telp, $jabatan, $jurusan, $level, $password, $salt, $prodi){
        global $koneksi;

        // anti injection
        $no_induk = mysqli_real_escape_string($koneksi, $no_induk);
        $nama = mysqli_real_escape_string($koneksi, $nama);
        $alamat = mysqli_real_escape_string($koneksi, $alamat);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $jenis_kelamin);
        $no_telp = mysqli_real_escape_string($koneksi, $no_telp);
        $jabatan = mysqli_real_escape_string($koneksi, $jabatan);
        $jurusan = mysqli_real_escape_string($koneksi, $jurusan);
        $level = mysqli_real_escape_string($koneksi, $level);
        $password = mysqli_real_escape_string($koneksi, $password);
        $salt = mysqli_real_escape_string($koneksi, $salt);
        $prodi = mysqli_real_escape_string($koneksi, $prodi);

        // membuat anggota baru
        $query = mysqli_query($koneksi, "INSERT INTO anggota (no_induk, nama, alamat, jenis_kelamin, no_telp, jabatan, jurusan, level, password, salt, prodi) VALUES ('$no_induk','$nama','$alamat','$jenis_kelamin','$no_telp','$jabatan','$jurusan','$level','$password','$salt','$prodi')");

        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>