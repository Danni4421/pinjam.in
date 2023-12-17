<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fasilitas</title>
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
                <center>User</center>
              </h1>
            </div>
          </div>
        </div>

        <section class="content" style="padding-top: 1%;">
          <div class="container-fluid">
            <div class="card card-primary card-outline">

              <!-- Start content table -->
              <div class="card-body table-responsive" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap" id="table-user">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Foto</th>
                      <th>NIM</th>
                      <th>Nama Lengkap</th>
                      <th>Email</th>
                      <th>Alamat</th>
                      <th>Nomor Telepon</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <?php require_once 'assets/dist/scripts/admin/scripts.php'; ?>
  <script src="../assets/dist/scripts/admin/user.js"></script>
</body>

</html>