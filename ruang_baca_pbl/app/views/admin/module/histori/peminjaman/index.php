<?php
include '../controllers/transaksi/peminjaman/transaksi_read_peminjaman_validate.php';
include 'admin/template/menu.php';
?>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Histori</li>
                <li class="breadcrumb-item active">Peminjaman</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Histori Peminjaman Buku</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID Peminjaman</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Detail Informasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data_peminjaman as $histori_peminjaman_temp) {
                                    echo "<tr>";
                                    echo "<td>" . $histori_peminjaman_temp['id_peminjaman'] . "</td>";
                                    echo "<td>" . $histori_peminjaman_temp['nama_peminjam'] . "</td>";
                                    echo "<td>" . $histori_peminjaman_temp['tanggal_peminjaman'] . "</td>";
                                    echo "<td>";
                                    ?>
                                    <a href="index.php?page=histori/peminjaman/detail&id=<?=$histori_peminjaman_temp['id_peminjaman']?>" type="button" class="btn btn-primary">Detail</a>

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
</main>
