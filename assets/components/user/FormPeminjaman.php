<h4 class="form-title fw-bolder mb-3">Form Pengajuan Peminjaman</h4>
<form action="POST" enctype="multipart/form-data">
    <div class="input-group mb-3">
        <span class="input-group-text" id="instansi">Instansi</span>
        <input type="text" class="form-control" aria-label="instansi" aria-describedby="instansi">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="keterangan">Keterangan</span>
        <textarea class="form-control" name="keterangan" aria-label="keterangan" aria-describedby="keterangan"></textarea>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="tanggal_kegiatan">Tanggal Kegiatan</span>
        <input type="date" class="form-control" aria-label="tanggal_kegiatan" aria-describedby="tanggal_kegiatan">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">Jam</span>
        <select name="jam_mulai" class="form-select" aria-placeholder="jam_mulai" id="jam_mulai">
            <option value="1">1</option>
            <option value="1">2</option>
            <option value="1">3</option>
            <option value="1">4</option>
            <option value="1">5</option>
            <option value="1">6</option>
        </select>
        <span class="input-group-text">Jam</span>
        <select name="jam_selesai" class="form-select" aria-placeholder="jam_selesai" id="jam_selesai">
            <option value="1">1</option>
            <option value="1">2</option>
            <option value="1">3</option>
            <option value="1">4</option>
            <option value="1">5</option>
            <option value="1">6</option>
        </select>
    </div>
    <div class="input-group mb-3 d-flex flex-column">
        <label for="multiple-select-field" class="input-group-text">Pilih Ruang</label>
        <select class="form-select" id="multiple-select-field" name="ruang[]" data-placeholder="Pilih ruangan yang ingin Anda pinjam!" multiple>
            <option>Lab Sistem Informasi 1</option>
            <option>Lab Sistem Informasi 2</option>
            <option>Lab Sistem Informasi 3</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <label for="logo_instansi" class="input-group-text">Logo Instansi</label>
        <input class="form-control" type="file" id="logo_instansi">
    </div>
    <div class="row justify-content-center gap-4 mb-3">
        <button type="submit" class="col-6 btn btn-success">Pinjam</button>
        <a href="index.php" class="col-5 btn btn-secondary">Batal</a>
    </div>
</form>