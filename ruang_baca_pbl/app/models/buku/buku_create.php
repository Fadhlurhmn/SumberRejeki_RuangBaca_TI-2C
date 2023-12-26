<?php
require '../../config/koneksi.php';
require '../../core/Buku.php';
class buku_create extends Buku{

    public function tambah_buku($isbn, $judul, $penulis, $jumlah, $tersedia, $deskripsi, $gambar)
    {
        global $koneksi;
    
        // anti injection
        $isbn = mysqli_real_escape_string($koneksi, $isbn);
        $judul = mysqli_real_escape_string($koneksi, $judul);
        $penulis = mysqli_real_escape_string($koneksi, $penulis);
        $jumlah = mysqli_real_escape_string($koneksi, $jumlah);
        $tersedia = mysqli_real_escape_string($koneksi, $tersedia);
        $deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        $gambar = mysqli_real_escape_string($koneksi, $gambar);
    
        // menambah buku baru
        $query = "INSERT INTO buku (isbn, judul, penulis, jumlah, tersedia, deskripsi, gambar) VALUES ('$isbn', '$judul', '$penulis', '$jumlah', '$tersedia', '$deskripsi', '$gambar')";
    
        $result = mysqli_query($koneksi, $query);
    
        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($koneksi); // Tampilkan pesan kesalahan query
            return false;
        }
    }
        
}

?>