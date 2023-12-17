let tableUser

$(document).ready(function () {
  tableUser = $('#table-user').DataTable({
    ajax: {
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: function (d) {
        return JSON.stringify({
          request_key: 'UserRequest',
          payload: {
            method: 'GET',
            type: 'all'
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
        data: 'fotoProfil',
        render: function (data, type, row, meta) {
          return `<img src="../${row.fotoProfil}" width="50"/>`
        }
      },
      {
        data: 'nomorInduk'
      },
      {
        data: 'email'
      },
      {
        data: 'namaLengkap'
      },
      {
        data: 'alamat'
      },
      {
        data: 'noTelp'
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return `
                <button type="button" class="btn btn-warning" onclick="onClickEditUser(${row.userId})">
                    <i class="fa-solid fa-pencil"></i>
                </button>
                <button type="button" class="btn btn-danger" onclick="onClickDeleteUser(${row.userId})">
                    <i class="fa-solid fa-trash"></i>
                </button>`
        }
      }
    ]
  })
})

function onClickEditUser(userId) {
  $.ajax({
    url: '../request.php',
    type: 'POST',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'UserRequest',
      payload: {
        method: 'GET',
        userId: userId
      }
    }),
    success: function (response) {
      const { id, nomorInduk, email, namaLengkap, alamat, noTelp, fotoProfil, kodeRuang } = JSON.parse(response)

      Swal.fire({
        title: 'Ubah Data User',
        html: `
              <div>
                <div class="form-group text-start">
                  <label class="form-label ms-5">NIM</label>
                  <input id="nomorInduk" class="swal2-input" value="${nomorInduk !== null ? nomorInduk : ''}">
                </div>
                <div class="form-group text-start">
                  <label class="form-label ms-5">Nama Lengkap</label>
                  <input id="namaLengkap" class="swal2-input" value="${namaLengkap !== null ? namaLengkap : ''}">
                </div>
                <div class="form-group text-start">
                  <label class="form-label ms-5">Alamat</label>
                  <input id="alamat" class="swal2-input" value="${alamat !== null ? alamat : ''}">
                </div>
                <div class="form-group text-start">
                  <label class="form-label ms-5">Nomor Telepon</label>
                  <input id="noTelp" class="swal2-input" value="${noTelp !== null ? noTelp : ''}">
                </div>
              </div>
            `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Ubah',
        confirmButtonColor: '#65B741',
        preConfirm: () => {
          return {
            id: id,
            nomorInduk: $('#nomorInduk').val(),
            namaLengkap: $('#namaLengkap').val(),
            alamat: $('#alamat').val(),
            noTelp: $('#noTelp').val(),
            fotoProfil: fotoProfil,
            kodeRuang: kodeRuang
          }
        }
      }).then((response) => {
        if (response.isConfirmed) {
          const { id, nomorInduk, namaLengkap, alamat, noTelp, fotoProfil, kodeRuang } = response.value

          $.ajax({
            url: '../request.php',
            type: 'POST',
            contentType: 'application/json',
            processData: false,
            data: JSON.stringify({
              request_key: 'UserUpdateFormRequest',
              payload: {
                userId: id,
                nomor_induk: nomorInduk,
                email: email,
                nama_lengkap: namaLengkap,
                alamat: alamat,
                no_telp: noTelp,
                old_foto_profil: fotoProfil,
                kode_ruang: kodeRuang
              }
            }),
            success: function (response) {
              tableUser.ajax.reload()

              Swal.fire({
                title: 'Berhasil',
                text: 'Memperbarui data user.',
                icon: 'success'
              })
            }
          })
        }
      })
    }
  })
}

function onClickDeleteUser(userId) {
  console.log(userId)
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Informasi user akan terhapus permanen!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'UserRequest',
          payload: {
            method: 'DELETE',
            userId: userId
          }
        }),
        success: function (response) {
          tableUser.ajax.reload()

          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menghapus data user.',
            icon: 'success'
          })
        }
      })
    }
  })
}
