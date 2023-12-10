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
    <title>Ruang Kelas</title>
    <link rel="stylesheet" href="<?= $relativePath ?>assets/plugins/lte/styles/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= $relativePath ?>assets/dist/styles/admin/index.css">
    <link rel="stylesheet" href="<?= $relativePath ?>assets/dist/styles/admin/ruang.css">
    <link rel="stylesheet" href="<?= $relativePath ?>assets/dist/styles/components/switcher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php
        require 'assets/components/admin/Navbar.php';
        require 'assets/components/superadmin/Sidebar.php';

        require 'assets/components/admin/Footer.php';
        ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="text-align: center;">Ruang Kelas</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card" style="padding: 2%;">
                        <!-- Info ruang -->
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-3">
                                <img src="<?= $relativePath ?>assets/dist/images/ruang.kelas.png" style="width: 100%;" alt="...">
                                <div class="card-body-overlay">
                                    <h5 class="card-title">Ruang Kelas </h5>
                                    <p class="card-text">Lantai 5</p>
                                    <button type="button" class="btn btn-danger col-sm-4" data-toggle="modal" data-target="#detailKelas">
                                        Details
                                    </button>
                                    <!-- Modal Detail Ruang -->
                                    <div class="modal fade" id="detailKelas">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content px-3" style="background-color: #D9D9D9;">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><strong>Detail Ruangan</strong></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="text-center mb-3">
                                                                <img src="<?= $relativePath ?>assets/dist/images/ruang.kelas.png" alt="Foto Ruangan" class="room-image img-fluid mb-3" style="width:70%;">
                                                            </div>
                                                            <div class="text-center mb-3">
                                                                <button type="button" class="btn btn-info" style="width: 80%;" data-toggle="modal" data-target="#modal-lg">
                                                                    Lihat Foto Ruangan
                                                                </button>
                                                            </div>

                                                            <!-- Modal detail foto -->
                                                            <div class="modal fade" id="modal-lg">
                                                                <div class="modal-dialog modal-lg" style="max-width: max-content;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"><strong>Detail Foto
                                                                                    Ruangan</strong></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <img src="<?= $relativePath ?>assets/dist/images/ruang.kelas.png" alt="ruangan">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End modal foto -->
                                                        </div>

                                                        <div class="card col-lg-8">
                                                            <div class="card-header d-flex">
                                                                <h3><strong>Informasi
                                                                        Ruangan</strong></h3>
                                                                <button type="button" class="btn btn-info ml-auto" data-toggle="modal" data-target="#editInfoRuangModal">
                                                                    Edit Informasi Ruangan
                                                                </button>
                                                            </div>
                                                            <div class="card-body p-0">
                                                                <table class="table table-striped">
                                                                    <tr>
                                                                        <th scope="row">Kode Ruang</th>
                                                                        <td><span id="kodeRuang">RT14-BT</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Nama Ruang</th>
                                                                        <td><span id="namaRuang">Ruang Teori
                                                                                14</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Kapasitas</th>
                                                                        <td><span id="kapasitas">60</span> orang
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">Posisi Lantai</th>
                                                                        <td><span id="posisiLantai">8T</span></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- Jadwal Ruang -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="card col-lg-12">
                                                            <!-- /.card-header -->
                                                            <div class="card-header d-flex">
                                                                <h3><strong>Jadwal Ruangan</strong></h3>
                                                                <button type="button" class="btn btn-info ml-auto" data-toggle="modal" data-target="#editJadwalRuangModal">
                                                                    Edit Jadwal Ruangan
                                                                </button>
                                                            </div>
                                                            <div class="card-body">
                                                                <table id="jadwalRuang" class="table table-bordered table-hover table-responsive">
                                                                    <thead>
                                                                        <tr style="text-align: center;">
                                                                            <th rowspan="2"></th>
                                                                            <th>1</th>
                                                                            <th>2</th>
                                                                            <th>3</th>
                                                                            <th>4</th>
                                                                            <th>5</th>
                                                                            <th>6</th>
                                                                            <th>7</th>
                                                                            <th>8</th>
                                                                            <th>9</th>
                                                                            <th>10</th>
                                                                            <th>11</th>
                                                                        </tr>
                                                                        <tr style="text-align: center; white-space: nowrap; font-size: small;">
                                                                            <th>07:50 - 08:40</th>
                                                                            <th>07:50 - 08:40</th>
                                                                            <th>08:40 - 09:30</th>
                                                                            <th>09:40 - 10:30</th>
                                                                            <th>10:30 - 11:20</th>
                                                                            <th>11:20 - 12:10</th>
                                                                            <th>12:50 - 13:40</th>
                                                                            <th>13:40 - 14:30</th>
                                                                            <th>14:30 - 15:20</th>
                                                                            <th>15:30 - 16:20</th>
                                                                            <th>16:20 - 17:10</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Senin</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Selasa</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Rabu</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Kamis</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jumat</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Detail Ruang -->
                                    <!-- Modal Edit Info Ruang -->
                                    <div class="modal fade" id="editInfoRuangModal">
                                        <div class="modal-dialog modal-lg" style="width: 50%;">
                                            <div class="modal-content" style="background-color: #D9D9D9;">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><strong>Edit Informasi Ruangan</strong></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <form>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="kodeRuang">Kode Ruang</label>
                                                                    <input type="text" class="form-control" id="nama" placeholder="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="namaRuang">Nama Ruang</label>
                                                                    <input type="text" class="form-control" id="namaRuang" placeholder="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kapasitas">Kapasitas</label>
                                                                    <input type="text" class="form-control" id="kapasitas" placeholder="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="lantai">Lantai</label>
                                                                    <input type="text" class="form-control" id="lantai" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="submit" class="btn btn-primary float-right"><span class="material-icons">
                                                                        Simpan Perubahan
                                                                    </span></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit Ruang -->
                                    <!-- Modal Edit jadwal Ruang -->
                                    <div class="modal fade" id="editJadwalRuangModal">
                                        <div class="modal-dialog modal-lg" style="width: 50%;">
                                            <div class="modal-content" style="background-color: #D9D9D9;">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><strong>Edit Jadwal Ruangan</strong></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <form>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="hari">Hari</label>
                                                                    <input type="text" class="form-control" id="hari" placeholder="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jam">Jam</label>
                                                                    <input type="text" class="form-control" id="jam" placeholder="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="namaDosen">Nama Dosen</label>
                                                                    <input type="text" class="form-control" id="namaDosen" placeholder="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="mataKuliah">Mata Kuliah</label>
                                                                    <input type="text" class="form-control" id="mataKuliah" placeholder="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kelas">Kelas</label>
                                                                    <input type="text" class="form-control" id="kelas" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="submit" class="btn btn-primary float-right"><span class="material-icons">
                                                                        Simpan Perubahan
                                                                    </span></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit Ruang -->
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        <script src="<?= $relativePath ?>assets/plugins/lte/scripts/jquery.overlayScrollbars.min.js"></script>
        <script src="<?= $relativePath ?>assets/dist/scripts/admin/index.js"></script>
        <script src="<?= $relativePath ?>assets/dist/scripts/components/switcher.js"></script>
</body>

</html>