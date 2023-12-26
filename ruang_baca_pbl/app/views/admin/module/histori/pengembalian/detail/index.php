<?php
include '../models/transaksi/transaksi_pengembalian.php';
include 'admin/template/menu.php';
$id_pengembalian = $_GET['id'];
$pengembalian = new transaksi_pengembalian;
$data_pengembalian = $pengembalian->tampil_semua_pengembalian_detail($id_pengembalian);

?>
<main id="main" class="main">
<section class="section profile">
      <div class="row">


        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
            <h5 class="card-title">Informasi pengembalian</h5>
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
                  <?php $informasi_peminjam = $data_pengembalian[0];?>
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
                    <a href="index.php?page=histori/pengembalian"class="btn btn-secondary">Kembali</a>
                    </div>
                    
                  </div>

                </div>
                <div class="tab-pane fade buku-overview pt-3" id="buku-overview">
                    <h5 class="card-title">Buku Details</h5>

                    <?php foreach ($data_pengembalian as $buku_yang_dikembalikan) : ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Judul</div>
                            <div class="col-lg-9 col-md-8"><?= $buku_yang_dikembalikan['judul'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">ISBN</div>
                            <div class="col-lg-9 col-md-8"><?= $buku_yang_dikembalikan['isbn'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tanggal Peminjaman</div>
                            <div class="col-lg-9 col-md-8"><?= $buku_yang_dikembalikan['tanggal_peminjaman'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Deadline</div>
                            <div class="col-lg-9 col-md-8"><?= $buku_yang_dikembalikan['deadline'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tanggal Buku Dikembalikan</div>
                            <div class="col-lg-9 col-md-8"><?= $buku_yang_dikembalikan['tanggal_buku_dikembalikan'] ?></div>
                        </div>
                        <?php
                        // Menghitung selisih waktu antara tanggal deadline dan tanggal buku dikembalikan
                        $tanggal_deadline = strtotime($buku_yang_dikembalikan['deadline']);
                        $tanggal_dikembalikan = strtotime($buku_yang_dikembalikan['tanggal_buku_dikembalikan']);
                        $selisih_waktu = $tanggal_dikembalikan - $tanggal_deadline;

                        // Menentukan status terlambat atau tidak
                        if ($selisih_waktu > 0) {
                            $status = "Terlambat";
                            $selisih_hari = floor($selisih_waktu / (60 * 60 * 24));
                        } else {
                            $status = "Tidak Terlambat";
                            $selisih_hari = 0;
                        }
                        ?>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Status</div>
                            <div class="col-lg-9 col-md-8"><?= $status ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Selisih Hari</div>
                            <div class="col-lg-9 col-md-8"><?= $selisih_hari ?> hari</div>
                        </div>
                        <br>
                    <?php endforeach; ?>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">
                            <a href="index.php?page=histori/pengembalian"class="btn btn-secondary">Kembali</a>
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