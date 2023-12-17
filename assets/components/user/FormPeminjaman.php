<h4 class="form-title fw-bolder mb-3">Form Pengajuan Peminjaman</h4>
<form action="POST" enctype="multipart/form-data" id="form-peminjaman">
    <input type="hidden" id="user_id" value="<?= isset($_COOKIE["user_id"]) ? $_COOKIE["user_id"] : null ?>">
    <div class="input-group mb-3">
        <span class="input-group-text" id="instansi">Instansi</span>
        <input type="text" class="form-control" id="input_instansi" name="instansi" aria-label="instansi" aria-describedby="instansi" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="keterangan">Keterangan</span>
        <textarea class="form-control" id="input_keterangan" name="keterangan" aria-label="keterangan" aria-describedby="keterangan" required></textarea>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="tanggal_kegiatan">Tanggal Mulai</span>
        <input type="date" id="tanggal_kegiatan_mulai" name="tanggal_mulai" class="form-control" aria-label="tanggal_kegiatan" aria-describedby="tanggal_kegiatan" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="tanggal_kegiatan">Tanggal Selesai</span>
        <input type="date" id="tanggal_kegiatan_selesai" name="tanggal_selesai" class="form-control" aria-label="tanggal_kegiatan" aria-describedby="tanggal_kegiatan" required>
    </div>
    <div class="input-group mb-3">
        <input type="time" id="jam_mulai" name="jam_mulai" class="form-control" required>
        <span class="input-group-text">Mulai</span>
        <span class="input-group-text">Selesai</span>
        <input type="time" id="jam_selesai" name="jam_selesai" class="form-control" required>
    </div>
    <div class="input-group mb-3 d-flex flex-column">
        <label for="multiple-select-field" class="input-group-text">Pilih Ruang</label>
        <select class="select-ruang" name="ruang[]" id="ruang" multiple>
        </select>
    </div>
    <div class="input-group mb-3">
        <label for="logo_instansi" class="input-group-text">Logo Instansi</label>
        <input class="form-control" type="file" name="foto_instansi" id="foto_instansi">
    </div>
    <div class="row justify-content-center gap-4 mb-3">
        <button type="submit" class="col-6 btn btn-success" id="btn-peminjaman" style="background-color: #3f43fd;" disabled>Pinjam</button>
        <a href="/" class="col-5 btn btn-secondary">Batal</a>
        <small class="text-center">Selain weekend peminjaman hanya bisa dilakukan setelah jam <strong>18:00</strong></small>
    </div>

</form>