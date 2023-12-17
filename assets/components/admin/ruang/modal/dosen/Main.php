<!-- Modal Detail Ruang -->
<div class="modal fade" id="detail">
  <div class="modal-dialog modal-scrollable modal-xl">
    <div class="modal-content px-3" style="background-color: #D9D9D9;">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Detail Ruangan Dosen</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="text-center mb-3">
              <img alt="Foto Ruangan" class="room-image img-fluid mb-3" id="mainModalImage">
            </div>
            <div class="text-center mb-3">
              <button type="button" id="btnImageModal" class="btn btn-primary" style="width: 80%;" data-toggle="modal" data-target="#modalImage">
                Lihat Foto Ruangan
              </button>
            </div>
          </div>
          <div class="card col-lg-8">
            <div class="card-header">
              <h3 class="card-title"><strong>Informasi
                  Ruangan</strong></h3>
              <button type="button" class="btn btn-primary float-right" id="btnEditModal" data-toggle="modal" data-target="#editRuang">
                Edit Informasi Ruangan
              </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <tr>
                  <th scope="row">Kode Ruang</th>
                  <td><span id="mainModalKodeRuang"></span></td>
                </tr>
                <tr>
                  <th scope="row">Nama Ruang</th>
                  <td><span id="mainModalNamaRuang"></span>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Kapasitas</th>
                  <td><span id="mainModalKapasitas"></span> orang</td>
                </tr>
                <tr>
                  <th scope="row">Lantai</th>
                  <td><span id="mainModalLantai"></span></td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="row">
          <div class="card col-lg-12">
            <!-- /.card-header -->
            <div class="card-header d-flex">
              <h3 class="card-title"><strong>Daftar
                  Dosen</strong></h3>
              <button type="button" id="btnAddDosen" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addDosen">
                Tambah Data Dosen
              </button>
            </div>
            <div class="card-body">
              <table id="table-dosen" class="table table-bordered table-hover table-dosen">
                <thead>
                  <tr style="text-align: center;">
                    <th>Foto Dosen</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="list-dosen">
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

<?php
require_once 'assets/components/admin/ruang/modal/Edit.php';
require_once 'assets/components/admin/ruang/modal/Image.php';
?>