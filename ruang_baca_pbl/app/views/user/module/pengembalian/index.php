
<?php
    include '../views/user/template/menu.php';

    $id_anggota = $_SESSION['id'];
    include '../controllers/transaksi/peminjaman/transaksi_read_id_peminjaman_validate.php';

    include '../controllers/transaksi/pengembalian/transaksi_read_id_pengembalian_validate.php';
    ?>  

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Pengembalian Buku</h1>
            <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item "><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Pengembalian Buku</li>
            </ol>
          </nav>
        </div>
      <!-- End Page Title -->

      <!-- data peminjaman -->
        <section class="section">
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Buku yang telah dikembalikan</h5>
                    <table class="table datatable table-hover">
                    <thead>
                        <th>ID peminjaman</th>
                        <th data-sortable="false">Tanggal pengembalian</th>
                        <th data-sortable="false"></th>
                        <th data-sortable="false">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $page = "pengembalian";

                    // untuk loop peminjaman
                    $index = 0;
                    
                    // untuk loop pengembalian
                    $key = 0;
                    // print data pengembalian
                    foreach ($data_pengembalian as $pengembalian){
                        if ($pengembalian['status'] == 'selesai'){

                          // store ke array data detail peminjaman
                          foreach ($data_peminjaman_byID as $peminjaman){
                            if ($peminjaman['id'] == $pengembalian['id_peminjaman']){
                            $id_peminjaman[$index] = $peminjaman['id'];
                            $deadline[$index] = date('d-m-Y', strtotime($peminjaman['tanggal_pengembalian']));
                            include '../controllers/transaksi/peminjaman/transaksi_read_peminjaman_detail_validate.php';
                            $index++;
                            }
                            
                          }

                          $no = $key +1;
                          echo "<tr>";
                          echo "<td>" .$pengembalian['id_peminjaman']."</td>";
                          $convertedDate = date('d-m-Y', strtotime($pengembalian['tanggal_buku_dikembalikan']));
                            echo "<td>" . $convertedDate . "</td>";
                            ?>
                            <td>
                              <button type='button' class='btn btn-secondary btn-color btn-sm' data-bs-toggle='modal' data-bs-target='#detailBuku<?= $id_peminjaman[$key] ?>'>Detail</button> 
                            </td>
                            <div class='modal fade' id='detailBuku<?= $id_peminjaman[$key] ?>' tabindex='-1' aria-labelledby='detailBukuLabel<?= $id_peminjaman[$key] ?>' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='detailBukuLabel<?= $id_peminjaman[$key] ?>'>Detail Buku</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <ul>
                                            <?php
                                            // print data detail peminjaman
                                            foreach ($data_peminjaman[$key] as $detail_peminjamans){
                                                ?>
                                                <li><b><?= $detail_peminjamans['judul'] ?> </b> telah dikembalikan</li>
                                            <?php
                                            }
                                            ?>
                                            </ul>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // if ($id_peminjaman[$key] == $pengembalian['id_peminjaman']){
                              $tanggal_pengembalian = date('d-m-Y', strtotime($pengembalian['tanggal_buku_dikembalikan']));
                              $diff = strtotime($deadline[$key]) - strtotime($tanggal_pengembalian);  
                              $days_difference = floor($diff / (60 * 60 * 24));
                              if ($days_difference < 0){
                                echo "<td><span class='badge bg-danger'>terlambat</span></td>";
                              } else {
                                echo "<td><span class='badge bg-success'>" . $pengembalian['status'] . "</span></td>";
                              }
                            //}
                            // echo "<td><span class='badge bg-success'>" . $pengembalian['status'] . "</span></td>";
                          echo "</tr>";
                          $key++;
                        }
                        
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </section>
    </main>
    <!-- End #main -->
