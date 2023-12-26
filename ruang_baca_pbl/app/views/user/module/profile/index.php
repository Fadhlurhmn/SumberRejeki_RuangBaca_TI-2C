<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
    include '../views/user/template/menu.php';

    $id = $_SESSION['no_induk'];
    include '../controllers/anggota/anggota_read_id_validate.php';
    
    ?>                                           
    <main id="main" class="main">
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item "><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">User Profile</li>
        </ol>
      </nav>
    </div>
    <?php
        if (isset($_SESSION['_flashdata'])) {
            foreach ($_SESSION['_flashdata'] as $key => $val) {
                echo get_flashdata($key);
            }
        }
      ?>
    <section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

              <!-- bagian detail profile -->
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <?php
                    foreach($data_anggota as $anggota)
                        echo "<div class='col-lg-3 col-md-4 label'>NIM/ NIP</div>";
                        echo "<div class='col-lg-9 col-md-8'>". $anggota['no_induk'] ."</div>";
                    ?>
                  </div>

                  <div class="row">
                    <?php
                    foreach($data_anggota as $anggota)
                        echo "<div class='col-lg-3 col-md-4 label'>Nama</div>";
                        echo "<div class='col-lg-9 col-md-8'>". $anggota['nama'] ."</div>";
                    ?>
                  </div>

                  <div class="row">
                    <?php
                    foreach($data_anggota as $anggota)
                        echo "<div class='col-lg-3 col-md-4 label'>Alamat</div>";
                        echo "<div class='col-lg-9 col-md-8'>". $anggota['alamat'] ."</div>";
                    ?>
                  </div>

                  <div class="row">
                  <?php
                    foreach($data_anggota as $anggota)
                        echo "<div class='col-lg-3 col-md-4 label'>No. Telepon</div>";
                        echo "<div class='col-lg-9 col-md-8'>". $anggota['no_telp'] ."</div>";
                    ?>
                  </div>

                  <div class="row">
                  <?php
                    foreach($data_anggota as $anggota)
                        echo "<div class='col-lg-3 col-md-4 label'>Jurusan</div>";
                        echo "<div class='col-lg-9 col-md-8'>". $anggota['jurusan'] ."</div>";
                    ?>
                  </div>

                  <div class="row">
                  <?php
                    foreach($data_anggota as $anggota)
                        echo "<div class='col-lg-3 col-md-4 label'>Prodi</div>";
                        echo "<div class='col-lg-9 col-md-8'>". $anggota['prodi'] ."</div>";
                    ?>
                  </div>

                  <div class="row">
                  <?php
                    foreach($data_anggota as $anggota)
                        echo "<div class='col-lg-3 col-md-4 label'>Jabatan</div>";
                        echo "<div class='col-lg-9 col-md-8'>". $anggota['jabatan'] ."</div>";
                    ?>
                  </div>
                </div>

                <!-- bagian change password -->
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="../controllers/anggota/anggota_edit_validate.php" onsubmit="return validatePasswords()">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                      </div>
                    </div>
                    <?php
                      foreach ($data_anggota as $anggota){
                        $id = $anggota['id'];
                      }
                    ?>
                    <div class="text-center">
                      <input type="hidden" name="id" value="<?=$id?>">
                      <button type="submit" name="editPassword" value="Update" class="btn btn-primary" style="background-color: #012348;">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                  <!-- pengecekan password inputan -->
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                  <script>
                    function validatePasswords() {
                      console.log("Validation function called");
                      var newPassword = document.getElementById('newPassword').value;
                      var renewPassword = document.getElementById('renewPassword').value;

                      // Check if the new password matches the re-entered password
                      if (newPassword !== renewPassword) {
                        $('#deny-confirm-password').modal('show');
                        console.log("Passwords don't match");
                        return false; // Prevent form submission
                      }

                      // If both validations pass, allow the form submission
                      console.log("Validation passed");
                      return true;
                    }

                    // message yang akan ditampilkan
                    // if (window.location.hash === '#deny-confirm-password') {
                    //     alert("password salah");
                    // } else if (window.location.hash === '#deny-update-password'){
                    //     alert("gagal update");
                    // } else if (window.location.hash === '#deny-null-password'){
                    //     alert("password tidak boleh kosong");
                    // }
                  </script>

                    <!-- modal saat new pass dengan konfirm nya beda -->
                  <div class='modal fade' id='deny-confirm-password' tabindex='-1'>
                      <div class='modal-dialog' >
                          <div class='modal-content'>
                          <div class='modal-header' style='color: red;'>
                              <h5 class='modal-title'>Peringatan</h5>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                          </div>
                          <div class='modal-body'>
                              Password baru dan password konfirmasi tidak sama
                          </div>
                      </div>
                  </div>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
    </main>

    <!-- jQuery -->
    
