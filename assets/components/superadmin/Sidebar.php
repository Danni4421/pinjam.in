<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin" class="brand-link">
        <img src="<?= $relativePath ?>assets/dist/images/jti.logo.png" alt="Logo JTI" class="brand-image">
        <span class="brand-text font-weight-bold">Pinjam.in</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/admin" class="nav-link <?= $uri == "/admin" ? "active" : "" ?> ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kalender" class="nav-link <?= $uri == "/admin/kalender" ? "active" : "" ?>">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Kalender
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/user" class="nav-link <?= $uri == "/admin/user" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/ruang/kelas" class="nav-link <?= $uri == "/admin/ruang/kelas" ? "active" : "" ?>">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                            Ruang Kelas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/ruang/dosen" class="nav-link <?= $uri == "/admin/ruang/dosen" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Ruang Dosen
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/riwayat" class="nav-link <?= $uri == "/admin/riwayat" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Riwayat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/fasilitas" class="nav-link <?= $uri == "/admin/fasilitas" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-ethernet"></i>
                        <p>
                            Fasilitas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/matakuliah" class="nav-link <?= $uri == "/admin/matakuliah" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Mata Kuliah
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/jamkuliah" class="nav-link <?= $uri == "/admin/jamkuliah" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Jam Kuliah
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="logoutButton">
                    <button class="nav-link btn btn-block btn-outline-secondary" style="background-color: transparent;">
                        <span class="logout-icon hide"><i class="nav-icon fas fa-sign-out-alt"></i></span>
                        <a href="/logout">
                            <span class="logout-text">Logout</span>
                        </a>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</aside>