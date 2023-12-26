<?php
require_once __DIR__ . '/../../core/Transaksi.php';
require __DIR__ . '/../../config/koneksi.php';

class transaksi_pengembalian extends Transaksi{

    public function validate_pengembalian($id_pengembalian, $id_buku){
        global $koneksi;
        // Fetch data buku
        $query_fetch_amount = mysqli_query($koneksi, "SELECT tersedia FROM buku WHERE id = '$id_buku'");
        $result_fetch_amount = mysqli_fetch_assoc($query_fetch_amount);
        
        // Operasi menambah jumlah buku
        $jumlah_buku_saat_ini = $result_fetch_amount['tersedia'] + 1;
        
        // Update data pada kolom tersedia di buku
        $query_update_amount = mysqli_query($koneksi, "UPDATE buku SET tersedia = '$jumlah_buku_saat_ini' WHERE id = '$id_buku'");
        $query = mysqli_query($koneksi, "UPDATE pengembalian SET status = 'selesai' WHERE id = '$id_pengembalian'");
        if($query){
            return true;
        }else{
            return false;
        }
    }
    

    public function ajukan_pengembalian($id_peminjaman){
        global $koneksi;
        $id_pinjam = mysqli_real_escape_string($koneksi, $id_peminjaman);
        $query = mysqli_query($koneksi, "INSERT INTO pengembalian VALUES (DEFAULT,DEFAULT,'$id_peminjaman',DEFAULT)");

        if($query){
            unset($_SESSION['allow_peminjaman']);
            return mysqli_insert_id($koneksi);
        }else{
            return false;
        }
    }
    
    // menampilkan seleuruh data pengembalian
    public function tampil_semua_pengembalian() {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM view_pengembalian");

        // mengumpulkan data pengembalian ke dalam array
        $pengembalian = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $pengembalian[] = $row;
        }

        return $pengembalian;
    }

    // menampilkan data pengembalian berdasarkan ID anggota
    public function tampil_pengembalian_byID($id) {
        global $koneksi;
        $query = mysqli_query($koneksi, 
        "SELECT 
        pb.tanggal_buku_dikembalikan, 
        pb.status, 
        pb.id_peminjaman, 
        pj.id_anggota FROM pengembalian as pb
        JOIN peminjaman as pj 
        ON pb.id_peminjaman = pj.id
        WHERE pj.id_anggota = '$id'
        ORDER BY pb.id_peminjaman DESC");

        // mengumpulkan data pengembalian ke dalam array
        $pengembalian = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $pengembalian[] = $row;
        }

        return $pengembalian;
    }

    // menampilkan data detail pengembalian berdasakna ID pengembalian
    public function tampil_semua_pengembalian_detail($id_pengembalian) {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM histori_pengembalian WHERE id_pengembalian = '$id_pengembalian' AND status_buku = 'acc'");

        // mengumpulkan data pengembalian ke dalam array
        $detail_pengembalian = array();
        while($row = mysqli_fetch_assoc($query)){
            $detail_pengembalian[] = $row; 
        }

        return $detail_pengembalian;
    }

    // menampilkan seluruh data pengembalian yang akan dikonfirm admin
    public function tampil_semua_pengembalian_konfirm() {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM info_validate_pengembalian_temp");

        // mengumpulkan data pengembalian ke dalam array
        $pengembalian = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $pengembalian[] = $row;
        }

        return $pengembalian;
    }
}
?>