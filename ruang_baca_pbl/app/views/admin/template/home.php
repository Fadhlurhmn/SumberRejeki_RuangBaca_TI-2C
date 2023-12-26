<?php
include 'menu.php';
require '../config/koneksi.php';
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">                        
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Peminjaman</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-clipboard-data"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php                                       
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as total_peminjaman FROM peminjaman");
                                        $total_peminjaman = mysqli_fetch_assoc($query);
                                        echo $total_peminjaman['total_peminjaman'];
                                        ?></h6>
                                        <span class="text-muted small pt-2 ps-1">Peminjaman</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Pengguna <span>| Terdaftar</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php                                       
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as total_pengguna FROM anggota WHERE level ='user'");
                                        $total_pengguna = mysqli_fetch_assoc($query);
                                        echo $total_pengguna['total_pengguna'];
                                        ?></h6>
                                        <span class="text-muted small pt-2 ps-1">Pengguna</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Customers Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Buku <span>| Tersedia</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php                                       
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as total_buku FROM buku");
                                        $total_buku = mysqli_fetch_assoc($query);
                                        echo $total_buku['total_buku'];
                                        ?></h6>
                                        <span class="text-muted small pt-2 ps-1">Buku</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->
                </div>

              <!-- logic print gambar -->
                <?php
              include '../controllers/buku/buku_read_top_validate.php';
                ?>
              <!-- Top Selling -->
              <div class="col-12">
                <div class="card top-selling overflow-auto">

                  <div class="card-body pb-0">
                    <h5 class="card-title">Top Buku <span>| Dipinjam</span></h5>

                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">Preview</th>
                          <th scope="col">Judul</th>
                          <th scope="col">Total Dipinjam</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($data_buku_top as $buku_top){
                            echo "<tr>";
                            echo "<td>";
                              $id = $buku_top['id'];
                            //   require '../views/admin/display_top.php';
                            echo "<img src=../../public/uploads/".$buku_top['gambar']." alt='error' style='border-radius: 8px; width: 80px; margin-top:9px;'>";
                              // echo $buku_top['judul'];
                            echo "</td>";
                            echo "<td>".$buku_top['judul']."</td>";
                            echo "<td>".$buku_top['top']."</td>";
                            echo "</tr>"; 
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- End Top Selling -->
            </div>
<!-- End Left side columns -->
<div class="col-lg-4">
    <div class="row"> <!-- Tambahkan div row di sini -->
        <!-- Revenue Card 1 -->
        <div class="col-6">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Buku <span>| ACC</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-white bg-success">
                            <i class="bi bi-journal-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT COUNT(*) as total_acc FROM detail_peminjaman WHERE status_buku = 'acc'");
                                $total_acc = mysqli_fetch_assoc($query);
                                echo $total_acc['total_acc'];
                                ?>
                            </h6>
                            <span class="text-muted small pt-2 ps-1">Buku</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Revenue Card 1 -->

        <!-- Revenue Card 2 -->
        <div class="col-6">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Buku <span>| Ditolak</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-white bg-danger">
                            <i class="bi bi-journal-x"></i>
                        </div>
                        <div class="ps-3">
                            <h6>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT COUNT(*) as total_tolak FROM detail_peminjaman WHERE status_buku = 'tolak'");
                                $total_tolak = mysqli_fetch_assoc($query);
                                echo $total_tolak['total_tolak'];
                                ?>
                            </h6>
                            <span class="text-muted small pt-2 ps-1">Buku</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Revenue Card 2 -->
                        <!-- Website Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"
                        ><i class="bi bi-app-indicator"></i
                        ></a>
                        <ul
                        class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"
                        >
                        <li class="dropdown-header text-start">
                            <h6>Menu</h6>
                        </li>

                        <li><a class="dropdown-item" href="index.php?page=validasi/peminjaman">Validasi Peminjaman</a></li>
                        <li><a class="dropdown-item" href="index.php?page=histori/peminjaman">Lihat Histori</a></li>
                        </ul>
                    </div>
                    <div class="card-body pb-0">
                        <h5 class="card-title">Peminjaman <span>| Trafic</span></h5>

                        <div
                        id="trafficChart"
                        style="min-height: 400px"
                        class="echart"
                        ></div>

                        <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts
                            .init(document.querySelector("#trafficChart"))
                            .setOption({
                                tooltip: {
                                trigger: "item",
                                },
                                legend: {
                                top: "5%",
                                left: "center",
                                },
                                series: [
                                {
                                    name: "Trafic Status",
                                    type: "pie",
                                    radius: ["40%", "70%"],
                                    avoidLabelOverlap: false,
                                    label: {
                                    show: false,
                                    position: "center",
                                    },
                                    emphasis: {
                                    label: {
                                        show: true,
                                        fontSize: "18",
                                        fontWeight: "bold",
                                    },
                                    },
                                    labelLine: {
                                    show: false,
                                    },
                                    data: [
                                    {
                                        value: <?php
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as terkonfirmasi FROM peminjaman WHERE status_peminjaman = 'terkonfirmasi'");
                                        $terkonfirmasi = mysqli_fetch_assoc($query);
                                        echo $terkonfirmasi['terkonfirmasi'];
                                        ?>,
                                        name: "Terkonfirmasi",
                                        itemStyle: {color: "#64CE3B"},
                                    },
                                    {
                                        value: <?php
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as total_pending FROM peminjaman WHERE status_peminjaman = 'pending'");
                                        $total_pending = mysqli_fetch_assoc($query);
                                        echo $total_pending['total_pending'];
                                        ?>,
                                        name: "Pending",
                                        itemStyle: {color: "#ECDF1E"},
                                    },
                                    ],
                                },
                                ],
                            });
                        });
                        </script>
                    </div>
                </div>
                <!-- End Website Traffic -->                  

            </div>
        </div>
    </section>
</main>
<!-- End #main -->
