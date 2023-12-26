<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>E - Pustaka</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../../public/img/favicon.png" rel="icon" />
    <!-- <link href="../../public/img/apple-touch-icon.png" rel="apple-touch-icon" /> -->

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="../../public/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="../../public/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="../../public/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../../public/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="../../public/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="../../public/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="../../public/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="../../public/css/style.css" rel="stylesheet" />

        <!-- Include DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block" style="margin: 20px;">E-Pustaka</span>
      </a>
      
    </div>
      <!-- End Logo -->

      <nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

  <li class="nav-item dropdown pe-3 ms-auto">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-person-circle" style="font-size: 2rem; color: #0A2056;"></i>
        <span class="d-none d-md-block ps-2"><?= $_SESSION['nama']?></span>
      </a>
    </li>



  </ul>



      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->