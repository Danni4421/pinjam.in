<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>
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
                                <center>Riwayat</center>
                            </h1>
                        </div>
                    </div>
                </div>

                <section class="content" style="padding-top: 1%;">
                    <div class="container-fluid">
                        <div class="card card-primary card-outline">

                            <!-- Start content table -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="table-riwayat">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Instansi</th>
                                            <th>Ruangan</th>
                                            <th>Kegiatan</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="modal fade" tabindex="-1" id="editPeminjaman">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Peminjaman</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
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
    <script src="../assets/dist/scripts/admin/riwayat.js"></script>
</body>

</html>