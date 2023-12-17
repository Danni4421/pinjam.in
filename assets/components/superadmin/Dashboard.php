<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 style="text-align: center;">Dashboard</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <!-- /.card-body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="assets/dist/images/admin.dashboard.png" alt="dashboard" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h1><strong>Peminjaman Ruangan Jurusan Teknologi Informasi</strong></h1><br>
                            <p>Aplikasi Peminjaman Ruangan dirancang khusus untuk memfasilitasi proses
                                peminjaman atau reservasi ruang kelas di lingkungan universitas. Aplikasi ini
                                ditujukan untuk digunakan oleh staf administrasi, dosen, bahkan mahasiswa atau
                                pihak yang berwenang di universitas tersebut.</p><br>
                        </div>
                    </div>
                </div><!-- /.card-body -->
            </div>

            <!-- Table -->
            <div class="card">
                <!-- /.card-body -->
                <div class="card-body">
                    <!-- Table Ruang Kelas -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ruang Kelas</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: fit-content;">
                                            <a href="/admin/ruang/kelas"><button type="button" class="btn btn-info btn-sm btn-auto" style="margin-right: 10px; width: 80px;">Kelola</button></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Daftar Ruang</th>
                                                <th>Jumlah Kapasitas</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list-ruang-kelas">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Table Ruang Dosen -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ruang Dosen</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: fit-content;">
                                            <a href="/admin/ruang/dosen"><button type="button" class="btn btn-info btn-sm btn-auto" style="margin-right: 10px; width: 80px;">Kelola</button></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Daftar Ruang</th>
                                                <th>Jumlah Dosen</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list-ruang-dosen">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>