<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Main Menu</li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="index.php?page=anggota">
        <i class="bi bi-people-fill"></i>
        <span>Anggota</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="index.php?page=buku">
        <i class="ri-book-2-fill"></i>
        <span>Buku</span>
      </a>
    </li>

    <li class="nav-heading">Lanjutan</li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#components-nav_validasi">
        <i class="bi bi-check2-square"></i><span>Validasi</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav_validasi" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="index.php?page=validasi/peminjaman">
            <i class="bi bi-journal-check"></i><span>Validasi Peminjaman</span>
          </a>
        </li>
        <li>
          <a href="index.php?page=validasi/pengembalian">
            <i class="bi bi-journal-check"></i><span>Validasi Pengembalian</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-toggle="collapse" href="#components-nav_histori">
        <i class="bi bi-clock-history"></i><span>Histori</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav_histori" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="index.php?page=histori/peminjaman">
            <i class="bi bi-clock-history"></i><span>Histori Peminjaman</span>
          </a>
        </li>
        <li>
          <a href="index.php?page=histori/pengembalian">
            <i class="bi bi-clock-history"></i><span>Histori Pengembalian</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-heading">Lain-lain</li>
    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-toggle='modal' data-bs-target='#keluar'>
        <i class="ri-logout-box-line"></i>
        <span>Keluar</span>
      </a>
    </li><!-- End Dashboard Nav -->
  </ul>
</aside>
<!-- End Sidebar-->
