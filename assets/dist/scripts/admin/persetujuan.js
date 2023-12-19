let tableRiwayat

$(document).ready(function () {
  tablePersetujuan = $('#table-persetujuan').DataTable({
    ajax: {
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: function (d) {
        return JSON.stringify({
          request_key: 'PeminjamanRequest',
          payload: {
            method: 'GET',
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
        data: 'tanggalKegiatanMulai',
        type: 'date'
      },
      {
        data: 'tanggalKegiatanSelesai',
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
  $.ajax({
    url: '../request.php',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      request_key: 'PeminjamanRequest',
      payload: {
        method: 'DETAIL',
        peminjamanId
      }
    }),
    success: function (response) {
      const { tanggalKegiatanMulai, tanggalKegiatanSelesai, jamMulai, jamSelesai } = JSON.parse(response)

      Swal.fire({
        title: 'Anda yakin ingin menyetujui peminjaman?',
        text: 'Tindakan ini akan memperbarui status peminjaman!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, Setujui!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '../request.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
              request_key: 'PeminjamanRequest',
              payload: {
                method: 'UPDATE',
                data: {
                  peminjamanId,
                  tanggalKegiatanMulai,
                  tanggalKegiatanSelesai,
                  jamMulai,
                  jamSelesai,
                  status: 'Disetujui'
                }
              }
            }),
            success: function (response) {
              Swal.fire({
                title: 'Berhasil!',
                text: `Peminjaman telah disetujui`,
                icon: 'success'
              })

              tablePersetujuan.ajax.reload()
            }
          })
        }
      })
    }
  })
}

function onClickRejectPeminjaman(peminjamanId) {
  $.ajax({
    url: '../request.php',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      request_key: 'PeminjamanRequest',
      payload: {
        method: 'DETAIL',
        peminjamanId
      }
    }),
    success: function (response) {
      const { tanggalKegiatanMulai, tanggalKegiatanSelesai, jamMulai, jamSelesai } = JSON.parse(response)

      Swal.fire({
        title: 'Anda yakin ingin menolak peminjaman?',
        text: 'Status peminjaman akan ditolak!',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, tolak!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '../request.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
              request_key: 'PeminjamanRequest',
              payload: {
                method: 'UPDATE',
                data: {
                  peminjamanId,
                  tanggalKegiatanMulai,
                  tanggalKegiatanSelesai,
                  jamMulai,
                  jamSelesai,
                  status: 'Ditolak'
                }
              }
            }),
            success: function (response) {
              Swal.fire({
                title: 'Berhasil!',
                text: `Peminjaman telah ditolak`,
                icon: 'success'
              })

              tablePersetujuan.ajax.reload()
            }
          })
        }
      })
    }
  })
}
