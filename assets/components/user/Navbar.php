<nav class="container-fluid shadow navbar navbar-expand-lg justify-content-center px-3 px-lg-0 py-0 py-lg-1">
    <div class="container row justify-content-between align-items-center">
        <a class="navbar-brand col-4" href="#">
            <img src="assets/dist/images/logo-dark.png" width="100">
        </a>
        <button class="navbar-toggler col-4 w-25" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="max-width: 20%">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-6 collapse navbar-collapse d-lg-flex justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav justify-content-between" style="min-width: 65%">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/peminjaman">Peminjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Panduan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ruang">Ruang</a>
                </li>
            </ul>
            <div class="col-4 d-none d-lg-block">
                <ul class="navbar-nav justify-content-end align-items-center gap-2">
                    <li class="nav-item dropdown">
                        <button class="border-0" style="background: none; font-size: 1.5em;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bell"></i>
                            <span class="badge text-bg-danger position-absolute" style="left: 20px; top: 15px; font-size: .6rem;">0</span>
                        </button>
                        <ul class="dropdown-menu p-2">
                            <li class="dropdown-item">Ini adalah notifikasi <span class="badge text-bg-danger">1</span></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="border-0" style="background: none;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="#" width="50" height="50" style="border-radius: 50%;" loading="lazy" />
                        </button>
                        <ul class="dropdown-menu p-2">
                            <li>
                                <a class="dropdown-item" href="/account">Kelola Akun</a>
                            </li>
                            <a class="dropdown-item btn btn-danger" href="signout.php">Logout</a>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>