<?php
require '../../config/koneksi.php';
require '../../core/Buku.php';
class buku_edit extends Buku{

    // update dengan gambar
    public function edit_buku($id, $isbn, $judul, $penulis, $jumlah, $tersedia, $deskripsi, $gambar, $status_buku){
        global $koneksi;
    
        // anti injection
        $isbn = mysqli_real_escape_string($koneksi, $isbn);
        $judul = mysqli_real_escape_string($koneksi, $judul);
        $penulis = mysqli_real_escape_string($koneksi, $penulis);
        $jumlah = mysqli_real_escape_string($koneksi, $jumlah);
        $tersedia = mysqli_real_escape_string($koneksi, $tersedia);
        $deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        $gambar = mysqli_real_escape_string($koneksi, $gambar);
    
        // update data buku
        $query = "UPDATE buku SET isbn = '$isbn', judul = '$judul', penulis = '$penulis', jumlah = '$jumlah', tersedia = '$tersedia', deskripsi = '$deskripsi', gambar = '$gambar', status_buku = '$status_buku' WHERE id = '$id'";
    
        $result = mysqli_query($koneksi, $query);
    
        if ($result) {
            return true;
        } else {
            echo "Error: " . mysqli_error($koneksi); // Tampilkan pesan kesalahan query
            return false;
        }
    }    

    // update tanpa gambar
    public function edit_buku_no_gambar($id, $isbn, $judul, $penulis, $jumlah, $tersedia, $deskripsi, $status_buku){
        global $koneksi;

        // update data buku
        $query = mysqli_query($koneksi, "UPDATE buku SET isbn = '$isbn',judul = '$judul', penulis = '$penulis', jumlah = '$jumlah', tersedia = '$tersedia', deskripsi = '$deskripsi', status_buku = '$status_buku' WHERE id = '$id'");

        if($query){
            return true;
        }else{
            return false;
        }
    }

}
?>