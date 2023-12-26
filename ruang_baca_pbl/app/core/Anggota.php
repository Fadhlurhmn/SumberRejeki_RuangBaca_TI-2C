<?php
class Anggota{
    private $id;
    private $nama;
    private $no_induk;
    private $jenis_kelamin;
    private $no_telp;
    private $jabatan;
    private $alamat;
    private $jurusan;
    private $level;
    private $password;
    private $prodi;
    private $status_anggota;

    public function __construct(){}

    // set id
    public function setID($id){
        $this->id = $id;
    }
    // set no_induk
    public function setNo_induk($no_induk){
        $this->no_induk = $no_induk;
    }
    // set nama
    public function setNama($nama){
        $this->nama = $nama;
    }
    // set alamat
    public function setAlamat($alamat){
        $this->alamat = $alamat;
    }
    // set jenis kelamin
    public function setJenis_kelamin($jenis_kelamin){
        $this->jenis_kelamin = $jenis_kelamin;
    }
    // set no telepon
    public function setNo_telp($no_telp){
        $this->no_telp = $no_telp;
    }
    // set jabatan
    public function setJabatan($jabatan){
        $this->jabatan = $jabatan;
    }
    // set jurusan
    public function setJurusan($jurusan){
        $this->jurusan = $jurusan;
    }
    // set level
    public function setLevel($level){
        $this->level = $level;
    }
    // set password
    public function setPassword($password){
        $this->password = $password;
    }
    // set prodi
    public function setProdi($prodi){
        $this->prodi = $prodi;
    }
    // set status_anggota
    public function setStatus_anggota($status_anggota){
        $this->status_anggota = $status_anggota;
    }

    // get id
    public function getID(){
        return $this->id;
    }
    // get no_induk
    public function getNo_induk(){
        return $this->no_induk;
    }
    // get nama
    public function getNama(){
        return $this->nama;
    }
    // get jenis kelamin
    public function getJenis_kelamin(){
        return $this->jenis_kelamin;
    }
    // get alamat
    public function getAlamat(){
        return $this->alamat;
    }
    // get no telepon
    public function getNo_telp(){
        return $this->no_telp;
    }
    // get jabatan
    public function getJabatan(){
        return $this->jabatan;
    }
    // get jurusan
    public function getJurusan(){
        return $this->jurusan;
    }
    // get level
    public function getLevel(){
        return $this->level;
    }
    // get password
    public function getPassword(){
        return $this->password;
    }    
    // get prodi
    public function getProdi(){
        return $this->prodi;
    }    
    // get status_anggota
    public function getStatus_anggota(){
        return $this->status_anggota;
    }    
}
?>