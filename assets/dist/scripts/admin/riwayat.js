let tableRiwayat

$(document).ready(function () {
  tableRiwayat = $('#table-riwayat').DataTable({
    ajax: {
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: function (d) {
        return JSON.stringify({
          request_key: 'PeminjamanRequest',
          payload: {
            method: 'GET',
            type: 'riwayat'
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
                                <button type="button" class="btn btn-danger" onclick="onClickDeletePeminjaman(${row.peminjamanId})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>`
        }
      }
    ]
  })
})

function onClickDeletePeminjaman(peminjamanId) {
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Data peminjaman akan terhapus!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Iya, Hapus!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'PeminjamanRequest',
          payload: {
            method: 'DELETE',
            peminjamanId: peminjamanId
          }
        }),
        success: function (response) {
          tableRiwayat.ajax.reload()
        }
      })

      Swal.fire({
        title: 'Berhasil!',
        text: 'Peminjaman berhasil dihapus.',
        icon: 'success'
      })
    }
  })
}
