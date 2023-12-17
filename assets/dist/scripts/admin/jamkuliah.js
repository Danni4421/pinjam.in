let tableJamKuliah

$(document).ready(function () {
  $('#add_jk_id').on('change', function () {
    if (parseInt(this.value) < 0) {
      $('#add_jk_id').val(0)
    }
  })

  tableJamKuliah = $('#table-jam-kuliah').DataTable({
    ajax: {
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: function (d) {
        return JSON.stringify({
          request_key: 'JamKuliahRequest',
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
        data: 'jkId'
      },
      {
        data: 'jamMulai'
      },
      {
        data: 'jamSelesai'
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return `
                <button type="button" class="btn btn-warning" onclick="onClickEditJamKuliah(${row.jkId})">
                  <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-danger" onclick="onClickDeleteJamKuliah(${row.jkId})">
                    <i class="fa-solid fa-trash"></i>
                </button>`
        }
      }
    ]
  })

  $('#formJamKuliah')
    .off('submit')
    .on('submit', function (e) {
      e.preventDefault()

      const jk_id = $('#add_jk_id').val()
      const jamMulai = $('#add_jam_mulai').val()
      const jamSelesai = $('#add_jam_selesai').val()

      $.ajax({
        url: '../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'JamKuliahRequest',
          payload: {
            method: 'ADD',
            data: {
              jkId: jk_id,
              jam_mulai: jamMulai,
              jam_selesai: jamSelesai
            }
          }
        }),
        success: function (response) {
          const result = JSON.parse(response)

          if (result.hasOwnProperty('error')) {
            Swal.fire({
              title: 'Gagal',
              text: result.message,
              icon: 'error'
            })
          } else {
            Swal.fire({
              title: 'success',
              text: 'Berhasil menambahkan jam kuliah',
              icon: 'success'
            })
            tableJamKuliah.ajax.reload()
          }
        }
      })
    })
})

function onClickEditJamKuliah(jkId) {
  $.ajax({
    url: '../request.php',
    type: 'POST',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'JamKuliahRequest',
      payload: {
        method: 'DETAIL',
        jkId
      }
    }),
    success: function (response) {
      const { jkId, jamMulai, jamSelesai } = JSON.parse(response)

      Swal.fire({
        title: 'Ubah Data Mata Kuliah',
        html: `
                <div class="mt-3 d-flex justify-content-center align-items-center overflow-hidden">
                  <div class="form-group">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" id="editJamMulai" class="swal2-input" value="${jamMulai !== null ? jamMulai : ''}">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" id="editJamSelesai" class="swal2-input" value="${jamSelesai !== null ? jamSelesai : ''}">
                  </div>
                </div>
            `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Ubah',
        confirmButtonColor: '#65B741',
        preConfirm: () => {
          return {
            jkId,
            jamMulai: $('#editJamMulai').val(),
            jamSelesai: $('#editJamSelesai').val()
          }
        }
      }).then((response) => {
        if (response.isConfirmed) {
          const { jkId, jamMulai, jamSelesai } = response.value

          $.ajax({
            url: '../request.php',
            type: 'POST',
            contentType: 'application/json',
            processData: false,
            data: JSON.stringify({
              request_key: 'JamKuliahRequest',
              payload: {
                method: 'UPDATE',
                jkId,
                data: {
                  jam_mulai: jamMulai,
                  jam_selesai: jamSelesai
                }
              }
            }),
            success: function () {
              tableJamKuliah.ajax.reload()

              Swal.fire({
                title: 'Berhasil',
                text: 'Memperbarui data jam kuliah.',
                icon: 'success'
              })
            }
          })
        }
      })
    }
  })
}

function onClickDeleteJamKuliah(jkId) {
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
          request_key: 'JamKuliahRequest',
          payload: {
            method: 'DELETE',
            jkId
          }
        }),
        success: function (response) {
          tableJamKuliah.ajax.reload()
        }
      })

      Swal.fire({
        title: 'Berhasil!',
        text: 'Jam Kuliah berhasil dihapus.',
        icon: 'success'
      })
    }
  })
}
