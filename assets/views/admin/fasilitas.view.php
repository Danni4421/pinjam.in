<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fasilitas</title>
  <?php require_once 'assets/dist/styles/admin/styles.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php
    require 'assets/components/admin/Navbar.php';
    require 'assets/components/superadmin/Sidebar.php';

    require 'assets/components/admin/Footer.php';
    ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 class="m-0">
                <center>Fasilitas</center>
              </h1>
            </div>
          </div>
        </div>

        <section class="content" style="padding-top: 1%;">
          <div class="container-fluid">
            <div class="card card-primary card-outline">

              <!-- Start content table -->
              <div class="card-body table-responsive">
                <div class="d-flex justify-content-end mb-3">
                  <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addFasilitas">
                    Tambah Fasilitas
                  </button>

                </div>
                <table class="table table-head-fixed text-nowrap" id="table-fasilitas">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Nama Fasilitas</th>
                      <th>Icon</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>

              <div class="modal fade" tabindex="-1" id="addFasilitas">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Fasilitas</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="addFasilitasForm">
                        <div class="form-group">
                          <label for="nama-fasilitas" class="form-label">Nama Fasilitas</label>
                          <input type="text" id="nama-fasilitas" class="form-control">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <?php require_once 'assets/dist/scripts/admin/scripts.php'; ?>
  <script src="../assets/dist/scripts/admin/fasilitas.js"></script>
</body>

</html>