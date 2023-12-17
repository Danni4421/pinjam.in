let tableRiwayat

$(document).ready(function () {
  tablePersetujuan = $('#table-riwayat').DataTable({
    ajax: {
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: function (d) {
        return JSON.stringify({
          request_key: 'GetPeminjamanRequest',
          payload: {
            type: 'persetujuan'
          }
        })
      },
      dataType: 'json',
      dataSrc: ''
    },
    columns: [
      {
        data: null,
        render: function (data, type, row, meta) {
          return meta.row + 1
        }
      },
      {
        data: 'peminjam.namaLengkap'
      },
      {
        data: 'peminjam.instansi'
      },
      {
        data: 'ruang',
        render: function (data, type, row, meta) {
          var ruangan = data
            .map(function (ruang) {
              return ruang.kodeRuang
            })
            .join(', ')
          return ruangan
        }
      },
      {
        data: 'keterangan'
      },
      {
        data: 'tanggalPeminjaman',
        type: 'date'
      },
      {
        data: 'tanggalKegiatan',
        type: 'date'
      },
      {
        data: 'status',
        render: function (data, type, row, meta) {
          let badgeColor
          switch (row.status) {
            case 'Diproses':
              badgeColor = 'warning'
              break
            case 'Disetujui':
              badgeColor = 'success'
              break
            case 'Selesai':
              badgeColor = 'primary'
              break
            case 'Ditolak':
              badgeColor = 'danger'
              break
          }
          return `<span class='badge text-bg-${badgeColor}'>${row.status}</span>`
        }
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return `
                                <button type="button" class="btn btn-success" onclick="onClickApprovePeminjaman(${row.peminjamanId})">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-danger" onclick="onClickRejectPeminjaman(${row.peminjamanId})">
                                    <i class="fas fa-times"></i>
                                </button>
                                `
        }
      }
    ]
  })
})

function onClickApprovePeminjaman(peminjamanId) {
  $.ajax({})
}
