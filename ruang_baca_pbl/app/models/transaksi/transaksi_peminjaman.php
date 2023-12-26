<?php
require_once __DIR__ . '/../../core/Transaksi.php';
require __DIR__ . '/../../config/koneksi.php';

class transaksi_peminjaman extends Transaksi{

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
    // menampilkan seluruh data peminjaman
    public function tampil_semua_peminjaman() {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM view_peminjaman");

        // mengumpulkan data peminjaman ke dalam array
        $peminjaman = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $peminjaman[] = $row;
        }

        return $peminjaman;
    }

    // menampilkan data peminjaman berdasarkan ID anggota
    public function tampil_peminjaman_byID($id) {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_anggota = '$id' ORDER BY tanggal_peminjaman DESC");

        // mengumpulkan data peminjaman ke dalam array
        $peminjaman = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $peminjaman[] = $row;
        }

        return $peminjaman;
    }

    // menampilkan data detail peminjaman berdasarjan ID peminjaman 
    public function tampil_semua_peminjaman_detail($id_peminjaman) {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM histori_peminjaman WHERE id_peminjaman = '$id_peminjaman'");

        // mengumpulkan data peminjaman ke dalam array
        $detail_peminjaman = array();
        while($row = mysqli_fetch_assoc($query)){
            $detail_peminjaman[] = $row; 
        }

        return $detail_peminjaman;
    }

    // menampilkan seluruh data peminjaman yang akan dikonfirmasi admin
    public function tampil_semua_peminjaman_konfirm() {
        global $koneksi;
        $query = mysqli_query($koneksi, "SELECT * FROM info_validate_peminjaman");

        // mengumpulkan data peminjaman ke dalam array
        $peminjaman = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $peminjaman[] = $row;
        }

        return $peminjaman;
    }
}
?>