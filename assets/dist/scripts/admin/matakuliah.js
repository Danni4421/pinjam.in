let tableMataKuliah

$(document).ready(function () {
  tableMataKuliah = $('#table-matakuliah').DataTable({
    ajax: {
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: function (d) {
        return JSON.stringify({
          request_key: 'MataKuliahRequest',
          payload: {
            method: 'GET'
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
        data: 'mkId'
      },
      {
        data: 'namaMk'
      },
      {
        data: 'sks'
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return `
                <button type="button" class="btn btn-warning" onclick="onClickEditMataKuliah('${row.mkId}')">
                  <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-danger" onclick="onClickDeleteMataKuliah('${row.mkId}')">
                    <i class="fa-solid fa-trash"></i>
                </button>`
        }
      }
    ]
  })

  $('#formMataKuliah')
    .off('submit')
    .on('submit', function (e) {
      e.preventDefault()

      const mkId = $('#mk_id').val()
      const namaMk = $('#nama_mk').val()
      const sks = $('#sks_mk').val()

      $.ajax({
        url: '../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'MataKuliahRequest',
          payload: {
            method: 'ADD',
            data: {
              mk_id: mkId,
              nama_mk: namaMk,
              sks: sks
            }
          }
        }),
        success: function (response) {
          const result = JSON.parse(response)

          if (result.hasOwnProperty('error')) {
            Swal.fire({
              title: 'Gagal!',
              text: result.message,
              icon: 'error'
            })
          } else {
            tableMataKuliah.ajax.reload()
            Swal.fire({
              title: 'Berhasil!',
              text: 'Mata Kuliah berhasil ditambah.',
              icon: 'success'
            })
          }
        }
      })
    })
})

function onClickEditMataKuliah(mkId) {
  $.ajax({
    url: '../request.php',
    type: 'POST',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'MataKuliahRequest',
      payload: {
        method: 'DETAIL',
        mkId
      }
    }),
    success: function (response) {
      const { mkId, namaMk, sks } = JSON.parse(response)

      Swal.fire({
        title: 'Ubah Data Mata Kuliah',
        html: `
              <div>
                <div class="form-group text-start">
                  <label class="form-label ms-5">Kode Mata Kuliah</label>
                  <input id="mataKuliahId" class="swal2-input" value="${mkId !== null ? mkId : ''}">
                </div>
                <div class="form-group text-start">
                  <label class="form-label ms-5">Nama Mata Kuliah</label>
                  <input id="namaMk" class="swal2-input" value="${namaMk !== null ? namaMk : ''}">
                </div>
                <div class="form-group text-start">
                  <label class="form-label ms-5">SKS</label>
                  <input id="sks" class="swal2-input" value="${sks !== null ? sks : 0}">
                </div>
              </div>
            `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Ubah',
        confirmButtonColor: '#65B741',
        preConfirm: () => {
          return {
            mkId: $('#mataKuliahId').val(),
            namaMk: $('#namaMk').val(),
            sks: $('#sks').val()
          }
        }
      }).then((response) => {
        if (response.isConfirmed) {
          const { mkId, namaMk, sks } = response.value

          $.ajax({
            url: '../request.php',
            type: 'POST',
            contentType: 'application/json',
            processData: false,
            data: JSON.stringify({
              request_key: 'MataKuliahRequest',
              payload: {
                method: 'UPDATE',
                data: {
                  mkId,
                  namaMk,
                  sks
                }
              }
            }),
            success: function () {
              tableMataKuliah.ajax.reload()

              Swal.fire({
                title: 'Berhasil',
                text: 'Memperbarui data mata kuliah.',
                icon: 'success'
              })
            }
          })
        }
      })
    }
  })
}

function onClickDeleteMataKuliah(mkId) {
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Data Mata Kuliah akan terhapus!',
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
          request_key: 'MataKuliahRequest',
          payload: {
            method: 'DELETE',
            mkId
          }
        }),
        success: function (response) {
          tableMataKuliah.ajax.reload()
        }
      })

      Swal.fire({
        title: 'Berhasil!',
        text: 'Mata Kuliah berhasil dihapus.',
        icon: 'success'
      })
    }
  })
}
