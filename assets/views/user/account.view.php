<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pinjam.in - Peminjaman Ruangan JTI</title>
  <?php
  require_once 'assets/dist/styles/user/styles.php';
  ?>
  <link rel="stylesheet" href="../assets/dist/styles/user/account.css">
</head>

<body>
  <?php
  require_once 'assets/components/user/Navbar.php';
  ?>

  <main id="main">
    <section class="content">
      <div class="container-fluid">
        <div class="card" style="padding: 2% 5%; margin-top: 40px;">
          <div class="section-title">
            <h2>Akun</h2>
            <p>Informasi Akun</p>
          </div>
          <!-- ======= About Section ======= -->
          <div class="container-fluid mt-5">
            <form class="row" method="POST" enctype="multipart/form-data" id="profile-form">
              <div class="col-md-3">
                <!-- Card 1: Profile Pic -->
                <div class="card p-2 shadow">
                  <div class="profile-pic-wrapper">
                    <div class="pic-holder text-center">
                      <!-- Uploaded pic shown here -->
                      <img id="profilePic" class="pic img-fluid rounded-circle img-center"  style="width:50%;">

                      <input class="uploadProfileInput visually-hidden" type="file" name="foto_profil" id="foto_profil" accept=".img, .jpg, .jpeg"/>
                      <input type="hidden" name="old_foto_profil" id="old_foto_profil">
                      
                      <label for="foto_profil" class="upload-file-block btn btn-outline-primary w-100 mt-3 mb-3">
                        <i class="fa fa-camera"></i> Update Profile Photo
                      </label>
                    </div>
                  </div>
                </div>
                <div class="card p-2 shadow mt-3">
                  <h5 class="p-2">Riwayat Pinjam</h5>
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Ruangan yang sedang dipinjem
                      <span class="badge bg-primary rounded-pill" id="reserved-room">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Ruangan yang masih di proses
                      <span class="badge bg-primary rounded-pill" id="on-process-room">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Ruangan yang sudah selesai dipinjam
                      <span class="badge bg-primary rounded-pill" id="is-done-room">0</span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card text-center col-md-9">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a class="nav-link <?= $uri == "/account" ? "active" : "" ?>" aria-current="true" href="/account">Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?= $uri == "/account/riwayat" ? "active" : "" ?>" href="/account/riwayat">Riwayat</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <?php
                  if ($uri == "/account") {
                    require_once 'assets/components/user/FormAccount.php';
                  } elseif ($uri == "/account/riwayat") {
                    require_once 'assets/components/user/Riwayat.php';
                  }
                  ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <?php
  require_once 'assets/components/user/Footer.php';
  require_once 'assets/dist/scripts/user/scripts.php';
  ?>
  <script src="../assets/dist/scripts/user/account.js"></script>
</body>

</html>