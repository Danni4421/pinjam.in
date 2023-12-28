<div class="section-title">
  <h2>Ruang Kelas Teori</h2>
  <p>Kapasitas <?= $query["amount"] ?> Orang</p>
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/ruang/kelas">Ruang Kelas</a></li>
      <li class=" breadcrumb-item active" aria-current="page">Kapasitas <?= $query["amount"] ?></li>
    </ol>
  </nav>
</div>
<div class="floors border border-1">
  <div class="floor-content">
    <div class="card">
      <div class="card-body">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6" id="list-filtered-ruang" filter-amount="<?= isset($query["amount"]) ? $query["amount"] : "" ?>">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modals -->
<div class="modal top fade" id="detail-kelas" tabindex="-1" aria-labelledby="detailKelas" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
  <div class="modal-dialog modal-xl ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Ruang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center gap-2">
          <div class="row col-12 col-lg-4 justify-content-center gap-2">
            <img id="modal-foto-ruang" class="col-12" width="300" height="300">
          </div>
          <div class="col-12 col-lg-7">
            <div class="section-title">
              <h2>Ruang Kelas Teori</h2>
              <p id="title-ruang">Lab Sistem Informasi 1</p>
              <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/ruang/kelas">Ruang Kelas</a></li>
                  <li class=" breadcrumb-item"><a href="/ruang/kelas?amount=30"><?= $query["amount"] ?></a></li>
                  <li class=" breadcrumb-item active" aria-current="page" id="kelas-active">LSI1</li>
                </ol>
              </nav>
              <main class="w-100">
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        <th scope="row">Kode Ruang</th>
                        <td><span id="modal-kode-ruang"></span></td>
                      </tr>
                      <tr>
                        <th scope="row">Nama Ruang</th>
                        <td><span id="modal-nama-ruang"></span>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Kapasitas</th>
                        <td><span id="modal-kapasitas"></span> orang
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Posisi Lantai</th>
                        <td><span id="modal-lantai"></span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="facilities d-flex gap-2" id="modal-facilities">
                </div>
              </main>
            </div>
          </div>
          <div class="jadwal col-12">
            <div class="text-center">
              <h4><strong>Jadwal Ruangan</strong></h4>
            </div>
            <div class="card-body overflow-auto">
              <table id="jadwalRuang" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr style="text-align: center;">
                    <th rowspan="2"></th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                  </tr>
                  <tr style="text-align: center; white-space: nowrap; font-size: small;">
                    <th>07:50 - 08:40</th>
                    <th>07:50 - 08:40</th>
                    <th>08:40 - 09:30</th>
                    <th>09:40 - 10:30</th>
                    <th>10:30 - 11:20</th>
                    <th>11:20 - 12:10</th>
                    <th>12:50 - 13:40</th>
                    <th>13:40 - 14:30</th>
                    <th>14:30 - 15:20</th>
                    <th>15:30 - 16:20</th>
                    <th>16:20 - 17:10</th>
                  </tr>
                </thead>
                <tbody id="table-jadwal">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <a href="#" class="btn-main" id="btn-pinjam">Pinjam</a>
      </div>
    </div>
  </div>
</div>
</div>
<!-- End Modals -->