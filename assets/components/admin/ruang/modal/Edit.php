<div class="modal fade" id="editRuang">
  <div class="modal-dialog modal-lg" style="width: 50%;">
    <div class="modal-content" style="background-color: #D9D9D9;">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Edit Informasi Ruangan</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <form id="formEditRuang">
            <div class="card-body">
              <div class="form-group">
                <label for="kodeRuang">Kode Ruang</label>
                <input type="text" class="form-control" id="modalEditKodeRuang" name="kode_ruang">
              </div>
              <div class="form-group">
                <label for="namaRuang">Nama Ruang</label>
                <input type="text" class="form-control" id="modalEditNamaRuang" name="nama_ruang">
              </div>
              <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="text" class="form-control" id="modalEditKapasitas" name="kapasitas">
              </div>
              <div class="form-group">
                <label for="lantai">Lantai</label>
                <input type="text" class="form-control" id="modalEditLantai" name="lantai">
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