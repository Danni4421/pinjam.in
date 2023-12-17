<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 style="text-align: center;">Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?= $relativePath ?>assets/dist/images/admin.dashboard.png" alt="dashboard" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h2><strong>Peminjaman Ruangan <br>Jurusan Teknologi Informasi</strong></h2>
                            <p>Aplikasi Peminjaman Ruangan dirancang khusus untuk memfasilitasi proses
                                peminjaman atau reservasi ruang kelas di lingkungan universitas. Aplikasi ini
                                ditujukan untuk digunakan oleh staf administrasi, dosen, bahkan mahasiswa atau
                                pihak yang berwenang di universitas tersebut.</p><br>
                            <div class="mt-1">
                                <a href="persetujuan.php"><button type="button" class="btn btn-info">Kelola Persetujuan</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ruang Kelas</h3>

                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>