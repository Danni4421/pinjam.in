<?php
$uri = "";
if (isset($_SERVER["REQUEST_URI"])) {
    $uri = $_SERVER["REQUEST_URI"];
}

$pathCount = count(array_filter(explode('/', $uri)));
$relativePath = str_repeat('../', $pathCount - 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= $relativePath ?>assets/plugins/lte/styles/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= $relativePath ?>assets/dist/styles/admin/index.css">
    <link rel="stylesheet" href="<?= $relativePath ?>assets/dist/styles/components/switcher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                            <!-- Start Filter -->
                            <div class="card-header border-transparent">

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between p-3">
                                <div class="left d-flex align-items-center gap-2">
                                    <div class="filter border-end border-grey pe-2 border-2">
                                        <i class="fa fa-filter" style="color: #b3b3b3;"></i> Filter |
                                    </div>
                                    <div class="dropdown" style="padding-left: 10px;">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Pilih Lantai
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Lantai 5</a></li>
                                            <li><a class="dropdown-item" href="#">Lantai 6</a></li>
                                            <li><a class="dropdown-item" href="#">Lantai 7</a></li>
                                            <li><a class="dropdown-item" href="#">Lantai 8</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="right d-flex align-items-center gap-2">
                                    <div>
                                        Tampilkan
                                    </div>
                                    <div class="dropdown" style="margin-left: 2%; padding-right: 2%;">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            10
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">10</a></li>
                                            <li><a class="dropdown-item" href="#">20</a></li>
                                            <li><a class="dropdown-item" href="#">30</a></li>
                                            <li><a class="dropdown-item" href="#">40</a></li>
                                            <li><a class="dropdown-item" href="#">50</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        Data
                                    </div>
                                </div>
                            </div>
                            <!-- End Filter -->


                            <!-- Start content table -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Instansi</th>
                                            <th>Ruangan</th>
                                            <th>Lantai</th>
                                            <th>Kegiatan</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>01</td>
                                            <td>Mahasiswa 1</td>
                                            <td>D4TI-2A</td>
                                            <td>RT05</td>
                                            <td>5</td>
                                            <td>Peminjaman Kelas</td>
                                            <td>21 Nov 2023</td>
                                            <td>23 Des 2023</td>
                                            <td><span class="badge badge-success">Disetujui</span>
                                            </td>
                                            <td><a href="#">
                                                    <i class="fa fa-trash" style="color: red;"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>02</td>
                                            <td>Mahasiswa 1</td>
                                            <td>D4TI-2A</td>
                                            <td>RT05</td>
                                            <td>5</td>
                                            <td>Peminjaman Kelas</td>
                                            <td>21 Nov 2023</td>
                                            <td>23 Des 2023</td>
                                            <td><span class="badge badge-success">Disetujui</span>
                                            </td>
                                            <td><a href="#">
                                                    <i class="fa fa-trash" style="color: red;"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>03</td>
                                            <td>Mahasiswa 1</td>
                                            <td>D4TI-2A</td>
                                            <td>RT05</td>
                                            <td>5</td>
                                            <td>Peminjaman Kelas</td>
                                            <td>21 Nov 2023</td>
                                            <td>23 Des 2023</td>
                                            <td><span class="badge badge-warning" style="color: white;">Diproses</span>
                                            </td>
                                            <td><a href="#">
                                                    <i class="fa fa-trash" style="color: red;"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>04</td>
                                            <td>Mahasiswa 1</td>
                                            <td>D4TI-2A</td>
                                            <td>RT05</td>
                                            <td>5</td>
                                            <td>Peminjaman Kelas</td>
                                            <td>21 Nov 2023</td>
                                            <td>23 Des 2023</td>
                                            <td><span class="badge badge-danger">Ditolak</span>
                                            </td>
                                            <td><a href="#">
                                                    <i class="fa fa-trash" style="color: red;"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="<?= $relativePath ?>assets/plugins/lte/scripts/jquery.overlayScrollbars.min.js"></script>
    <script src="<?= $relativePath ?>assets/dist/scripts/admin/index.js"></script>
    <script src="<?= $relativePath ?>assets/dist/scripts/components/switcher.js"></script>
</body>

</html>