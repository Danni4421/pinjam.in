<!-- Modal Tambah Dosen -->
<div class="modal fade" id="addDosen">
  <div class="modal-dialog modal-lg" style="width: 50%;">
    <div class="modal-content" style="background-color: #D9D9D9;">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Tambah Dosen</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <form method="POST" id="formAddDosen" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <label for="addEmail">Email</label>
                <input type="email" class="form-control" id="addEmail" name="email">
              </div>
              <div class="form-group">
                <label for="addNomorInduk">NIP</label>
                <input type="text" class="form-control" id="addNomorInduk" name="nomor_induk">
              </div>
              <div class="form-group">
                <label for="addNamaDosen">Nama</label>
                <input type="text" class="form-control" id="addNamaDosen" name="nama_lengkap">
              </div>
              <div class="form-group">
                <label for="addAlamat">Alamat</label>
                <input type="text" class="form-control" id="addAlamat" name="alamat">
              </div>
              <div class="form-group">
                <label for="addNotelp">Nomor Telepon</label>
                <input type="text" class="form-control" id="addNotelp" name="no_telp">
              </div>
              <div class="form-group">
                <label for="addFotoProfil">Foto Profil</label>
                <input type="file" class="form-control" id="addFotoProfil" name="foto_profil">
              </div>
            </div>
            <div class="card-footer">
              <button id="btnAddDosen" class="btn btn-primary float-right"><span class="material-icons">
                  Simpan
                </span></button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div>
<!-- End Modal Tambah Dosen -->