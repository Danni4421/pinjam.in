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
          <!-- ======= About Section ======= -->
          <div class="row g-0">
            <div class="container-fluid mt-3">
              <?php
              if (isset($query["search"])) { ?>
                <div class="section-title">
                  <h2>Hasil Pencarian</h2>
                  <p>Ruangan Gedung JTI </p>
                </div>
                <div class="search-container row g-0" data-search="<?= $query["search"] ?>">
                  <div class="card text-center">
                    <div class="card-body">
                      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6" id="search-result-container">
                      </div>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="section-title">
                  <h2>List Ruang</h2>
                  <p>Ruang Gedung JTI</p>
                </div>
                <div class="row row-cols-1 row-cols-md-2">
                  <div class="col">
                    <div class="card mb-3">
                      <div class="card-header" style="background-color: #1318A5; color: white;">
                        <h5 class="card-title"><strong>Ruang Teori</strong></h5>
                      </div>
                      <div class="card-body">
                        <img src="https://jti.polinema.ac.id/wp-content/uploads/2018/06/LPR-3-768x264.jpg" alt="lp" class="img-fluid rounded img-size">
                        <h3 class="card-text mt-4">
                          Ruang Teori
                        </h3>
                        <br>
                        <a href="/ruang/kelas" class="btn btn-primary mt-5" style="width: 100%;">Lihat Semua Ruang Kelas</a>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card mb-3">
                      <div class="card-header" style="background-color: #1318A5; color: white;">
                        <h5 class="card-title"><strong>Ruang Laboratorium</strong></h5>
                      </div>
                      <div class="card-body">
                        <img src="https://jti.polinema.ac.id/wp-content/uploads/2018/06/LPR-3-768x264.jpg" alt="lp" class="img-fluid rounded img-size">
                        <h3 class="card-text mt-4">
                          Ruang Teori
                        </h3>
                        <br>
                        <a href="/ruang/laboratorium" class="btn btn-primary mt-5" style="width: 100%;">Lihat Semua Ruang Laboratorium</a>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card mb-3">
                      <div class="card-header" style="background-color: #1318A5; color: white;">
                        <h5 class="card-title"><strong>Ruang Auditorium</strong></h5>
                      </div>
                      <div class="card-body">
                        <img src="https://jti.polinema.ac.id/wp-content/uploads/2018/06/LPR-3-768x264.jpg" alt="lp" class="img-fluid rounded img-size">
                        <h3 class="card-text mt-4">
                          Ruang Teori
                        </h3>
                        <br>
                        <a href="/ruang/auditorium" class="btn btn-primary mt-5" style="width: 100%;">Lihat Ruangan</a>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card mb-3">
                      <div class="card-header" style="background-color: #1318A5; color: white;">
                        <h5 class="card-title"><strong>Ruang Dosen</strong></h5>
                      </div>
                      <div class="card-body">
                        <img src="https://jti.polinema.ac.id/wp-content/uploads/2018/06/LPR-3-768x264.jpg" alt="lp" class="img-fluid rounded img-size">
                        <h3 class="card-text mt-4">
                          Ruang Teori
                        </h3>
                        <br>
                        <a href="/ruang/dosen" class="btn btn-primary mt-5" style="width: 100%;">Lihat Ruang Dosen</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }
              ?>
            </div>
          </div>
        </div>

      </div>

    </section>
  </main>

  <?php
  require_once 'assets/components/user/Footer.php';
  require_once 'assets/dist/scripts/user/scripts.php';
  ?>

  <script>
    $(document).ready(function() {
      $('#search-result-container').html('')
      const search = $('.search-container').data('search')

      $.ajax({
        url: '../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'RuangRequest',
          payload: {
            method: "GET",
            type: 'search',
            searchInput: search
          }
        }),
        success: function(response) {
          const ruang = JSON.parse(response)

          if (!ruang.hasOwnProperty('error')) {
            $.each(ruang, function(index, item) {
              let facilities = $(`<div class="facilities-container my-2 d-flex gap-2"></div>`)
              $.each(item.fasilitas, function(index, item) {
                facilities.append(`
                <span class="${item.status === "Baik" ? "main-badge" : "error-main-badge"} ">
                  <i class="${item.icon}"></i>
                </span>
              `)
              })

              const outerContainer = $(`<div class="col-sm-2 mb-3 mb-sm-0"></div>`)
              const innerContainer = $(`<div class="card" id="ruang-lab">
                <img src="../${item.fotoRuang}" class="card-img-top">
              </div>
            `)
              const cardBody = $(`<div class="card-body text-start">
                  <a class="btn-ruang-lab">
                    <h6>${item.namaRuang}</h6>
                  </a>
                </div>
              `)
              cardBody.append(facilities)
              cardBody.append(`<a href="/peminjaman?kode=${item.kodeRuang}" class="btn btn-primary btn-sm">Pinjam Ruangan</a>`)

              innerContainer.append(cardBody)
              outerContainer.append(innerContainer)

              $('#search-result-container').append(outerContainer)
            })
          }
        }
      })
    });
  </script>

</body>

</html>