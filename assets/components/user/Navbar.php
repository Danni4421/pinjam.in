<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top " style="background-color: rgba(18, 23, 165, 0.75);">
    <div class="container-fluid">
        <div class="logo">
            <a href="/" alt="logo"><span><img src="<?= $relativePath ?>assets/dist/images/pinjam.in.png" style="width: 150px;"></span></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link nav-link-index active" href="/">Home</a></li>
                <li><a class="nav-link nav-link-index" href="/#features">Sarpras</a></li>
                <li><a class="nav-link nav-link-index" href="/#panduan">Panduan</a></li>
                <li><a class="nav-link nav-link-index" href="/#pinjam">Pinjam</a></li>
                <li class="dropdown"><a class="nav-link" href="/ruang"><span>Ruangan</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="nav-link" href="/ruang/kelas">Ruang Kelas</a></li>
                        <li><a class="nav-link" href="/ruang/auditorium">Ruang Auditorium</a></li>
                        <li><a class="nav-link" href="/ruang/laboratorium">Laboratorium</a></li>
                        <li><a class="nav-link" href="/ruang/dosen">Ruang Dosen</a></li>
                    </ul>
                </li>
                <!-- Halaman Profil Guest-->
                <li class="dropdown"><a href="#profil"><i class="bi bi-person-circle" style="font-size: 20px;"></i><i class="bi bi-chevron-down"></i></a>
                    <ul class="mr-3">
                        <?php if (Auth::verify_cookie()) { ?>
                            <li>
                                <a class="nav-link" href="/account">Kelola Akun</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="nav-link" href="/logout"><span>Logout</span><i class=""></i></a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a class="nav-link" href="/login"><span>Login</span><i class=""></i></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="nav-link" href="/register"><span>Daftar</span><i class=""></i></a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>
</nav>
<!-- End Navbar -->