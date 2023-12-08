<div class="modal fade" id="modalRuangKelas" tabindex="-1" aria-labelledby="modalRuangKelasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-kode-ruang"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="image-ruang overflow-hidden mb-3" style="max-height: 400px;">
                    <img src="#" class="rounded mb-3" id="modal-img-ruang">
                </div>
                <div class="information text-start">
                    <h2 class="name mb-3" id="modal-nama-ruang"></h2>
                    <h5 class="mb-4">Kapasitas: <span class="fw-bolder" id="modal-kapasitas-ruang"></span></h5>
                    <table class="w-25 mb-5">
                        <thead>
                            <tr>
                                <th>Fasilitas</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-fasilitas">
                        </tbody>
                    </table>
                    <table class="table table-stripped">
                        <h5>Jadwal Ruangan</h5>
                        <thead class="thead-jadwal">
                            <tr style="font-size: .85rem;">
                                <th></th>
                                <th>7:00-7:50</th>
                                <th>7:50-8:40</th>
                                <th>8:40-9:30</th>
                                <th>9:40-10:30</th>
                                <th>10:30-11:20</th>
                                <th>11:20-12:10</th>
                                <th>12:50-13:40</th>
                                <th>13:40-14:30</th>
                                <th>14:30-15:20</th>
                                <th>15:30-16:20</th>
                                <th>16:20-17:10</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-jadwal" class="text-center">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-primary">Pinjam</a>
            </div>
        </div>
    </div>
</div>