<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pinjam.in - Peminjaman Ruangan JTI</title>
  <?php
  require_once 'assets/dist/styles/user/styles.php';
  ?>
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
            <h2>Ruangan</h2>
            <p>Ruang Auditorium</p>
          </div>
          <!-- ======= About Section ======= -->
          <div class="mb-3">
            <div class="row g-0">
              <div class="col-md-6 p-0">
                <img src="https://jti.polinema.ac.id/wp-content/uploads/2015/11/auditorium-jti-768x576.jpeg" class="img-fluid rounded-start" style="width: 100%;" alt="...">
              </div>
              <div class="col-md-6 px-2 mt-0" style="padding-left: 0;">
                <div class="card-header" style="background-color: #1318A5; color: white;">
                  <h3 class="card-title" style="padding-left: 2%;"><strong>Ruang Auditorium</strong>
                  </h3>
                  <p class="card-text" style="padding-left: 2%;"><small class="text-muted" style="color: whitesmoke !important;">Lantai 6</small></p>
                </div>
                <div class="card-body mt-2" style="padding-left: 2%;">
                  <p class="card-text">Ruang Auditorium merupakan ruang gabungan dari beberapa ruangan.
                    Ruangan ini dilengkapi dengan berbagai fasilitas modern, termasuk meja, kursi, dan AC yang ergonomis untuk meningkatkan kenyamanan belajar.
                    Selain itu, ruang ini telah dipasangi dengan perangkat LCD yang memungkinkan penyajian presentasi secara visual.
                    <br>Dengan berbagai fasilitas yang lengkap, Ruang Auditorium menjadi tempat ideal untuk pembelajaran maupun kegiatan yang produktif dan menyenangkan.
                  </p>
                  <div class="facilities d-flex gap-2" id="modal-facilities">
                    <div class="facility">
                      <i class="bi bi-speaker-fill main-badge"></i>
                      <span>Speaker</span>
                    </div>
                    <div class="facility">
                      <i class="bi bi-projector-fill main-badge"></i>
                      <span>LCD Proyektor</span>
                    </div>
                    <div class="facility">
                      <i class="bi bi-wifi main-badge"></i>
                      <span>Wifi</span>
                    </div>
                    <div class="facility">
                      <i class="bi bi-credit-card-2-back main-badge"></i>
                      <span>Air Conditioner</span>
                    </div>
                  </div>
                  <div class="col-md-12 mx-auto mt-4">
                    <a href="/peminjaman?kode=LSI1,LSI2,LSI3"><button class="btn btn-primary mt-4 mb-4" style="display: block; margin: 0 auto; width: 100%;">Pinjam Ruangan</button></a>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
      </div>
    </section>
  </main><!-- End #main -->

  <?php
  require_once 'assets/components/user/Footer.php';
  require_once 'assets/dist/scripts/user/scripts.php';
  ?>
</body>

</html>