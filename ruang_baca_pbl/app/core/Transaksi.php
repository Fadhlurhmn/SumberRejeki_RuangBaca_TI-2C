<?php
require __DIR__ . '/../config/koneksi.php';
require 'Peminjaman.php';
require 'Pengembalian.php';

class Transaksi implements Peminjaman, Pengembalian{

    public function validate_peminjaman($id_peminjaman, $id_buku, $status_buku, $keterangan){
        global $koneksi;
        $status_buku = mysqli_real_escape_string($koneksi, $status_buku);
        $keterangan = mysqli_real_escape_string($koneksi, $keterangan);
        
        // update status buku
        $query = mysqli_query($koneksi, "UPDATE detail_peminjaman SET status_buku = '$status_buku', keterangan = '$keterangan' WHERE id_peminjaman = '$id_peminjaman' AND id_buku = '$id_buku'");
        if($status_buku == 'acc'){

            // Fetch data buku
            $query_fetch_amount = mysqli_query($koneksi, "SELECT tersedia FROM buku WHERE id = '$id_buku'");
            $result_fetch_amount = mysqli_fetch_assoc($query_fetch_amount);

            // Operasi mengurangi jumlah buku
            $jumlah_buku_saat_ini = $result_fetch_amount['tersedia'] - 1;

            // Update data pada kolom tersedia di buku
            $query_update_amount = mysqli_query($koneksi, "UPDATE buku SET tersedia = '$jumlah_buku_saat_ini' WHERE id = '$id_buku'");
        }
        $query_update_status_peminjaman = mysqli_query($koneksi, "UPDATE peminjaman SET status_peminjaman = 'terkonfirmasi' WHERE id = '$id_peminjaman'");
        if($query_update_status_peminjaman){
            return true;
        }else{
            return false;
        }
    }
    
    public function ajukan_peminjaman($id){
        global $koneksi;
        $id = mysqli_real_escape_string($koneksi, $id);
        $query = mysqli_query($koneksi, "INSERT INTO peminjaman VALUES (DEFAULT,'$id',DEFAULT,DEFAULT,DEFAULT)");

        if($query){
            return mysqli_insert_id($koneksi);
        }else{
            return false;
        }
    }

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
}
?>