<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pinjam.in - Peminjaman Ruangan JTI</title>
  <?php require_once 'assets/dist/styles/user/styles.php'; ?>
</head>

<body>
  <!-- Navbar -->
  <?php require_once 'assets/components/user/Navbar.php'; ?>
  <!-- End Navbar -->

  <main id="main">
    <section class="content">
      <div class="container-fluid">
        <div class="card" style="padding: 2% 5%; margin-top: 40px;">
          <!-- ======= About Section ======= -->
          <div class="row g-0">
            <div class="container-fluid mt-3">
              <div class="section-title">
                <h2>Ruangan</h2>
                <p>Ruang Dosen</p>
              </div>
              <div class="row row-cols-3 gap-5" id="ruang-dosen-container">
                <div class="card col p-0" style="max-width: 30% !important; ">
                  <div class="card-header" style="background-color: #1318A5; color: white;">
                    <h5 class="card-title"><strong>Ruang Dosen 1</strong></h5>
                  </div>
                  <div class="card-body">
                    <img src="https://jti.polinema.ac.id/wp-content/uploads/2017/06/rdosen-jti.jpg" alt="Kapasitas-60" class="img-fluid rounded" style="max-width: 100%;">
                    <p class="card-text mt-4">
                    </p>
                    <br>
                    <h4 class="card-title"><strong>Fasilitas yang dimiliki :</strong></h4>
                    <div class="facility-grid">
                      <div class="facility-card small">
                        <i class="bi bi-projector-fill"></i>
                        <span>LCD Proyektor</span>
                      </div>
                      <div class="facility-card small">
                        <i class="fas fa-check"></i>
                        <span>AC</span>
                      </div>
                      <br>
                      <div class="facility-card small">
                        <i class="fas fa-check"></i>
                        <span>Meja</span>
                      </div>
                      <div class="facility-card small">
                        <i class="fas fa-check"></i>
                        <span>Kursi</span>
                      </div>
                    </div>

                    <a href="#" class="btn btn-primary mt-5" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#detailDosen">
                      Lihat Informasi Ruangan
                    </a>
                  </div>
                </div>
                <div class="card col p-0" style="max-width: 30% !important; ">
                  <div class="card-header" style="background-color: #1318A5; color: white;">
                    <h5 class="card-title"><strong>Ruang Dosen 2</strong></h5>
                  </div>
                  <div class="card-body">
                    <img src="https://jti.polinema.ac.id/wp-content/uploads/2017/06/rdosen-jti.jpg" alt="Kapasitas-60" class="img-fluid rounded" style="max-width: 100%;">

                    <p class="card-text mt-4">
                    </p>
                    <br>
                    <h4 class="card-title"><strong>Fasilitas yang dimiliki :</strong></h4>
                    <div class="facility-grid">
                      <div class="facility-card small">
                        <i class="bi bi-projector-fill"></i>
                        <span>LCD Proyektor</span>
                      </div>
                      <div class="facility-card small">
                        <i class="fas fa-check"></i>
                        <span>AC</span>
                      </div>
                      <br>
                      <div class="facility-card small">
                        <i class="fas fa-check"></i>
                        <span>Meja</span>
                      </div>
                      <div class="facility-card small">
                        <i class="fas fa-check"></i>
                        <span>Kursi</span>
                      </div>
                    </div>

                    <a href="#" class="btn btn-primary mt-5" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#detailDosen">
                      Lihat Informasi Ruangan
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <!-- Modals -->
          <div class="modal top fade" id="detailDosen" tabindex="-1" aria-labelledby="detailKelas" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
            <div class="modal-dialog modal-xl ">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Ruang</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row justify-content-center gap-2">
                    <div class="row col-12 col-lg-4 justify-content-center gap-2">
                      <img id="modal-foto-ruang" class="col-12" width="300" height="300">
                    </div>
                    <div class="col-12 col-lg-7">
                      <div class="section-title">
                        <h2>Ruang Dosen</h2>
                        <p id="title-ruang">Ruang Dosen</p>
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/ruang/dosen">Ruang Dosen</a></li>
                            <li class=" breadcrumb-item active" aria-current="page" id="ruang-active"></li>
                          </ol>
                        </nav>
                        <main>
                          <div class="card-body p-0">
                            <table class="table table-striped">
                              <tr>
                                <th scope="row">Kode Ruang</th>
                                <td><span id="modal-kode-ruang"></span></td>
                              </tr>
                              <tr>
                                <th scope="row">Nama Ruang</th>
                                <td><span id="modal-nama-ruang"></span>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">Kapasitas</th>
                                <td><span id="modal-kapasitas"></span> orang
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">Posisi Lantai</th>
                                <td><span id="modal-lantai"></span></td>
                              </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="facilities d-flex gap-2" id="modal-facilities">
                          </div>
                        </main>
                      </div>
                    </div>
                  </div>
                  <section id="list-dosen" class="col-12 py-2 px-3">
                    <div class="section-title p-0">
                      <p id="title-ruang">Dosen</p>
                    </div>
                    <table class="table table-head-fixed text-nowrap w-100 overflow-auto" id="table-list-dosen">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Foto Dosen</th>
                          <th>NIP</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>Telp</th>
                        </tr>
                      </thead>
                    </table>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modals -->

      </div>
      </div>

    </section>
  </main><!-- End #main -->

  <?php
  require_once 'assets/components/user/Footer.php';
  require_once 'assets/dist/scripts/user/scripts.php';
  ?>

  <script src="../assets/dist/scripts/user/ruang/dosen.js"></script>
</body>

</html>