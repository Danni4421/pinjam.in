<div class="modal fade" id="detail">
  <div class="modal-dialog modal-xl">
    <div class="modal-content px-3" style="background-color: #D9D9D9;">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Detail Ruangan</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="text-center mb-3">
              <img id="mainModalImage" alt="Foto Ruangan" class="room-image img-fluid mb-3" style="width:70%;">
            </div>
            <div class="text-center mb-3">
              <button type="button" class="btn btn-info" style="width: 80%;" data-toggle="modal" id="btnImageModal" data-target="#modalImage">
                Lihat Foto Ruangan
              </button>
            </div>
          </div>

          <div class="card col-lg-8">
            <div class="card-header d-flex">
              <h3><strong>Informasi
                  Ruangan</strong></h3>
              <button type="button" class="btn btn-info ml-auto" id="btnEditModal" data-toggle="modal" data-target="#editRuang">
                Edit Informasi Ruangan
              </button>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped">
                <tr>
                  <th scope="row">Kode Ruang</th>
                  <td><span id="mainModalKodeRuang"></span></td>
                </tr>
                <tr>
                  <th scope="row">Nama Ruang</th>
                  <td><span id="mainModalNamaRuang">Ruang Teori
                    </span>
                  </td>
                </tr>
                <tr>
                  <th scope="row">Kapasitas</th>
                  <td><span id="mainModalKapasitas"></span> orang
                  </td>
                </tr>
                <tr>
                  <th scope="row">Posisi Lantai</th>
                  <td><span id="mainModalLantai"></span></td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Jadwal Ruang -->
        </div>
        <div class="row">
          <div class="card col-lg-12">
            <div class="card-header d-flex">
              <h3><strong>Jadwal Ruangan</strong></h3>
              <button type="button" class="btn btn-info ml-auto" data-toggle="modal" id="mainBtnEditModal" data-target="#editJadwal">
                Edit Jadwal Ruangan
              </button>
            </div>
            <div class="card-body">
              <table id="jadwalRuang" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr style="text-align: center;">
                    <th rowspan="2"></th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                  </tr>
                  <tr style="text-align: center; white-space: nowrap; font-size: small;">
                    <th>07:50 - 08:40</th>
                    <th>07:50 - 08:40</th>
                    <th>08:40 - 09:30</th>
                    <th>09:40 - 10:30</th>
                    <th>10:30 - 11:20</th>
                    <th>11:20 - 12:10</th>
                    <th>12:50 - 13:40</th>
                    <th>13:40 - 14:30</th>
                    <th>14:30 - 15:20</th>
                    <th>15:30 - 16:20</th>
                    <th>16:20 - 17:10</th>
                  </tr>
                </thead>
                <tbody id="mainModalBodyJadwal">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'assets/components/admin/ruang/modal/Edit.php';
require_once 'assets/components/admin/ruang/modal/Image.php';
?>