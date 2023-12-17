let tableRiwayat

$(document).ready(function () {
  tableFasilitas = $('#table-fasilitas').DataTable({
    ajax: {
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: function (d) {
        return JSON.stringify({
          request_key: 'FasilitasRequest',
          payload: {
            type: 'get'
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
        data: 'namaFasilitas'
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return `<i class="${row.icon}"></i>`
        }
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return `
              <button type="button" class="btn btn-warning" onclick="onEditFasilitas(${row.fasilitasId}, '${row.namaFasilitas}')">
                  <i class="fa-solid fa-edit"></i>
              </button>
              <button type="button" class="btn btn-danger" onclick="onDeleteFasilitas(${row.fasilitasId})">
                  <i class="fa-solid fa-trash"></i>
              </button>`
        }
      }
    ]
  })

  $('#addFasilitasForm').submit(function (e) {
    e.preventDefault()
    const namaFasilitas = $('#nama-fasilitas').val()

    $.ajax({
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'FasilitasRequest',
        payload: {
          type: 'add',
          data: {
            nama_fasilitas: namaFasilitas
          }
        }
      }),
      success: function (response) {
        tableFasilitas.ajax.reload()

        Swal.fire({
          title: 'Berhasil!',
          text: `Fasiltias ${namaFasilitas} berhasil ditambah.`,
          icon: 'success'
        })
      }
    })
  })
})

function onEditFasilitas(fasilitasId, namaFasilitas) {
  Swal.fire({
    title: 'Ubah Nama Fasilitas',
    input: 'text',
    inputValue: namaFasilitas,
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Ubah',
    confirmButtonColor: '#65B741'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'FasilitasRequest',
          payload: {
            type: 'update',
            fasilitas_id: fasilitasId,
            data: {
              nama_fasilitas: result.value
            }
          }
        }),
        success: function () {
          tableFasilitas.ajax.reload()

          Swal.fire({
            title: 'Berhasil!',
            text: 'Fasilitas berhasil diubah.',
            icon: 'success'
          })
        }
      })
    }
  })
}

function onDeleteFasilitas(fasilitasId) {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'FasilitasRequest',
          payload: {
            type: 'delete',
            fasilitas_id: fasilitasId
          }
        }),
        success: function (response) {
          tableFasilitas.ajax.reload()
        }
      })

      Swal.fire({
        title: 'Deleted!',
        text: 'Your file has been deleted.',
        icon: 'success'
      })
    }
  })
}
