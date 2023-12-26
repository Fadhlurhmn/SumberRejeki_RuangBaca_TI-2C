<?php
include 'admin/template/menu.php';
include '../controllers/transaksi/pengembalian/transaksi_read_pengembalian_konfirm_validate.php';
?>
<main id="main" class="main">
      <div class="pagetitle">
        
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Validasi</li>
            <li class="breadcrumb-item active">Pengembalian</li>
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
                <h5 class="card-title">Validasi Pengembalian Buku</h5>
                
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>ID Pengembalian</th>
                      <th>Nama Peminjam</th>
                      <th>Tanggal Dikembalikan</th>
                      <th>Verifikasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach($data_pengembalian as $pengembalian_temp){
                        echo "<tr>";
                        echo "<td>". $pengembalian_temp['id_pengembalian']."</td>";
                        echo "<td>". $pengembalian_temp['nama']."</td>";
                        echo "<td>". $pengembalian_temp['tanggal_buku_dikembalikan']."</td>";
                        ?>
                        <td>
                            <a href="index.php?page=validasi/pengembalian/detail&id=<?=$pengembalian_temp['id_pengembalian']?>" type="button" class="btn btn-primary">Detail</a>
                        </td>
                        <?php
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
    </main>
    <!-- Bootstrap CSS -->
<link href="path/to/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript (Popper.js and Bootstrap JS) -->
<script src="path/to/popper.js/popper.min.js"></script>
<script src="path/to/bootstrap/js/bootstrap.min.js"></script>

    <!-- End #main -->