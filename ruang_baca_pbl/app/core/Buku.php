<?php
class Buku{
    private $id;
    private $isbn;
    private $judul;
    private $penulis;
    private $jumlah;
    private $tersedia;
    private $deskripsi;
    private $gambar;
    private $status_buku;

    public function __construct(){}

    // set id
    public function setID($id){
        $this->id = $id;
    }
    // set isbn
    public function setISBN($isbn){
        $this->isbn = $isbn;
    }
    // set judul
    public function setJudul($judul){
        $this->judul = $judul;
    }
    // set penulis
    public function setPenulis($penulis){
        $this->penulis = $penulis;
    }
    // set jumlah
    public function setJumlah($jumlah){
        $this->jumlah = $jumlah;
    }
    // set tersedia
    public function setTersedia($tersedia){
        $this->tersedia = $tersedia;
    }
    // set deskripsi
    public function setDeskripsi($deskripsi){
        $this->deskripsi = $deskripsi;
    }
    // set gambar
    public function setGambar($gambar){
        $this->gambar = $gambar;
    }
    // set status_buku
    public function setStatus_buku($status_buku){
        $this->status_buku = $status_buku;
    }

    // get id
    public function getID(){
        return $this->id;
    }
    // get isbn
    public function getISBN(){
        return $this->isbn;
    }
    // get judul
    public function getJudul(){
        return $this->judul;
    }
    // get penulis
    public function getPenulis(){
        return $this->penulis;
    }
    // get jumlah
    public function getJumlah(){
        return $this->jumlah;
    }
    // get tersedia
    public function getTersedia(){
        return $this->tersedia;
    }
    // get deskripsi
    public function getDeskripsi(){
        return $this->deskripsi;
    }
    // get gambar
    public function getGambar(){
        return $this->gambar;
    }
    // get status_buku
    public function getStatus_buku(){
        return $this->status_buku;
    }
}
?>