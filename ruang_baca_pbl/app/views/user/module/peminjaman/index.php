<?php
    include '../views/user/template/menu.php';

    $id_anggota = $_SESSION['id'];
    include '../controllers/transaksi/peminjaman/transaksi_read_id_peminjaman_validate.php';

    include '../controllers/transaksi/pengembalian/transaksi_read_id_pengembalian_validate.php';

    
    ?>

    <style>
        .btn-color {
            background-color: #012348;
        }
    </style>                                
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Peminjaman Buku</h1>
            <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item "><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Peminjaman Buku</li>
            </ol>
          </nav>
        </div>
      <!-- End Page Title -->

        <!-- pesan kilat -->
      <?php
        if (isset($_SESSION['_flashdata'])) {
            foreach ($_SESSION['_flashdata'] as $key => $val) {
                echo get_flashdata($key);
            }
        }
        ?>

      <!-- data peminjaman -->
        <section class="section">
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Status Buku yang dipinjam</h5>
                    <table class="table table-hover datatable">
                    <thead>
                        <th>ID</th>
                        <th data-sortable="false">Deadline</th>
                        <th data-sortable="false"></th>
                        <th data-sortable="false">Status</th>
                        <th data-sortable="false">Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $key = 0;

                    // menampilkan seluruh data peminjaman
                    foreach ($data_peminjaman_byID as $peminjaman) {
                        $input_date = date('d-m-Y', strtotime($peminjaman['tanggal_pengembalian']));
                        $current_date = date('d-m-Y');
                        $diff = strtotime($input_date) - strtotime($current_date);
                        $days_difference = floor($diff / (60 * 60 * 24));
    
                        $status_pengembalian='';

                        // set status pengembalian
                        foreach ($data_pengembalian as $pengembalian) {
                            if ($pengembalian['id_peminjaman'] == $peminjaman['id']) {
                                if ($pengembalian['status'] == 'selesai') {
                                    $status_pengembalian = " ";
                                } else {
                                    $status_pengembalian = " ";
                                }
                                break;
                            }
                        }
                    
                        // cek status pengembalian untuk menampilkan peringatan deadline 
                        if (empty($status_pengembalian)) {
                            if ($days_difference >= 2) {
                                $status_pengembalian = " ";
                            } elseif ($days_difference < 2 && $days_difference >= 0) {
                                $status_pengembalian = "<span class='badge rounded-pill bg-danger' style='float:right;'><i class='bi bi-clock'></i> ".$days_difference." day left</span>";
                            } else {
                                $status_pengembalian = "<span class='badge rounded-pill bg-danger' style='float:right;'><i class='bi bi-clock'></i> terlambat</span>";
                            }
                        }
                    

                        $no = $key +1;
                        echo "<tr >";
                        echo "<td>".$peminjaman['id']."</td>";

                        $id_peminjaman = $peminjaman['id'];
                        
                        $page = "peminjaman";
                        include '../controllers/transaksi/peminjaman/transaksi_read_peminjaman_detail_validate.php';

                        // print tanggal_deadline
                        if ($peminjaman['status_peminjaman'] !== 'tolak'){
                        
                            switch ($peminjaman['status_peminjaman']){
                                case "pending":
                                    echo "<td></td>";
                                    break;
                                case "terkonfirmasi":
                                    $set = false; // Set the flag to false initially
                                    foreach ($data_peminjaman[$key] as $detail_peminjamans) {
                                        if ($detail_peminjamans['status_buku'] !== 'tolak') {
                                            $set = true; // Set the flag to true when 'tolak' and not 'pending' or 'acc'
                                            break; // Exit the loop once 'ditolak' is displayed
                                        }
                                    }

                                    // Check the flag after the loop to decide whether to display 'terkonfirmasi' or 'ditolak'
                                    if ($set == false) {
                                        echo "<td></td>";
                                    } else {
                                        $convertedDate = date('d-m-Y', strtotime($peminjaman['tanggal_pengembalian']));
                                        echo "<td>" . $convertedDate . $status_pengembalian ."</td>";
                                    }
                                    break;
                            }
                            ?>

                            <!-- print detail_peminjaman button -->
                            <td>
                                <button type='button' class='btn btn-secondary btn-color btn-sm' data-bs-toggle='modal' data-bs-target='#detailBuku<?= $id_peminjaman ?>'>Detail</button>    
                            </td>
                            <div class='modal fade' id='detailBuku<?= $id_peminjaman ?>' tabindex='-1' aria-labelledby='detailBukuLabel<?= $id_peminjaman ?>' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='detailBukuLabel<?= $id_peminjaman ?>'>Detail Buku yang dipinjam</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <ul>
                                            <?php
                                            // isi buku yang dipinjam
                                            foreach ($data_peminjaman[$key] as $detail_peminjamans){
                                                if ($detail_peminjamans['status_buku'] == 'acc'){
                                                    ?>
                                                    <li>Peminjaman "<?=$detail_peminjamans['judul'];?>" <b>diterima</b></li> 
                                                    <?php
                                                } elseif ($detail_peminjamans['status_buku'] == 'pending') {
                                                    ?>
                                                    <li><?=$detail_peminjamans['judul'];?></li> 
                                                    <?php
                                                } else {
                                                    ?>
                                                    <li>Peminjaman "<?=$detail_peminjamans['judul'];?>" <b style="color: red;">ditolak</b><br> karena <?=$detail_peminjamans['keterangan'];?></li> 
                                                    <?php
                                                }
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
                        } else {
                          echo "<td></td>";
                          echo "<td></td>";
                        }

                        // print status peminjaman
                        echo "<td>";
                        switch ($peminjaman['status_peminjaman']){
                            case "pending":
                                echo "<span class='badge bg-warning'>pending</span>";
                                break;
                            case "terkonfirmasi":
                                $set = false; // Set the flag to false initially
                                foreach ($data_peminjaman[$key] as $detail_peminjamans) {
                                    if ($detail_peminjamans['status_buku'] !== 'tolak') {
                                        $set = true; // Set the flag to true when 'tolak' and not 'pending' or 'acc'
                                        break; // Exit the loop once 'ditolak' is displayed
                                    }
                                }

                                // Check the flag after the loop to decide whether to display 'terkonfirmasi' or 'ditolak'
                                if ($set == false) {
                                    echo "<span class='badge bg-danger'>ditolak</span>";
                                } else {
                                    echo "<span class='badge bg-success'>terkonfirmasi</span>";
                                }
                                break;
                        }
                        echo "</td>";

                        // print status pengembalian
                        echo "<td>";
                        switch ($peminjaman['status_peminjaman']) {
                            case "pending":
                                $_SESSION['allow_peminjaman'] = "unallowed";
                                echo "";
                                break;
                            case "terkonfirmasi":
                                $set_tolak = false; // Set the flag to false initially
                                foreach ($data_peminjaman[$key] as $detail_peminjamans) {
                                    if ($detail_peminjamans['status_buku'] !== 'tolak') {
                                        $set_tolak = true; // Set the flag to true when 'tolak' and not 'pending' or 'acc'
                                        break; // Exit the loop once 'ditolak' is displayed
                                    }
                                }

                                // Check the flag after the loop to decide whether to display 'terkonfirmasi' or 'ditolak'
                                if ($set_tolak == false) {
                                    echo "";
                                } else {
                                    $set = false;
                                    foreach ($data_pengembalian as $pengembalian) {
                                        if ($pengembalian['id_peminjaman'] == $peminjaman['id']) {
                                            if ($pengembalian['status'] == 'selesai') {
                                                echo "<span class='badge bg-success'>Telah Dikembalikan</span>";
                                                $set = true;
                                            } else if ($pengembalian['status'] == 'pending'){
                                                echo "<span class='badge bg-warning'>menunggu konfirmasi</span>";
                                                $set = true; 
                                            }
                                            break; 
                                        }
                                    }
// unset($_SESSION['allow_peminjaman']);
                                    // button kembalikan bila peminjaman dikonfirmasi
                                    if ($set == false){
                                    $_SESSION['allow_peminjaman'] = "unallowed";
                                        echo "<form action='../controllers/transaksi/pengembalian/transaksi_tambah_pengembalian.php' method='POST'>";
                                        echo "<button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#verticalycentered'>kembalikan</button>";
                                        echo "<input type='hidden' name='id' value='" . $peminjaman['id'] . "'>";
                                        echo "<div class='modal fade' id='verticalycentered' tabindex='-1'>
                                                <div class='modal-dialog modal-dialog-centered'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                        <h5 class='modal-title'>Verifikasi</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <div class='modal-body'>
                                                        Apa anda ingin mengembalikan buku ini?
                                                        </div>
                                                        <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Kembali</button>
                                                        <button type='submit' class='btn btn-success'>Iya</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                    echo "</form>";
                                    }
                                }
                                break;
                        }
                        echo "</td>";

                        // end tabel
                        echo "</tr>";
                        $key += 1;
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

