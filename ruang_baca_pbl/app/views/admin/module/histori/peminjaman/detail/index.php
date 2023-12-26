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
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">
                    <a href="index.php?page=histori/peminjaman" class="btn btn-secondary">Kembali</a>
                    </div>
                    
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

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Status</div>
                            <div class="col-lg-9 col-md-8"><?= $buku_yang_dipinjam['status_buku'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Keterangan</div>
                            <div class="col-lg-9 col-md-8"><?= $buku_yang_dipinjam['keterangan'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Deadline</div>
                            <div class="col-lg-9 col-md-8"><?= $buku_yang_dipinjam['deadline'] ?></div>
                        </div>
                        <br>
                    <?php endforeach; ?>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">
                            <a href="index.php?page=histori/peminjaman"class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>



              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
    </main>