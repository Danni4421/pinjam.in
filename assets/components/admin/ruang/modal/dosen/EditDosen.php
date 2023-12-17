<!-- Modal Edit Data Dosen -->
<div class="modal fade" id="editDosen">
  <div class="modal-dialog modal-lg" style="width: 50%;">
    <div class="modal-content" style="background-color: #D9D9D9;">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Edit Dosen</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <form method="POST" id="formEditDosen" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <label for="editNipDosen">NIP</label>
                <input type="text" class="form-control" id="editNipDosen" name="nomor_induk">
              </div>
              <div class="form-group">
                <label for="editNamaDosen">Nama</label>
                <input type="text" class="form-control" id="editNamaDosen" name="nama_lengkap">
              </div>
              <div class="form-group">
                <label for="editAlamatDosen">Alamat</label>
                <input type="text" class="form-control" id="editAlamatDosen" name="alamat">
              </div>
              <div class="form-group">
                <label for="editTelpDosen">Nomor Telepon</label>
                <input type="text" class="form-control" id="editTelpDosen" name="no_telp">
              </div>
              <div class="form-group">
                <label for="addFotoProfil">Foto Profil</label> <br>
                <img id="editImagePreview" class="mb-3" width="50" height="50">
                <input type="file" class="form-control" id="editFotoProfil" name="foto_profil">
                <input type="hidden" id="editFotoProfilLama" name="old_foto_profil">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right"><span class="material-icons">
                  Simpan Perubahan
                </span></button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div>
<!-- End Modal Edit Data Dosen -->