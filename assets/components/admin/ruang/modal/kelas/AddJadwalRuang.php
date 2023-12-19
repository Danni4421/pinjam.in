<div class="modal fade" id="modalAddJadwal">
  <div class="modal-dialog modal-lg" style="width: 50%;">
    <div class="modal-content" style="background-color: #D9D9D9;">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Tambah Jadwal Ruangan</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <form id="form-add-jadwal">
            <div class="card-body">
              <div class="form-group">
                <label for="add-hari">Hari</label>
                <select name="hari" id="add-hari" class="form-control">
                  <option value="2">Senin</option>
                  <option value="3">Selasa</option>
                  <option value="4">Rabu</option>
                  <option value="5">Kamis</option>
                  <option value="6">Jumat</option>
                </select>
              </div>
              <div class="form-group">
                <label for="add-jam-mulai">Jam Mulai</label>
                <select class="custom-select" id="add-jam-mulai">
                </select>
              </div>
              <div class="form-group">
                <label for="add-jam-selesai">Jam Selesai</label>
                <select class="custom-select" id="add-jam-selesai">
                </select>
              </div>
              <div class="form-group">
                <label for="add-mataKuliah">Mata Kuliah</label>
                <select class="custom-select" id="add-matakuliah">
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right" id="btn-add-jadwal" disabled><span class="material-icons">
                  Tambah Jadwal
                </span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>