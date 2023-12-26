<head>
  <style>
    .color-blue{
      color: #012348;
    } 
    .color-blue-light {
      color: #012c59;
    }
    .modal-backdrop {
      z-index: 
    }
  </style>
</head>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar ">
  <ul class="sidebar-nav " id="sidebar-nav">
      <!-- <li class="nav-item">
          <a class="nav-link collapsed" href="index.php?page=profile">
          <i class="bi bi-person-circle" style="font-size: 40px"></i>
          <span class="d-none d-md-block ps-2">
            <?php 
                echo $_SESSION['nama'];
            ?>
          </span>
          </a>
        </li>-->
      <li class="nav-heading">MAIN MENU</li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="index.php">
            <i class="bi bi-house"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Status Nav -->

      <li class="nav-item ">
          <a class="nav-link collapsed" href="index.php?page=peminjaman">
            <i class="bi bi-journal-bookmark-fill"></i>
            <span>Peminjaman Buku</span>
          </a>
      </li><!-- End List Buku -->

      <li class="nav-item ">
          <a class="nav-link collapsed" href="index.php?page=pengembalian">
            <i class="ri-arrow-go-back-fill"></i>
            <span>Pengembalian Buku</span>
          </a>
      </li><!-- End List Buku -->

    <li class="nav-heading">LAIN LAIN</li>

    <li class="nav-item ">
      <a class="nav-link collapsed" href="index.php?page=profile">
        <i class="bi bi-person"></i>
        <span>Profil Saya</span>
      </a>
    </li>

    <li class="nav-heading">LANJUTAN</li>

    

    <!-- <li class="nav-item">
      <div style="height: 212px">

      </div>
    </li> -->

    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle='modal' data-bs-target='#keluar'>
        <i class="ri-logout-box-line"></i>
        <span>Keluar</span>
      </a>
    <!-- logout without modal -->
    <!-- <a class="nav-link collapsed" href="../controllers/logout.php" style="background-color:#d9180a; color:white; max-width:110px;"> -->
        <!-- <a class="nav-link collapsed" href="../controllers/logout.php">
        <i class="ri-logout-box-line" style="color:white; font-size:20px"></i>
        <i class="ri-logout-box-line"></i>
        <span>Keluar</span>
        </a> -->

        <!-- logout with modal -->
    <!-- <form action="logout.php">
      <a class="nav-link collapsed" href="#" data-bs-toggle="modal" data-bs-target="#logout">
        <i class="ri-logout-box-line"></i>
        <span>Keluar</span>
        </a>
        <div class="modal fade" id="logout" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Verifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Apa anda yakin ingin logout?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-danger">Iya</button>
              </div>
            </div>
          </div>
        </div>
      </form> -->
    </li>
    
    
  </ul>
</aside><!-- End Sidebar-->
