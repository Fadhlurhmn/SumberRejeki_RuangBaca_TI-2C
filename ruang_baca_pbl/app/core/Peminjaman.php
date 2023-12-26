<?php
interface Peminjaman {

    // user mengajukan peminjaman
    public function ajukan_peminjaman($id);

    // konfirmasi peminjaman oleh admin
    public function validate_peminjaman($id_peminjaman, $id_buku, $status_buku, $keterangan);
}

?>