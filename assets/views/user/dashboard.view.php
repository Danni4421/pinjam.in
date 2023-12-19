<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam.in - Peminjaman Ruangan JTI</title>
    <?php require_once 'assets/dist/styles/user/styles.php'; ?>
</head>

<body>
    <?php require_once 'assets/components/user/Navbar.php'; ?>

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                    <div data-aos="zoom-out">
                        <h1>Mau Pinjam Ruang Anti Ribet? <span>Pinjam.in</span> aja</h1>
                        <h2>Dari Pengajuan Sampai Persetujuan Semua Proses Peminjaman Dilakukan Secara Online</h2>
                        <form style="width: 410px;" action="/ruang" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari Ruangan..">
                                <div class="input-group-text">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
                    <img src="assets/dist/images/home.png" class="img-fluid animated" alt="" style="width: 350px;">
                </div>
            </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
            </g>
        </svg>

    </section>
    <!-- End Hero Section -->
    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-5 col-lg-6 d-flex justify-content-center align-items-stretch" data-aos="fade-right">
                        <img src="assets/dist/images/details-1.png" class="img-fluid" alt="logo" style="margin-left: 100px; margin-top: 80px;">
                    </div>

                    <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
                        <h3>Apa sih Pinjam.in itu?</h3>
                        <p>Pinjam.in merupakan sebuah website peminjaman ruangan di gedung Jurusan Teknologi Informasi
                            Politeknik
                            Negeri Malang. Website ini dibuat guna untuk memenuhi tugas akhir semester ganjil. Website
                            ini dibuat oleh
                            kelompok 4 kelas TI-2A.</p>
                        <p>Beberapa Keunggulan Ketika Anda Menggunakan Website ini:</p>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon"><i class="bx bx-fingerprint"></i></div>
                            <h4 class="title" style="text-align: left;">Mudah</h4>
                            <p class="description">Website ini mudah digunakan, karena dilengkapi dengan panduan yang
                                mudah untuk
                                dilakukan.</p>
                        </div>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon"><i class="bx bx-shield-plus"></i></div>
                            <h4 class="title" style="text-align: left;">Aman</h4>
                            <p class="description">Segala data yang sudah Anda inputkan pada website ini akan terjaga
                                keamanannya.</p>
                        </div>

                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon"><i class="bx bx-atom"></i></div>
                            <h4 class="title" style="text-align: left;">Nyaman</h4>
                            <p class="description">Proses peminjaman ruangan akan terasa nyaman, karena semua proses
                                dari pengajuan
                                sampai persetujuan bisa dilakukan secara online</p>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Sarana dan Prasarana</h2>
                    <p>Ruangan Gedung JTI</p>
                </div>

                <div class="row" data-aos="fade-left">
                    <div class="col-lg-3 col-md-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
                            <i class="bi bi-building" style="color: #ffbb2c;"></i>
                            <h3>Perkantoran</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                            <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
                            <h3>Laboratorium</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="150">
                            <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
                            <h3>Ruang Kelas</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                            <i class="bi bi-bank" style="color: #e361ff;"></i>
                            <h3>Ruang Auditorium</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="250">
                            <i class="bi bi-book" style="color: #47aeff;"></i>
                            <h3>Ruang Baca</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                            <i class="bi bi-buildings" style="color: #ffa76e;"></i>
                            <h3>Musholla</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="350">
                            <i class="bi bi-droplet" style="color: #11dbcf;"></i>
                            <h3>Kamar Mandi</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="400">
                            <i class="ri-store-line" style="color: #4233ff;"></i>
                            <h3>Kantin</h3>
                        </div>
                    </div>
                </div>
        </section>
        <!-- End Features Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">

                <div class="row" data-aos="fade-up">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-building"></i>
                            <span data-purecounter-start="0" data-purecounter-end="8" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Perkantoran</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="ri-bar-chart-box-line"></i>
                            <span data-purecounter-start="0" data-purecounter-end="6" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Laboratorium</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="ri-calendar-todo-line"></i>
                            <span data-purecounter-start="0" data-purecounter-end="7" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Ruang Kelas</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="bi bi-bank"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Ruang Auditorium</p>
                        </div>
                    </div>

                </div>

            </div>

        </section>
        <section id="counts" class="counts">
            <div class="container">

                <div class="row" data-aos="fade-up">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-book"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Ruang Baca</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="bi bi-buildings"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Musholla</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="bi bi-droplet"></i>
                            <span data-purecounter-start="0" data-purecounter-end="8" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Kamar Mandi</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="ri-store-line"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Kantin</p>
                        </div>
                    </div>

                </div>

            </div>

        </section>
        <!-- End Counts Section -->

        <!-- ======= Panduan Section ======= -->
        <div class="container guide p-4 my-3">
            <div class="section-title" data-aos="fade-up">
                <h2>Penduan Peminjaman</h2>
                <p>Ruangan Gedung JTI</p>
            </div>
            <?php require_once 'assets/components/user/Panduan.php'; ?>
        </div>
        <!-- End Panduan Section -->

        <!-- ======= Pinjam Section ======= -->
        <section id="pinjam" class="testimonials">
            <div class="container">

                <div class="Testimonials swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <h3>Ingin Meminjam Ruangan JTI?</h3>
                                <h4>Jangan Lupa Baca Panduan Terlebih dahulu</h4>
                                <a href="/peminjaman"><button type="button" class="btn btn-primary">Ajukan Peminjaman</button></a>
                            </div>
                        </div><!-- End testimonial item -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- End Pinjam Section -->

        <?php require_once 'assets/components/user/Gallery.php'; ?>
    </main>

    <?php
    require_once 'assets/components/user/Footer.php';
    require_once 'assets/dist/scripts/user/scripts.php';
    ?>

</body>

</html>