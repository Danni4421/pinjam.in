<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin" class="brand-link">
        <img src="<?= $relativePath ?>assets/dist/images/jti.logo.png" alt="Logo JTI" class="brand-image">
        <span class="brand-text font-weight-bold">Pinjam.in</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/admin" class="nav-link <?= $uri == "/admin" ? "active" : "" ?>">
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
                    <a href="/admin/ruang/kelas" class="nav-link <?= $uri == "/admin/ruang/kelas" ? "active" : "" ?>">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                            Ruang Kelas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/persetujuan" class="nav-link <?= $uri == "/admin/persetujuan" ? "active" : "" ?>">
                        <i class="nav-icon fa fa-thumbs-up"></i>
                        <p>
                            Persetujuan
                        </p>
                    </a>
                </li>
                <li class="nav-item" id="logoutButton">
                    <button class="nav-link btn btn-block btn-outline-secondary" style="background-color: transparent;">
                        <span class="logout-icon hide"><i class="nav-icon fas fa-sign-out-alt"></i></span>
                        <span class="logout-text">Keluar</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</aside>