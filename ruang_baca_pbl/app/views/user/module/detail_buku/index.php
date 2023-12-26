<style>
    .detail-buku-text{
      float: right;
    }
    .grey, .detail-buku-text{
      color: #948c8c;
    }
    .submit-btn{
      background-color: #012348;
      margin: 5px;
      float: left;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    // menampilkan modal saat apabila saat load
    $(document).ready(function(){
      $('#alert').modal('show');

      setTimeout(function(){
        $('#alert').modal('hide');
      }, 1500);
    });
  </script>

    <?php
    include '../views/user/template/menu.php';

    $id_buku = $_GET['id'];
    include '../controllers/buku/buku_read_id_validate.php';
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Detail Buku</h1>
            <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item "><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Detail buku</li>
            </ol>
          </nav>
        </div>
      
        <!-- print flash message -->
        <?php
        if (isset($_SESSION['_flashdata'])) {
            foreach ($_SESSION['_flashdata'] as $key => $val) {
                echo get_flashdata($key);
            }
        }
        ?>

      <!-- list buku -->
        <section class="section">
          <div class="row align-items-top">
              <div class="col-lg-5">
                  <?php

                    // menampilkan gambar buku
                    foreach ($data_buku as $buku) {
                      echo "<img src=../../public/uploads/".$buku['gambar']." alt='error' width='400px' style='margin-bottom: 5px; border-radius:10px'>";
                    }
                      
                  ?>
              </div>

              <div class="col-lg-7">
                  <?php

                  foreach ($data_buku as $buku){
                    //menampilkan detail buku
                    echo "<div class='pagetitle'><h1>" . $buku['judul'] . "</h1></div>";
                    echo "<p>By " . $buku['penulis'] . "</p>";
                    echo "<hr>";
                    echo "<p class='grey'>Deskripsi</p>";
                    echo "<p>" . $buku['deskripsi'] . "</p>";
                    echo "<div class='card'>
                    <div class='card-body'>
                    <ul class='list-group' style='margin-top: 18px;'>";
                    echo "<li class='list-group-item'><b>Penulis</b><span class='detail-buku-text'>" . $buku['penulis'] . "</span></li>";
                    echo "<li class='list-group-item'><b>Jumlah</b><span class='detail-buku-text'>" . $buku['jumlah'] . "</span></li>";
                    echo "<li class='list-group-item'><b>Tersedia</b><span class='detail-buku-text'>" . $buku['tersedia'] . "</span></li>";
                    echo "</ul>

                    </div>
                </div>";

                      // mengecek ketersediaan buku
                      if ($buku['tersedia'] < 2){
                        $status = 'disabled';
                        $status_button = 'danger';
                        $pesan = 'Stok buku tidak cukup!';
                      } elseif ($buku['status_buku'] == 'rusak'){
                        $status = 'disabled';
                        $status_button = 'danger';
                        $pesan = 'Tidak ada buku yang layak!';
                      }
                      // tidak bisa, ada cara lain gak?
                      elseif (isset($_SESSION['allow_peminjaman'])){
                        $status = 'disabled';
                        $status_button = 'danger';
                        $pesan = 'Masih ada buku yang dipinjam';
                      } else {
                        $status ='';
                        $status_button = 'primary';
                      }
                  }
                  ?>

                  <!-- menambahkan buku ke cart -->
                  <form action="../controllers/cart/cart.php" method="POST">
                    <input type="hidden" name="id_buku" value="<?php echo $id_buku ?>">
                      <button type="button" style="margin-top: 10px" class="btn btn-<?php echo $status_button ?> submit-btn" data-bs-toggle="modal" data-bs-target="#addcart" <?php echo $status ?>>Tambah ke Keranjang</button>
                      <div class="modal fade" id="addcart" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Verifikasi</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
                              Apa anda ingin meminjam buku ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Kembali</button>
                              <button type="submit" name="add_to_cart" class="btn btn-success submit-btn" value="Iya">Iya</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>
                  <?php

                  // mengecek status buku untuk menampilkan modal peringatan
                  if ($status == "disabled"){
                  echo "<div class='modal fade' id='alert' role='alert' tabindex='-1' data-bs-backdrop='false'>
                  <div class='modal-dialog modal-content' style='max-width:400px; height:20px;'>
                    <div class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' role='alert' style='max-width:320px; float:right;'>
                    ".$pesan."
                    <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Close'></button>
                    
                    </div>
                  </div>
                </div>";
                  }
                  ?>
              </div>
          </div>
        </section>
    </main>