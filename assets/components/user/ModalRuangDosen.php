<div class="modal fade" id="modalRuangDosen" tabindex="-1" aria-labelledby="modalRuangDosenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalKodeRuang">RT01</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="image-ruang overflow-hidden mb-3" style="max-height: 400px;">
                    <img id="modalRuangDosenImage" class="rounded mb-3" style="min-width: 100%;">
                </div>
                <div class="information text-start">
                    <h2 class="name mb-3" id="modalNamaRuang">Ruang Teori 01</h2>
                    <h5 class="mb-3">Kapasitas: <span class="fw-bolder" id="modalKapasitas">50</span></h5>
                    <table class="w-25 mb-3">
                        <thead>
                            <tr>
                                <th>Fasilitas</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-fasilitas">
                        </tbody>
                    </table>

                    <h5>Daftar Dosen</h5>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Dosen</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-dosen">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>