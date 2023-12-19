<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan</title>
    <?php require_once 'assets/dist/styles/admin/styles.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php
        require 'assets/components/admin/Navbar.php';
        if ($_SESSION["user"]["level"] == "admin") {
            require 'assets/components/admin/Sidebar.php';
        } else {
            require 'assets/components/superadmin/Sidebar.php';
        }

        require 'assets/components/admin/Footer.php';
        ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0">
                                <center>Persetujuan</center>
                            </h1>
                        </div>
                    </div>
                </div>

                <section class="content" style="padding-top: 1%;">
                    <div class="container-fluid">
                        <div class="card card-primary card-outline">

                            <!-- Start content table -->
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap" id="table-persetujuan">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Instansi</th>
                                            <th>Ruangan</th>
                                            <th>Kegiatan</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Kegiatan Mulai</th>
                                            <th>Tanggal Kegiatan Selesai</th>
                                            <th>Status</th>
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
    <script src="../assets/dist/scripts/admin/persetujuan.js"></script>
</body>

</html>