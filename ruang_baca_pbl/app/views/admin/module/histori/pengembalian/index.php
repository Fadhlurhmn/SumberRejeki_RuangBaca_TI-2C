<?php
include '../controllers/transaksi/pengembalian/transaksi_read_pengembalian_validate.php';
include 'admin/template/menu.php';
?>

<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Histori</li>
                <li class="breadcrumb-item active">Pengembalian</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Histori Pengembalian Buku</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID Pengembalian</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Detail Informasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data_pengembalian as $histori_pengembalian_temp) {
                                    echo "<tr>";
                                    echo "<td>" . $histori_pengembalian_temp['id_pengembalian'] . "</td>";
                                    echo "<td>" . $histori_pengembalian_temp['nama'] . "</td>";
                                    echo "<td>" . $histori_pengembalian_temp['tanggal_buku_dikembalikan'] . "</td>";
                                    echo "<td>";
                                    ?>
                                    <a href="index.php?page=histori/pengembalian/detail&id=<?=$histori_pengembalian_temp['id_pengembalian']?>" type="button" class="btn btn-primary">Detail</a>

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
