<div class="modal fade" id="modalEditJadwal">
  <div class="modal-dialog modal-lg" style="width: 50%;">
    <div class="modal-content" style="background-color: #D9D9D9;">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Edit Jadwal Ruangan</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <form id="form-edit-jadwal">
            <div class="card-body">
              <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" id="edit-hari" class="form-control">
                  <option value="2">Senin</option>
                  <option value="3">Selasa</option>
                  <option value="4">Rabu</option>
                  <option value="5">Kamis</option>
                  <option value="6">Jumat</option>
                </select>
              </div>
              <div class="form-group">
                <label for="edit-jam-mulai">Jam Mulai</label>
                <select class="custom-select" id="edit-jam-mulai">
                </select>
              </div>
              <div class="form-group">
                <label for="edit-jam-selesai">Jam Selesai</label>
                <select class="custom-select" id="edit-jam-selesai">
                </select>
              </div>
              <div class="form-group">
                <label for="edit-mataKuliah">Mata Kuliah</label>
                <select class="form-control" id="edit-matakuliah" name="ruang" data-placeholder="Pilih Mata Kuliah">
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right"><span class="material-icons">
                  Simpan Perubahan
                </span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>