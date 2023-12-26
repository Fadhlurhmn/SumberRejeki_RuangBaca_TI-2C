<?php
interface Pengembalian{

    // user mangajukan pengembalian
    public function ajukan_pengembalian($id_peminjaman);

    // konfirmasi pengembalian oleh admin
    public function validate_pengembalian($id_pengembalian, $id_buku);
}
?>
