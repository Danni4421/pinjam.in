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

        if (true) {
            require 'assets/components/admin/Sidebar.php';
        } else {
            require 'assets/components/superadmin/Sidebar.php';
        }

        require 'assets/components/admin/Footer.php';
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="text-align: center;">Kalender</h1>
                        </div>
                    </div>
                </div>
            </section>

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


                        <!-- Start content table -->
                        <div class="container-fluid row justify-content-between p-5">
                            <aside class="col-2" style="margin-top:3%;">
                                <span class="d-block mb-2">Keterangan Aktifitas?</span>
                                <div class="d-flex flex-column gap-2">
                                    <a href="#" class="btn btn-warning py-2 w-100 text-start mb-1">Kegiatan
                                        Mahasiswa</a>
                                    <a href="#" class="btn btn-info py-2 w-100 text-start">Kegiatan Dosen</a>
                                </div>
                            </aside>
                            <main class="col-10">
                                <div class="header d-flex justify-content-between mb-3">
                                    <div class="navigation d-flex gap-2">
                                        <div class="btn btn-primary btn-navigation mr-1">
                                            <i class="fa fa-chevron-left"></i>
                                        </div>
                                        <div class="btn btn-primary btn-navigation mr-1">
                                            <i class="fa fa-chevron-right"></i>
                                        </div>
                                        <button class="btn btn-info information">
                                            <span>Hari Ini</span>
                                        </button>
                                    </div>
                                    <div class="date">
                                        <h4>
                                            <center>November 2023</center>
                                        </h4>
                                    </div>
                                    <div class="pagination">
                                        <nav aria-label="...">
                                            <ul class="pagination pagination-md m-0">
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">Month</span>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">Week</a></li>
                                                <li class="page-item"><a class="page-link" href="#">Day</a></li>
                                                <li class="page-item"><a class="page-link" href="#">List</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="content rounded-5">
                                    <table class="table table-striped">
                                        <thead class="">
                                            <tr class="text-center">
                                                <th>Senin</th>
                                                <th>Selasa</th>
                                                <th>Rabu</th>
                                                <th>Kamis</th>
                                                <th>Jumat</th>
                                                <th>Sabtu</th>
                                                <th>Minggu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning">Event</button>
                                                </td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>6</td>
                                                <td>7</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>9</td>
                                                <td>10</td>
                                                <td>
                                                    <button type="button" class="btn btn-info">
                                                        DESPRO_WEB_TI
                                                    </button>
                                                </td>
                                                <td>12</td>
                                                <td>13</td>
                                                <td>14</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>16</td>
                                                <td>17</td>
                                                <td>18</td>
                                                <td>19</td>
                                                <td>20</td>
                                                <td>21</td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>23</td>
                                                <td>24</td>
                                                <td>25</td>
                                                <td>26</td>
                                                <td>27</td>
                                                <td>28</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn btn-danger">
                                                        Rapat
                                                    </button>
                                                </td>
                                                <td>30</td>
                                                <td>31</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="<?= $relativePath ?>assets/plugins/lte/scripts/jquery.overlayScrollbars.min.js"></script>
        <script src="<?= $relativePath ?>assets/dist/scripts/admin/index.js"></script>
        <script src="<?= $relativePath ?>assets/dist/scripts/components/switcher.js"></script>
</body>

</html>