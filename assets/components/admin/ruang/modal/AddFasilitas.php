<div class="modal fade" id="addFasilitasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-add-fasilitas">
          <div class="input-group mb-3 d-flex flex-column">
            <label for="fasilitas">Fasilitas</label>
            <select class="select-fasilitas form-control" name="fasilitas[]" id="fasilitas" multiple>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="add-fasilitas">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>