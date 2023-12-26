<?php
require '../../core/Anggota.php';
require '../../config/koneksi.php';
class anggota_delete extends Anggota{
    
    public function delete_anggota($id){
        global $koneksi;

        // penghapusan anggota dengan mengubah status nya menjadi non-aktif 
        $query = mysqli_query($koneksi, "UPDATE anggota SET status_anggota = 'non_aktif' WHERE id = '$id'");

        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>