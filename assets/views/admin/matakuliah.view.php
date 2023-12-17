<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mata Kuliah</title>
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
                <center>Mata Kuliah</center>
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
                  <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addMataKuliah">
                    Tambah Mata Kuliah
                  </button>

                </div>
                <table class="table table-head-fixed text-nowrap" id="table-matakuliah">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Kode Mata Kuliah</th>
                      <th>Mata Kuliah</th>
                      <th>Sks</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>

              <div class="modal fade" tabindex="-1" id="addMataKuliah">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Mata Kuliah</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="formMataKuliah">
                        <div class="form-group">
                          <label for="form-label">Kode Mata Kuliah</label>
                          <input type="text" class="form-control" id="mk_id">
                        </div>
                        <div class="form-group">
                          <label for="form-label">Nama Mata Kuliah</label>
                          <input type="text" class="form-control" id="nama_mk">
                        </div>
                        <div class="form-group">
                          <label for="form-label">Sks</label>
                          <input type="text" class="form-control" id="sks_mk">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary" id="btnAddMk">Tambah Mata Kuliah</button>
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
  <script src="../assets/dist/scripts/admin/matakuliah.js"></script>
</body>

</html>