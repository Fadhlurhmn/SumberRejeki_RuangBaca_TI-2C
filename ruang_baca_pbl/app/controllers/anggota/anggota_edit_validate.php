<?php
require _DIR_ . '/../../models/anggota/anggota_edit.php';
require '../pesan_kilat.php';

$anggota = new anggota_edit;
session_start();
// pengecekan apabila variabel editPengguna sudah di set
if(isset($_POST['editPengguna'])){

  // melakukan set pada variabel anggota dengan variabel POST
  $anggota->setNo_induk($_POST['no_induk']);
  $anggota->setNama($_POST['nama']);
  $anggota->setJenis_kelamin($_POST['jenis_kelamin']);
  $anggota->setAlamat($_POST['alamat']);
  $anggota->setNo_telp($_POST['no_telp']);
  $anggota->setJabatan($_POST['jabatan']);
  $anggota->setProdi($_POST['prodi']);
  $anggota->setJurusan($_POST['jurusan']);
  $anggota->setID($_POST['id']);
  $anggota->setStatus_anggota($_POST['status_anggota']);

  // melakukan set level sesuai dengan jabatan nya
  if($anggota->getJabatan() == 'Admin'){
      $anggota->setLevel('admin');
  }else if($anggota->getJabatan() == 'Dosen' || $anggota->getJabatan() == 'Mahasiswa'){
      $anggota->setLevel('user');
  }

   // Check if no_induk is already used by another user
   $existing_no_induk = $anggota->get_no_induk_by_id($anggota->getID());
   if ($existing_no_induk && $existing_no_induk !== $anggota->getNo_induk()) {
     pesan('danger', "No Induk yang dimasukkan sudah tersedia");
     header("Location: ../../views/index.php?page=anggota");
     exit();
   }
   
  // pengecekan apabila password tidak kosong
  if ($_POST['password'] != ''){

    // pembuatan salt dan hashed password
    $anggota->setPassword($_POST['password']);
    $salt = bin2hex(random_bytes(16));
    $combined_password = $salt . $anggota->getPassword();
    $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

    // melakukan edit anggota ke database
    if($anggota->edit_anggota_with_password($anggota->getID(), $anggota->getNo_induk(), $anggota->getNama(), $anggota->getAlamat(), $anggota->getJenis_kelamin(), $anggota->getNo_telp(), $anggota->getJabatan(), $anggota->getJurusan(), $anggota->getLevel(), $hashed_password, $salt, $anggota->getProdi(), $anggota->getStatus_anggota())){
      pesan('success', "Data Anggota berhasil diedit.");
    }else{
      pesan('danger', "Data Anggota gagal diedit.");
    }
    header("Location: ../../views/index.php?page=anggota");
    
    // apabila password tidak diinputkan atau kosong
  } else {
    
    // melakukan edit anggota ke database
    if($anggota->edit_anggota_no_password($anggota->getID(), $anggota->getNo_induk(), $anggota->getNama(),$anggota->getAlamat(), $anggota->getJenis_kelamin(),$anggota->getNo_telp(),$anggota->getJabatan(),$anggota->getJurusan(),$anggota->getLevel(),$anggota->getProdi(), $anggota->getStatus_anggota())){
      pesan('success', "Data Anggota berhasil diedit.");
    }else{
      pesan('danger', "Data Anggota gagal diedit.");
    }
    header("Location: ../../views/index.php?page=anggota");
  }

// pengecekan apabila variabel editPassword sudah di set, jika variabel editPengguna tidak di set 
} elseif (isset($_POST['editPassword'])){

  // pengecekan apabila password tidak kosong
  if($_POST['newpassword'] != ''){

    // persiapan password inputan dengan password database
    $id = $_POST['id'];
    $query = "SELECT salt, password as hashed_password FROM anggota WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    $salt = $row['salt'];
    $hashed_password = $row['hashed_password'];
    $combined_password = $salt . $_POST['password'];
      
      // melakukan pengecekan kecocokan password inputan dengan database
      if (password_verify($combined_password, $hashed_password)){
        $combined_new_password = $salt . $_POST['newpassword'];
        $hashed_new_password = password_hash($combined_new_password, PASSWORD_BCRYPT);

        // dilakukan update password
        if ($anggota->edit_password($_POST['id'], $hashed_new_password, $salt)){
          pesan('success', "Password berhasil diubah.");

        // update password gagal
        } else {
          pesan('danger', "Update password gagal!");
        }

      // password inputan tidak sama dengan password di database
      } else {
        pesan('danger', "Password anda salah!");
      }

    // apabila password tidak diinputkan atau kosong
    } else {
      pesan('danger', "Update password gagal, tidak boleh kosong!");
    }
    header("Location:../../views/index.php?page=profile");
}
?>