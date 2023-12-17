<div class="modal fade" id="editJadwal">
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
          <form>
            <div class="card-body">
              <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" id="hari" class="form-control">
                  <option value="2" selected>Senin</option>
                  <option value="3">Selasa</option>
                  <option value="4">Rabu</option>
                  <option value="5">Kamis</option>
                  <option value="6">Jumat</option>
                </select>
              </div>
              <div class="form-group">
                <label for="jam">Jam</label>
                <input type="text" class="form-control" id="jam" placeholder="">
              </div>
              <div class="form-group">
                <label for="jam">Jam</label>
                <input type="text" class="form-control" id="jam" placeholder="">
              </div>
              <div class="form-group">
                <select class="form-select" id="multiple-select-field" name="ruang" data-placeholder="Pilih Mata Kuliah">
                  <option>Lab Sistem Informasi 1</option>
                  <option>Lab Sistem Informasi 2</option>
                  <option>Lab Sistem Informasi 3</option>
                </select>
              </div>
              <div class="form-group">
                <label for="mataKuliah">Mata Kuliah</label>
                <input type="text" class="form-control" id="mataKuliah" placeholder="">
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