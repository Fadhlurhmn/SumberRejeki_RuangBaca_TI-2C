<?php
include '../models/transaksi/transaksi_peminjaman.php';
include 'admin/template/menu.php';
$id_peminjaman = $_GET['id'];
$peminjaman = new transaksi_peminjaman;
$data_peminjaman = $peminjaman->tampil_semua_peminjaman_detail($id_peminjaman);
?>

<main id="main" class="main">
    <section class="section profile">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <h5 class="card-title">Informasi Peminjaman</h5>
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Data Pribadi</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#buku-overview">Data Buku</button>
                            </li>
                        </ul>
                        <form action="../controllers/admin/admin_peminjaman_validate.php" method="post"> <!-- Ganti "proses_form.php" dengan aksi formulir yang sesuai -->
                          <input type="hidden" class="form-control" value="<?= $id_peminjaman ?>" name="id_peminjaman">  
                          <div class="tab-content pt-2">
                                <!-- query -->
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>
                                    <?php $informasi_peminjam = $data_peminjaman[0];?>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama Peminjam</div>
                                        <div class="col-lg-9 col-md-8"><?= $informasi_peminjam['nama']?></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-3 col-md-4 label">NIM/NIP</div>
                                      <div class="col-lg-9 col-md-8"><?= $informasi_peminjam['no_induk']?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Prodi</div>
                                      <div class="col-lg-9 col-md-8"><?= $informasi_peminjam['prodi'] ?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Jurusan</div>
                                      <div class="col-lg-9 col-md-8"><?= $informasi_peminjam['jurusan']?></div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg-3 col-md-4 label">No Telepon</div>
                                      <div class="col-lg-9 col-md-8"><?= $informasi_peminjam['no_telp']?></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade buku-overview pt-3" id="buku-overview">
                                  <h5 class="card-title">Buku Details</h5>
                                  <?php foreach ($data_peminjaman as $buku_yang_dipinjam) : ?>
                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">Judul</div>
                                      <div class="col-lg-9 col-md-8"><?= $buku_yang_dipinjam['judul'] ?></div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-3 col-md-4 label">ISBN</div>
                                      <div class="col-lg-9 col-md-8"><?= $buku_yang_dipinjam['isbn'] ?></div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-lg-3 col-md-4 col-form-label">Status</label>
                                      <div class="col-lg-9 col-md-8">
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" value="acc" id="status_acc<?= $buku_yang_dipinjam['id_buku'] ?>" name="status[<?= $buku_yang_dipinjam['id_buku'] ?>]" required>
                                              <label class="form-check-label" for="status_acc<?= $buku_yang_dipinjam['id_buku'] ?>">ACC</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" value="tolak" id="status_tolak<?= $buku_yang_dipinjam['id_buku'] ?>" name="status[<?= $buku_yang_dipinjam['id_buku'] ?>]" required>
                                              <label class="form-check-label" for="status_tolak<?= $buku_yang_dipinjam['id_buku'] ?>">Tolak</label>
                                          </div>
                                      </div>
                                  </div>

                                  <input type="hidden" class="form-control" value="<?= $buku_yang_dipinjam['id_buku'] ?>" name="id_buku[]">
                                  
                                  <div class="form-group row">
                                      <label class="col-lg-3 col-md-4 col-form-label">Keterangan</label>
                                      <div class="col-lg-9 col-md-8">
                                          <input type="text" class="form-control" name="keterangan[<?= $buku_yang_dipinjam['id_buku'] ?>]" value="<?= $buku_yang_dipinjam['keterangan'] ?>" required>
                                      </div>
                                  </div>
                                  <br>
                              <?php endforeach; ?>
                              </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 label">
                                            <a href="index.php?page=validasi/peminjaman" class="btn btn-secondary">Kembali</a>
                                            <input type="submit" class="btn btn-success float-end" value="Submit" name="validate_peminjaman">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
