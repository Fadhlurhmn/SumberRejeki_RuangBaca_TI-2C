<?php
include '../controllers/buku/buku_read_validate.php';
include 'admin/template/menu.php';
?>
<main id="main" class="main">
      <div class="pagetitle">
        <h1>List Buku yang Tersedia</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Buku</li>
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
                <h5 class="card-title">Data Buku</h5>
                <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle='modal' data-bs-target='#modalFormTambahPengguna'>
                    <i class="bi bi-book"></i>
                    Tambah Buku
                </button>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th></th>
                      <th>ISBN</th>
                      <th>Judul</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                  foreach ($data_buku as $buku_temp) {
                      echo "<tr>";
                      echo "<td><img src=../../public/uploads/".$buku_temp['gambar']." alt='error' style='border-radius: 8px; width: 60px; margin-top:9px;'></td>";
                      echo "<td>" . $buku_temp['isbn'] . "</td>";
                      echo "<td>" . $buku_temp['judul'] . "</td>";
                      echo "<td>" . $buku_temp['status_buku'] . "</td>";
                      

                      echo "<td>";
                      ?>
                      <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editBuku<?= $buku_temp['id'] ?>'>Edit</button>
                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#detailBuku<?= $buku_temp['id'] ?>'>Detail</button>
                        <!-- <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#hapusBuku<?= $buku_temp['id'] ?>'>Hapus</button>                     -->
                      </div>
                                            <!-- Modal Form edit Buku -->
                                            <div class='modal fade' id='editBuku<?= $buku_temp['id'] ?>' tabindex='-1' aria-labelledby='editBukuLabel<?= $buku_temp['id'] ?>' aria-hidden='true'>
                                              <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Buku</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <form class="row g-3" method="post" action="../controllers/buku/buku_edit_validate.php" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                      <div class="card">
                                                        <div class="card-body">
                                                          <!-- Multi Columns Form -->
                                                          <input type="hidden" class="form-control" name="id" value="<?= $buku_temp['id'] ?>">
                                                          <div class="row">
                                                            <div class="col-md-12">
                                                              <label for="inputName5" class="form-label">Judul Buku</label>
                                                              <textarea class="form-control" name="judul" id="inputName5" rows="2" required><?= $buku_temp['judul'] ?></textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                              <label for="inputEmail5" class="form-label">ISBN</label>
                                                              <input type="text" class="form-control" name="isbn" id="inputEmail5" value="<?= $buku_temp['isbn'] ?>" required>
                                                            </div>
                                                            <div class="col-6">
                                                              <label for="inputAddress2" class="form-label">Jumlah Buku</label>
                                                              <input type="number" class="form-control" name="jumlah" id="inputAddress2" value="<?= $buku_temp['jumlah'] ?>" required>
                                                            </div>

                                                            <div class="col-md-6">
                                                              <label for="inputPassword5" class="form-label">Penulis</label>
                                                              <input type="text" class="form-control" name="penulis" id="inputPassword5" value="<?= $buku_temp['penulis'] ?>" required>
                                                            </div>
                                                            <div class="col-6">
                                                              <label for="inputAddress2" class="form-label">Tersedia</label>
                                                              <input type="number" class="form-control" name="tersedia" id="inputAddress2" value="<?= $buku_temp['tersedia'] ?>" required>
                                                            </div>
                                                            
                                                            <div class="col-12">
                                                              <label for="inputAddress5" class="form-label">Deskripsi Buku</label>
                                                              <textarea class="form-control" name="deskripsi" id="inputAddres5s" rows="4" required><?= $buku_temp['deskripsi'] ?></textarea>
                                                            </div>
                                                            <div class="col-6">
                                                              <label for="inputAddress2" class="form-label">Status Buku</label>
                                                              <select name="status_buku" id="status_buku" class="form-select">
                                                                <option value="aman" <?= $buku_temp['status_buku'] == 'aman' ? 'selected' : '' ?>>Aman</option>
                                                                <option value="rusak" <?= $buku_temp['status_buku'] == 'rusak' ? 'selected' : '' ?>>Rusak</option>
                                                              </select>
                                                            </div>
                                                            <div class="col-12">
                                                              <label for="inputAddress5" class="form-label">Gambar Buku</label>
                                                              <input type="file" class="form-control" name="userImage" id="userImage" placeholder="Gambar Buku">
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <input type="submit" class="btn btn-warning" name="editBuku" value="Update">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                  </form><!-- End Multi Columns Form -->
                                                </div>
                                              </div>
                                            </div>




                      <!-- modal hapus -->
                      <div class='modal fade' id='hapusBuku<?= $buku_temp['id'] ?>' tabindex='-1' aria-labelledby='hapusBukuLabel<?= $buku_temp['id'] ?>' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='hapusBukuLabel<?= $buku_temp['id'] ?>'>Hapus Buku</h5>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                              <p>Apakah Anda yakin ingin menghapus buku <?= $buku_temp['judul'] ?>?</p>
                            </div>
                            <div class='modal-footer'>
                              <form action="../controllers/buku/buku_delete_validate.php" method="post">
                                <input type="hidden" name="id" value="<?= $buku_temp['id']?>">
                                <input type="submit" class="btn btn-danger" name="hapusBuku" value="Ya, Hapus">
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tidak</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- modal detail -->
                      <div class='modal fade' id='detailBuku<?= $buku_temp['id'] ?>' tabindex='-1' aria-labelledby='detailBukuLabel<?= $buku_temp['id'] ?>' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='detailBukuLabel<?= $buku_temp['id'] ?>'>Detail Buku</h5>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                              <div class="row">
                                <div class="col-lg-4 col-md-6 label">Judul </div>
                                <div class="col-lg-8 col-md-6 label">: <?= $buku_temp['judul'] ?></div>
                              </div>

                              <div class="row">
                                <div class="col-lg-4 col-md-6 label">ISBN </div>
                                <div class="col-lg-8 col-md-6 label">: <?= $buku_temp['isbn'] ?></div>
                              </div>

                              <div class="row">
                                <div class="col-lg-4 col-md-6 label">Penulis </div>
                                <div class="col-lg-8 col-md-6 label">: <?= $buku_temp['penulis'] ?></div>
                              </div>

                              <div class="row">
                                <div class="col-lg-4 col-md-6 label">Deskripsi </div>
                                <div class="col-lg-8 col-md-6 label">: <?= $buku_temp['deskripsi'] ?></div>
                              </div>

                              <div class="row">
                                <div class="col-lg-4 col-md-6 label">Jumlah </div>
                                <div class="col-lg-8 col-md-6 label">: <?= $buku_temp['jumlah'] ?></div>
                              </div>

                              <div class="row">
                                <div class="col-lg-4 col-md-6 label">Tersedia </div>
                                <div class="col-lg-8 col-md-6 label">: <?= $buku_temp['tersedia'] ?></div>
                              </div>
                              <div class="row">
                                <div class="col-lg-4 col-md-6 label">Status Buku </div>
                                <div class="col-lg-8 col-md-6 label">: <?= $buku_temp['status_buku'] ?></div>
                              </div>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
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

      <!-- Modal Form tambah Buku -->
      <div class="modal fade" id="modalFormTambahPengguna" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data Buku</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="card">
                <div class="card-body">

                  <!-- Multi Columns Form -->
                  <form class="row g-3" method="post" action="../controllers/buku/buku_create_validate.php" enctype="multipart/form-data">
                    <div class="col-md-12">
                      <br>
                      <label for="inputName5" class="form-label">Judul Buku</label>
                      <textarea class="form-control" name="judul" id="inputName5" rows="2" required placeholder="Judul dari buku"></textarea>
                    </div>
                    <div class="col-md-6">
                      <label for="inputEmail5" class="form-label">ISBN</label>
                      <input type="text" class="form-control" name="isbn" id="inputEmail5" placeholder="ISBN" required>
                    </div>
                    <div class="col-6">
                      <label for="inputAddress2" class="form-label">Jumlah Buku</label>
                      <input type="number" class="form-control" name="jumlah" id="inputAddress2" placeholder="Jumlah Buku" required>
                    </div>
                    <div class="col-md-6">
                      <label for="inputPassword5" class="form-label">Penulis</label>
                      <input type="text" class="form-control" name="penulis" id="inputPassword5" placeholder="Penulis" required>
                    </div>
                    <div class="col-6">
                      <label for="inputAddress2" class="form-label">Tersedia</label>
                      <input type="number" class="form-control" name="tersedia" id="inputAddress2" placeholder="Buku yang Tersedia" required>
                    </div>
                    <div class="col-12">
                      <label for="inputAddress5" class="form-label">Deskripsi Buku</label>
                      <textarea class="form-control" name="deskripsi" id="inputAddres5s" rows="4" required placeholder="Deskripsi tentang buku tersebut"></textarea>
                    </div>
                    <div class="col-12">
                      <!-- <form name="frmImage" enctype="multipart/form-data" action="" method="post"> -->
                        <label for="inputAddress5" class="form-label">Gambar Buku</label>
                          <input type="file" class="form-control" name="userImage" id="userImage" placeholder="Deskripsi" required>
                          </div>
                      <!-- </form> -->
                    </div>
                  <!-- </div> -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" name="saveBukuBaru" value="Simpan">
              </div>
            </form><!-- End Multi Columns Form -->
          </div>
        </div>
      </div>

      
      
    </main>
        <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPpDmM/xI9aJQ5FfBI" crossorigin="anonymous"></script>

    <!-- End #main -->