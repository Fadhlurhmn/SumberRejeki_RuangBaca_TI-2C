<!-- CART -->
<?php
    include '../views/user/template/menu.php';
    
    ?>                                                              
    <main id="main" class="main">

    <!-- print pesan kilat -->
        <?php
        if (isset($_SESSION['_flashdata'])) {
            foreach ($_SESSION['_flashdata'] as $key => $val) {
                echo get_flashdata($key);
            }
        }
        ?>
      <!-- data buku -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cart Peminjaman</h5>
                                <table class="table datatable">
                                    <thead>
                                        <th data-sortable="false"></th>
                                        <th data-sortable="false">ISBN</th>
                                        <th data-sortable="false">Buku</th>
                                        <th data-sortable="false">Hapus Item</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (!isset($_SESSION['cart'])) {
                                        $_SESSION['cart'] = [];
                                    }
                                    $i = 0;
                                    $carts = $_SESSION['cart'];
                                    foreach ($carts as $cart){
                                        $id_buku = $_SESSION['cart'][$i];

                                        require '../controllers/buku/buku_read_id_validate.php';
                                        
                                        foreach ($data_buku as $bukus) {
                                            echo "<tr>";
                                            
                                            // menampilkan gambar
                                            echo "<td>";
                                            $id = $bukus['id'];
                                            echo "<img src=../../public/uploads/".$bukus['gambar']." alt='error' width='100px' style='margin-bottom: 5px; border-radius:10px'>";
                                            echo "</td>";

                                            // menampilkan ISBn
                                            echo "<td>" . $bukus['isbn'] . "</td>";

                                            // menampilkan judul  buku
                                            echo "<td> " . $bukus['judul'] . "<br>

                                            <p style='color: grey; 
                                            width: 500px;
                                            font-size: 14px; 
                                            display: -webkit-box;
                                            -webkit-box-orient: vertical;
                                            -webkit-line-clamp: 2; 
                                            overflow: hidden; 
                                            text-overflow: ellipsis;'>".$bukus['deskripsi']."</p>
                                            </td>";
                                            
                                            // button hapus item cart
                                            echo "<td>";
                                            echo "<form method='POST' action='../controllers/cart/remove_cart.php'>
                                            <input type='hidden' name='remove_id' value='" . $i . "'>
                                            <input type='hidden' name='remove_from_cart' value='yes'>
                                            <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#clear-per-cart'>
                                            <i class='bi bi-trash'></i>
                                            hapus
                                            </button>";
                                            ?>

                                            <!-- modal menghapus cart per item -->
                                            <div class="modal fade" id="clear-per-cart" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Verifikasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apa anda yakin ingin menghapus buku ini dari cart?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="add_to_cart" class="btn btn-success align-btn" value="Iya">Iya</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            echo "</form>";
                                            echo "</td>";
                                            echo "</tr>";
                                            // end tabel
                                        }
                                        $i += 1;
                                    }
                                    // end loop isi tabel
                                    ?>
                                    </tbody>
                                </table>
                            
                                <!-- bagian bawah tabel (clear cart dna pinjam sekrang) -->
                            <div class="row">

                                <!-- button clear cart -->
                                <div class="col">
                                    <form method="POST" action="../controllers/cart/clear_cart.php">
                                    <input type='hidden' name="clear_cart" value='Hapus'>
                                    <?php

                                    //  mengambil banyak item di cart
                                    if (isset($_SESSION['cart'])){
                                        $cart_long = count($_SESSION['cart']);
                                    } 

                                    // bila cart kosong maka akan muncul peringatan
                                    if ($cart_long !== 0){
                                        $modal_target = '#clear-all-cart';
                                    } else {
                                        $modal_target = '#deny-clear-all-cart';
                                    }
                                    ?>
                                    <button type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="<?= $modal_target ?>"><i class="bi bi-trash"></i> Clear Cart</button>

                                    <?php
                                        if ($modal_target == '#clear-all-cart'){

                                            // modal konfirmasi clear cart 
                                            echo "<div class='modal fade' id='clear-all-cart' tabindex='-1'>
                                            <div class='modal-dialog modal-dialog-centered'>
                                                <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>Verifikasi</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    Apa anda yakin menghapus seluruh cart?
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='submit' name='add_to_cart' class='btn btn-danger align-btn' value='Iya'>Iya</button>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Kembali</button>
                                                </div>
                                            </div>
                                        </div>";
                                        } elseif ($modal_target == '#deny-clear-all-cart') {

                                            // modal peringatan saat cart kosong
                                            echo "<div class='modal fade' id='deny-clear-all-cart' tabindex='-1'>
                                            <div class='modal-dialog' >
                                                <div class='modal-content'>
                                                <div class='modal-header' style='color: red;'>
                                                    <h5 class='modal-title'>Peringatan</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    Cart masih kosong
                                                </div>
                                            </div>
                                        </div>";
                                        }
                                    ?>
                                    </form>
                                </div>

                                <!-- button pinjam sekarang -->
                                <div class="col" >
                                    <form method="POST" action="../controllers/transaksi/peminjaman/transaksi_tambah_peminjaman.php">
                                    
                                    <?php
                                    // mengecek banyak isi cart
                                    if ($cart_long !== 0){
                                        $modal_target = '#confirm-cart';
                                    } else {
                                        $modal_target = '#deny-confirm-cart';
                                    }
                                    ?>

                                    <button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="<?= $modal_target ?>">Pinjam Sekarang <i class="bi bi-check-circle"></i></button>

                                    <?php
                                        if ($modal_target == '#confirm-cart'){

                                            // modal konfirmasi pinjam
                                            echo "<div class='modal fade' id='confirm-cart' tabindex='-1'>
                                            <div class='modal-dialog modal-dialog-centered'>
                                                <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>Verifikasi</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    Apa anda yakin dengan buku yang anda pinjam?
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='submit' name='add_to_cart' class='btn btn-success align-btn' value='Iya'>Iya</button>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Kembali</button>
                                                </div>
                                            </div>
                                        </div>";
                                        } elseif ($modal_target == '#deny-confirm-cart') {

                                            // modal peringatan saat cart kosong
                                            echo "<div class='modal fade' id='deny-confirm-cart' tabindex='-1'>
                                            <div class='modal-dialog' >
                                                <div class='modal-content'>
                                                <div class='modal-header' style='color: red;'>
                                                    <h5 class='modal-title'>Peringatan</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    Cart masih kosong
                                                </div>
                                            </div>
                                        </div>";
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

