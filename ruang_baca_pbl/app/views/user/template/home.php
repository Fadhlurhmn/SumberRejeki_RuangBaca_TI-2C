<?php
    include 'menu.php';

    ?>                                           
    <main id="main" class="main">
          <style>
            /*--------------------------------------------------------------
            # List Buku
            --------------------------------------------------------------*/
            /* Container untuk daftar buku menggunakan CSS Grid */

            .bookbox {
            margin-left: 10px;
            width:215px;
            height: 485px;
            border-radius: 5px;
            background: #FFF;
            box-shadow: 0px 5px 5px 5px rgba(203, 203, 203, 0.25);
            }

            .bookbox .bookimage{
            width: 190px;
            height: 255.55px;
            border-radius: 5px;
            }

            .bookimage {
            display: block;
            margin-left: auto;
            margin-right: auto;
            }

            .booktitle {
            overflow: hidden;
            text-overflow: ellipsis;  
            white-space: nowrap;
            margin-top: 50px;
            margin-left: 10px;
            margin-right: 10px;
            color: #002347;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif Bold;
            font-size: 20px;
            font-style: normal;
            font-weight: 1000;
            line-height: 24px;
            text-align: left;
            }

            .bookdesc p{
            overflow: hidden;
            text-overflow: ellipsis;  
            white-space: nowrap;
            margin-top: 3px;
            margin-left: 10px;
            margin-right: 10px;
            text-align: left;
            }

            .book-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            }

            /* Gaya untuk setiap buku */
            .book {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            }

            /* Container untuk gambar, judul, dan tombol "Lihat" */
            .book-content {
            text-align: center;
            }

            /* Gaya untuk gambar buku */
            .bookimg {
            max-width: 100%;
            height: auto;
            }

            /* Gaya untuk judul buku */
            .book-title {
            margin: 10px 0;
            font-weight: bold;
            }
            /* end of bookbox */
            
            .lihat-btn{
              background-color: #012348;
              margin-right: 15px;
              float: right;
            }

            /* line separator style */
            .separator {
              display: flex;
              align-items: center;
            }
            .separator-line {
              flex: 1;
              border: none; /* Hide the default border */
              border-top: 1px solid black; /* Customize the line */
            }
            .separator-text {
              margin: 0 10px; 
              color: black; 
            }
            /* end line separator style */

            /* dashboard style*/
            .dashboard-content .list-buku-content {
                display: block;
            }
            .toggle-btn.active {
              background-color: #012348;
            }
            /* end dashboard style */

            /* Style for the clickable image */
            .clickable-image {
                border-radius: 8px;
                max-width: 400px;
                margin-top: 9px;
                transition: opacity 0.3s ease-in-out; /* Smooth transition for opacity */
            }

            /* Dimming effect on hover */
            .clickable-image:hover {
                opacity: 0.7; /* Change the opacity value as needed */
            }
        </style>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
          // hide dashboard logic
            $(document).ready(function() {
                $('.toggle-btn').on('click', function() {
                    $('.dashboard-content').slideToggle(300);
                    $(this).toggleClass('active');
                    $('.btn-text').text(function(i, text) {
                        return text === "Sembunyikan Dashboard" ? "Tampilkan Dashboard" : "Sembunyikan Dashboard";
                    });

                    // change icon while clicked
                    var icon = $('.toggle-btn i');
                    if (icon.hasClass('bi-chevron-double-down')) {
                        icon.removeClass('bi-chevron-double-down').addClass('bi-chevron-double-up');
                    } else {
                        icon.removeClass('bi-chevron-double-up').addClass('bi-chevron-double-down');
                    }                    
                });
            });

            // search logic
            $(document).ready(function() {
              $('#searchInput').on('input', function() {
                  let searchValue = $(this).val().toLowerCase(); // Get input value and convert to lowercase for case-insensitive search

                  $('.bookbox').each(function() {
                      let bookTitle = $(this).find('.booktitle').text().toLowerCase(); // Get book title and convert to lowercase
                      let bookAuthor = $(this).find('#penulis').text().toLowerCase(); // Get book author and convert to lowercase

                      if (bookTitle.includes(searchValue) || bookAuthor.includes(searchValue)) {
                          $(this).show(); // Display the book if the search value matches the title or author
                      } else {
                          $(this).hide(); // Hide the book if it doesn't match the search value
                      }
                  });
                });
              });
        </script>

        <div class="pagetitle">
          <h1>Dashboard</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
            </ol>
          </nav>
        </div>
        <section class="section">
        
        <!-- dashboard content -->
          <?php
            include '../controllers/buku/buku_read_validate.php';

            $id_anggota = $_SESSION['id'];
            include '../controllers/transaksi/peminjaman/transaksi_read_id_peminjaman_validate.php';
          ?>
        <div class="dashboard-content ">

          <div class="row">

          <!-- blok pilihan buku -->
            <div class="col-xl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h4 class="card-title" style="font-size: 25px; "> <span style=" font-size:105px; margin-right: 10px; "><b><?= count($data_buku)?></b></span> <br> PILIHAN BUKU</h4>
                </div>
              </div>
            </div>

            <?php
              include '../controllers/buku/buku_read_top_validate.php';
            ?>

            <!-- blok top 3 buku -->
            <div class="col-xl-4 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">TOP 3 BUKU</h5>
                  <div class="row">
                    <?php
                      foreach ($data_buku_top as $buku_top){
                        echo "<div class='col-lg-4'>";
                          $id = $buku_top['id'];
                          // echo "<a href='index.php?page=detail_buku&id=".$id."'><img src='../../public/uploads/".$buku_top['gambar']."' alt='error' style='border-radius: 8px; width: 80px; margin-top:9px;></a>";
                          echo "<a href='index.php?page=detail_buku&id=".$id."'><img src=../../public/uploads/".$buku_top['gambar']." alt='error' style='border-radius: 8px; width: 80px; margin-top:9px;' class='clickable-image'></a>";
                        echo "</div>";
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- blok 3 -->
            <!-- <div class="col-xl-5 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Notifikasi (menunggu tbl_log)</h5>
                  <ul>
                    <li>notif 1</li>
                    <li>notif 2</li>
                    <li>notif 3</li>
                    <li>notif 4</li>
                    <li>notif 5</li>
                  </ul>
                </div>
              </div>
            </div> -->
          </div>
        </div>
        
        <!-- hide button -->

        <!-- with line -->
        <!-- <div class="separator">
          <hr class="separator-line">
          <span class="separator-text"><button class="btn btn-secondary btn-sm toggle-btn"><i class="bi bi-chevron-double-up"></i> <span class="btn-text">Sembunyikan Dashboard</span></button></span>
          <hr class="separator-line">
        </div> -->

        <!-- without line -->
        <button class="btn btn-secondary btn-sm toggle-btn">
          <i class="bi bi-chevron-double-up"></i> 
          <span class="btn-text">Sembunyikan Dashboard</span>
        </button>

        <!-- end of dashboard content -->

        <!-- list buku content -->
        <div class="list-buku-content">
          <div class="separator">
            <hr class="separator-line">
            <span class="separator-text"><h3 class="pagetitle">List Buku</h3></span>
            <hr class="separator-line">
          </div>

          <div class="iconslist">
            <?php
                foreach ($data_buku as $buku) {
            ?>
            <div class="icon bookbox">
              <?php
              $id = $buku['id'];
              ?>
              <div class = "bookimage">
                <?php
                  echo "<img src=../../public/uploads/".$buku['gambar']." alt='error' class='card-img-top' style='border-radius: 8px'>";
                ?>
              </div>
              <div class="booktitle"><?php echo $buku['judul'] ?></div>
              <div class="bookdesc">
                <p id="isbn" >ISBN : <?php echo $buku['isbn'] ?> </p>
                <p id="penulis" >Penulis : <?php echo $buku['penulis'] ?> </p>
              </div>
                <button type='button' class='btn btn-primary lihat-btn' id='viewButton_"<?php echo $buku['id'] ?>"'>LIHAT</button>
                <script type='text/javascript'>
                  document.getElementById('viewButton_"<?php echo $buku['id'] ?>"').onclick = function () {
                      window.location.replace("index.php?page=detail_buku&id=<?php echo $buku['id'] ?>");
                  };
                </script>
            </div>
            <?php } ?>
          </div>
        </div>
        <!-- end of list buku content -->
       
        </section>
    </main>