<?php
require '../../core/Buku.php';
require '../../config/koneksi.php';
class buku_delete extends Buku{
    
    public function delete_buku($id){
        global $koneksi;

        // menghapus buku dengan mengubah status nya
        $query = mysqli_query($koneksi, "UPDATE buku SET status_buku = 'rusak' WHERE id = '$id'");

        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>