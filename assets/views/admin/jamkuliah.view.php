<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jam Kuliah</title>
  <?php require_once 'assets/dist/styles/admin/styles.php' ?>
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
                <center>Jam Kuliah</center>
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
                  <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addJamKuliah">
                    Tambah Jam Kuliah
                  </button>

                </div>
                <table class="table table-head-fixed text-nowrap" id="table-jam-kuliah">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Jam Ke</th>
                      <th>Jam Mulai</th>
                      <th>Jam Selesai</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>

              <div class="modal fade" tabindex="-1" id="addJamKuliah">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Jam Kuliah</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="formJamKuliah">
                        <div class="form-group">
                          <label for="form-label">Jam Ke</label>
                          <input type="number" class="form-control" id="add_jk_id">
                        </div>
                        <div class="form-group">
                          <label for="form-label">Jam Mulai</label>
                          <input type="time" class="form-control" id="add_jam_mulai">
                        </div>
                        <div class="form-group">
                          <label for="form-label">Jam Selesai</label>
                          <input type="time" class="form-control" id="add_jam_selesai">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary" id="btnAddMk">Tambah Jam Kuliah</button>
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
  <script src="../assets/dist/scripts/admin/jamkuliah.js"></script>
</body>

</html>