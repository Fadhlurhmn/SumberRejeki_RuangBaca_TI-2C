<?php
require __DIR__ . '/../../core/Buku.php';
require __DIR__ . '/../../config/koneksi.php';
class buku_read extends Buku{

    // menampilkan semua buku
    public function tampil_semua_buku(){
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM buku");

        if(!$query){
            die("Gagal mengeksekusi query: " . mysqli_error($koneksi));
        }

        // mengumpulkan data buku ke dalam array
        $bukuArray = array();
        while($row = mysqli_fetch_assoc($query)){
            $bukuArray[] = $row;
        }

        return $bukuArray;
    }

    // menampilkan buku berdasarkan ID
    public function tampil_buku_byID($id){
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'");

        if(!$query){
            die("Gagal mengeksekusi query: " . mysqli_error($koneksi));
        }

        // mengumpulkan data buku ke dalam array
        $bukuArray = array();
        while($row = mysqli_fetch_assoc($query)){
            $bukuArray[] = $row;
        }

        return $bukuArray;
    }

    // menampilakan 3 buku teratas dalam peminjaman
    public function tampil_buku_top3(){
        global $koneksi;
        $query = mysqli_query($koneksi, 
        "SELECT COUNT(id_buku) as top, b.judul, b.gambar, b.id 
        FROM detail_peminjaman as dt
        JOIN buku as b ON dt.id_buku = b.id
        GROUP BY id_buku ORDER BY top DESC
        LIMIT 3");

        if(!$query){
            die("Gagal mengeksekusi query: " . mysqli_error($koneksi));
        }

        // mengumpulkan data buku ke dalam array
        $bukuArray = array();
        while($row = mysqli_fetch_assoc($query)){
            $bukuArray[] = $row;
        }

        return $bukuArray;
    }
}
?>