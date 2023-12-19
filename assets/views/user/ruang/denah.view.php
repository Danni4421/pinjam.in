<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam.in - Peminjaman Ruangan JTI</title>
    <?php require_once 'assets/dist/styles/user/styles.php'; ?>
</head>

<body>
    <!-- Navbar -->
    <?php require_once 'assets/components/user/Navbar.php'; ?>
    <!-- End Navbar -->

    <main id="main">
        <section class="content">
            <div class="container-fluid">
                <div class="card" style="padding: 2% 5%; margin-top: 40px;">
                    <div class="row g-0">
                        <div class="container-fluid mt-3">
                            <div class="section-title">
                            <h2>Denah</h2>
                            <p>Denah Gedung JTI</p>
                            </div>
                            <div class="row row-cols-1 gap-3">
                                <div class="card col-sm-12 p-0">
                                    <div class="card-header" style="background-color: #1318A5; color: white;">
                                    <h3 class="card-title"><strong>Lantai 5</strong></h3>
                                    <p class="card-text"><small class="text-muted" style="color: whitesmoke !important;">Jumlah Ruangan: 11</small></p>
                                    </div>
                                    <div class="card-body">
                                        <a href="../assets/dist/images/denah/lantai5.jpg">
                                            <img src="../assets/dist/images/denah/lantai5.jpg" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <div class="card col-sm-12 p-0">
                                    <div class="card-header" style="background-color: #1318A5; color: white;">
                                    <h3 class="card-title"><strong>Lantai 6</strong></h3>
                                    <p class="card-text"><small class="text-muted" style="color: whitesmoke !important;">Jumlah Ruangan: 20</small></p>
                                    </div>
                                    <div class="card-body">
                                        <a href="../assets/dist/images/denah/lantai6.jpg">
                                            <img src="../assets/dist/images/denah/lantai6.jpg" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <div class="card col-sm-12 p-0">
                                    <div class="card-header" style="background-color: #1318A5; color: white;">
                                    <h3 class="card-title"><strong>Lantai 7</strong></h3>
                                    <p class="card-text"><small class="text-muted" style="color: whitesmoke !important;">Jumlah Ruangan: 20</small></p>
                                    </div>
                                    <div class="card-body">
                                        <a href="../assets/dist/images/denah/lantai7.jpg">
                                            <img src="../assets/dist/images/denah/lantai7.jpg" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <div class="card col-sm-12 p-0">
                                    <div class="card-header" style="background-color: #1318A5; color: white;">
                                    <h3 class="card-title"><strong>Lantai 8</strong></h3>
                                    <p class="card-text"><small class="text-muted" style="color: whitesmoke !important;">Jumlah Ruangan: 6</small></p>
                                    </div>
                                    <div class="card-body">
                                        <a href="../assets/dist/images/denah/lantai8.jpg">
                                            <img src="../assets/dist/images/denah/lantai8.jpg" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </main><!-- End #main -->


    <?php
    require_once 'assets/components/user/Footer.php';
    require_once 'assets/dist/scripts/user/scripts.php';
    ?>
    <script src="../assets/dist/scripts/user/ruang/kelas.js"></script>
</body>

</html>