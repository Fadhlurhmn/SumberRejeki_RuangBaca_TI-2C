<?php
include '../controllers/anggota/anggota_read_validate.php';
include 'admin/template/menu.php';

?>
<main id="main" class="main">
      <div class="pagetitle">
        <h1>List Pengguna yang Tersedia</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Anggota</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <?php
        if (isset($_SESSION['_flashdata'])) {
            foreach ($_SESSION['_flashdata'] as $key => $val) {
                echo get_flashdata($key);
            }
        }
      ?>
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data Pengguna</h5>
                <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle='modal' data-bs-target='#modalFormTambahPengguna'>
                    <i class="bi bi-person-plus-fill"></i>
                    Tambah Pengguna
                </button>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>NIM/NIP</th>
                      <th>Prodi</th>
                      <th>Jurusan</th>
                      <th>Jabatan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                  foreach ($data_anggota as $anggota_temp) {
                      echo "<tr>";
                      echo "<td>" . $anggota_temp['nama'] . "</td>";
                      echo "<td>" . $anggota_temp['no_induk'] . "</td>";
                      echo "<td>" . $anggota_temp['prodi'] . "</td>";
                      echo "<td>" . $anggota_temp['jurusan'] . "</td>";
                      echo "<td>" . $anggota_temp['jabatan'] . "</td>";
                      echo "<td>" . $anggota_temp['status_anggota'] . "</td>";
                      

                      echo "<td>";
                      ?>
                      <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editPengguna<?= $anggota_temp['id'] ?>'>Edit</button>
                            <!-- <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#hapusPengguna<?= $anggota_temp['id'] ?>'>Hapus</button> -->
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#detailPengguna<?= $anggota_temp['id'] ?>'>Detail</button>
                            
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editPengguna<?= $anggota_temp['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editPenggunaModal" aria-hidden="true">
                              
                              <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editPenggunaModal">Edit Data Anggota : <?= $anggota_temp['id']?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>

                                  <div class="modal-body">
                                    <div class="card">
                                      <div class="card-body">

                                        <!-- Multi Columns Form -->
                                        <form class="row g-3" method="post" action="../controllers/anggota/anggota_edit_validate.php">
                                          <input type="hidden" class="form-control" name="id" id="id" value="<?= $anggota_temp['id'] ?>">
                                          <div class="col-md-12">
                                            <br>
                                            <label for="inputName">Nama Pengguna</label>
                                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $anggota_temp['nama'] ?>" required>
                                          </div>
                                          <div class="col-md-6">
                                            <!-- <br> -->
                                            <label for="inputName">NIM/NIP</label>
                                            <input type="text" class="form-control" name="no_induk" id="no_induk" value="<?= $anggota_temp['no_induk'] ?>" required>
                                          </div>
                                          <div class="col-md-6">
                                            <!-- <br> -->
                                            <label for="inputName">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                          </div>
                                          
                                          <div class="col-md-12">
                                            <!-- <br> -->
                                            <label for="inputName">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $anggota_temp['alamat'] ?>" required>
                                          </div>
                                          <div class="col-md-8">
                                            <!-- <br> -->
                                            <label for="inputName">No Telepon</label>
                                            <input type="number" class="form-control" name="no_telp" id="no_telp" value="<?= $anggota_temp['no_telp'] ?>" required>
                                          </div>
                                          <div class="col-md-4">
                                            <!-- <br> -->
                                            <label for="inputName">Status Anggota</label>
                                            <select name="status_anggota" id="status_anggota" class="form-select">
                                              <option value="aktif" <?= $anggota_temp['status_anggota'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                              <option value="non_aktif" <?= $anggota_temp['status_anggota'] == 'non_akftif' ? 'selected' : '' ?>>Non-Aktif</option>
                                            </select>
                                          </div>
                                          <div class="col-md-7">
                                            <label for="" class="form-label">Jurusan</label>
                                            <select name="jurusan" id="jurusan" class="form-select" required>
                                              <option value="Administrasi Niaga" <?= $anggota_temp['jurusan'] == 'Administrasi Niaga' ? 'selected' : '' ?>>Administrasi Niaga</option>
                                              <option value="Akuntansi" <?= $anggota_temp['jurusan'] == 'Akuntansi' ? 'selected' : '' ?>>Akuntansi</option>
                                              <option value="Teknik Kimia" <?= $anggota_temp['jurusan'] == 'Teknik Kimia' ? 'selected' : '' ?>>Teknik Kimia</option>
                                              <option value="Teknik Elektro" <?= $anggota_temp['jurusan'] == 'Teknik Elektro' ? 'selected' : '' ?>>Teknik Elektro</option>
                                              <option value="Teknik Sipil" <?= $anggota_temp['jurusan'] == 'Teknik Sipil' ? 'selected' : '' ?>>Teknik Sipil</option>
                                              <option value="Teknik Mesin" <?= $anggota_temp['jurusan'] == 'Teknik Mesin' ? 'selected' : '' ?>>Teknik Mesin</option>
                                              <option value="Teknologi Informasi" <?= $anggota_temp['jurusan'] == 'Teknologi Informasi' ? 'selected' : '' ?>>Teknologi Informasi</option>
                                            </select>
                                          </div>
                                          <div class="col-md-5">
                                            <label for="" class="form-label">Jabatan</label>
                                            <select name="jabatan" id="jabatan" class="form-select">
                                              <option value="Mahasiswa" <?= $anggota_temp['jabatan'] == 'Mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
                                              <option value="Dosen" <?= $anggota_temp['jabatan'] == 'Dosen' ? 'selected' : '' ?>>Dosen</option>
                                              <option value="Admin" <?= $anggota_temp['jabatan'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                            </select>
                                          </div>
                                          <div class="col-7">
                                            <label for="" class="form-label">Program Studi</label>
                                            <input type="text" class="form-control" name="prodi" id="prodi" value="<?= $anggota_temp['prodi'] ?>">
                                          </div>
                                          <div class="col-5">
                                            <label for="" class="form-label">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                              <option value="L" <?= $anggota_temp['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                              <option value="P" <?= $anggota_temp['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                      <input type="submit" class="btn btn-warning" name="editPengguna" value="Update">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detailPengguna<?= $anggota_temp['id']?>" tabindex="-1" role="dialog" aria-labelledby="detailPenggunaModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="detailPenggunaModal">Detail Anggota : <?= $anggota_temp['no_induk']?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">Nama </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['nama'] ?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">NIM/NIP </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['no_induk'] ?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">Jabatan </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['jabatan'] ?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">Program Studi </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['prodi'] ?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">Jurusan </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['jurusan'] ?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">Alamat </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['alamat'] ?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">No. Telepon </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['no_telp'] ?></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">Jenis Kelamin </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-4 col-md-6 label">Status Anggota </div>
                                      <div class="col-lg-8 col-md-6 label">: <?= $anggota_temp['status_anggota'] == 'aktif' ? 'Aktif' : 'Non-Aktif' ?></div>
                                    </div>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="hapusPengguna<?= $anggota_temp['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusPenggunaModal" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="hapusPenggunaModal">Hapus Pengguna</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <p>Anda yakin ingin menghapus pengguna <?= $anggota_temp['nama'] ?>?</p>
                                      </div>
                                      <div class="modal-footer">
                                        <form method="post" action="../controllers/anggota/anggota_delete_validate.php">
                                          <input type="hidden" name="id" value="<?= $anggota_temp['id'] ?>">
                                          <input type="submit" class="btn btn-danger" name="hapusPengguna" value="Hapus">
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                      </div>
                                  </div>
                              </div>
                          </div>

                        </div>
                      <?php
                      echo "</td>";
                      echo "</tr>";
                  }
                  ?>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Modal Form tambah Pengguna -->
      <div class="modal fade" id="modalFormTambahPengguna" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data Pengguna</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="card">
                <div class="card-body">

                  <!-- Multi Columns Form -->
                  <form class="row g-3" method="post" action="../controllers/anggota/anggota_create_validate.php">
                    <div class="col-md-12">
                      <br>
                      <label for="inputName5" class="form-label">Nama Pengguna</label>
                      <input type="text" class="form-control" name="nama" id="inputName5" placeholder="Nama" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputEmail5" class="form-label">NIM/NIP</label>
                      <input type="text" class="form-control" name="no_induk" id="inputEmail5" placeholder="Nomor Identitas" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputPassword5" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" id="inputPassword5" placeholder="password" required>
                    </div>
                    <div class="col-12">
                      <label for="inputAddress5" class="form-label">Alamat</label>
                      <input type="text" class="form-control" name="alamat" id="inputAddres5s" placeholder="Alamat" required>
                    </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">No Telepon</label>
                      <input type="number" class="form-control" name="no_telp" id="inputAddress2" placeholder="Nomor Telepon" required>
                    </div>

                    <div class="col-md-7">
                      <label for="" class="form-label">Jurusan</label><br>
                      <select class="form-select" name="jurusan" id="" required>
                        <option value="Administrasi Niaga">Administrasi Niaga</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Teknik Kimia">Teknik Kimia</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                      </select>
                    </div>
                    <div class="col-md-5">
                      <label for="" class="form-label">Jabatan</label><br>
                      <select class="form-select" name="jabatan" id="" required>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Dosen">Dosen</option>
                        <option value="Admin">Admin</option>
                      </select>
                    </div>
                    <div class="col-8">
                      <label for="inputAddress2" class="form-label">Program Studi</label>
                      <input type="text" class="form-control" name="prodi" id="inputAddress2" placeholder="Program Studi" required>
                    </div>
                    <div class="col-4">
                      <label for="" class="form-label">Jenis Kelamin</label><br>
                      <select class="form-select" name="jenis_kelamin" id="" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" name="savePenggunaBaru" value="Simpan">
              </div>
            </form><!-- End Multi Columns Form -->
          </div>
        </div>
      </div>

      
      
    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPpDmM/xI9aJQ5FfBI" crossorigin="anonymous"></script>

    <!-- End #main -->