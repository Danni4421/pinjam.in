$(document).ready(function () {
  const stringCookie = document.cookie.includes('user_id=')
  const userId = stringCookie
    ? document.cookie
        .split('; ')
        .find((row) => row.startsWith('user_id='))
        .split('=')[1]
    : null

  $.ajax({
    url: '../request.php',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      request_key: 'UserRequest',
      payload: {
        method: 'GET',
        userId
      }
    }),
    success: function (response) {
      const { id: userId, username, email, nomorInduk, namaLengkap, alamat, noTelp, fotoProfil } = JSON.parse(response)

      $('#profilePic').attr('src', `../${fotoProfil}`)
      $('#old_foto_profil').val(fotoProfil)
      $('#username').val(username)
      $('#email').val(email)
      $('#nomor_induk').val(nomorInduk)
      $('#nama_lengkap').val(namaLengkap)
      $('#alamat').val(alamat)
      $('#no_telp').val(noTelp)

      onSubmitUpdateUser(userId)
    }
  })

  $.ajax({
    url: '../request.php',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      request_key: 'PeminjamanRequest',
      payload: {
        method: 'GET',
        type: 'riwayat',
        userId
      }
    }),
    success: function (response) {
      JSON.parse(response).forEach((peminjaman) => {
        switch (peminjaman.status) {
          case 'Disetujui':
            const prevIsDone = parseInt($('#reserved-room').text(), 10)
            $('#reserved-room').text(prevIsDone + 1)
            break
          case 'Diproses':
            const prevOnProcess = parseInt($('#on-process-room').text(), 10)
            $('#on-process-room').text(prevOnProcess + 1)
            break
          case 'Selesai':
            const prevIsDoneRoom = parseInt($('#is-done-room').text(), 10)
            $('#is-done-room').text(prevIsDoneRoom + 1)
            break
        }
      })
    }
  })

  $('#table-riwayat-user').DataTable({
    ajax: {
      url: '../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: function (d) {
        return JSON.stringify({
          request_key: 'PeminjamanRequest',
          payload: {
            method: 'GET',
            type: 'riwayat',
            userId
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
          console.log(row)
          return meta.row + 1
        }
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
              <a href="/account/riwayat/surat?id=${row.peminjamanId}" class="btn btn-success 
              ${row.status !== 'Disetujui' ? 'disabled' : ''}
              ">
                <i class="fas fa-download"></i>
              </a>`
        }
      }
    ]
  })
})

function onSubmitUpdateUser(userId) {
  $('#profile-form')
    .off('submit')
    .on('submit', function (e) {
      e.preventDefault()

      const form = new FormData()
      const nomorInduk = $('#nomor_induk').val()
      const namaLengkap = $('#nama_lengkap').val()
      const alamat = $('#alamat').val()
      const noTelp = $('#no_telp').val()
      const oldFotoProfil = $('#old_foto_profil').val()
      const fotoProfil = $('#foto_profil')[0]
      const fileFotoProfil = fotoProfil.files[0]

      form.append('request_key', 'UserUpdateFormRequest')
      form.append('payload[user_id]', userId)
      form.append('payload[nomor_induk]', nomorInduk)
      form.append('payload[nama_lengkap]', namaLengkap)
      form.append('payload[alamat]', alamat)
      form.append('payload[no_telp]', noTelp)
      form.append('payload[old_foto_profil]', oldFotoProfil)
      form.append('payload[file]', fileFotoProfil)

      $.ajax({
        url: '../../request.php',
        type: 'POST',
        data: form,
        contentType: false,
        processData: false,
        success: function (response) {
          Swal.fire({
            title: 'Berhasil!',
            text: `Data berhasil diperbarui`,
            icon: 'success'
          })
        }
      })
    })
}

document.addEventListener('change', function (event) {
  if (event.target.classList.contains('uploadProfileInput')) {
    const triggerInput = event.target
    const currentImg = triggerInput.closest('.pic-holder').querySelector('.pic').src
    const holder = triggerInput.closest('.pic-holder')
    const wrapper = triggerInput.closest('.profile-pic-wrapper')

    const alerts = wrapper.querySelectorAll('[role="alert"]')
    alerts.forEach(function (alert) {
      alert.remove()
    })

    triggerInput.blur()
    const files = triggerInput.files || []
    if (!files.length || !window.FileReader) {
      return
    }

    if (/^image/.test(files[0].type)) {
      const reader = new FileReader()
      reader.readAsDataURL(files[0])

      reader.onloadend = function () {
        holder.classList.add('uploadInProgress')
        holder.querySelector('.pic').src = this.result
      }
    } else {
      wrapper.innerHTML += '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose a valid image.</div>'
      setTimeout(function () {
        const invalidAlert = wrapper.querySelector('[role="alert"]')
        if (invalidAlert) {
          invalidAlert.remove()
        }
      }, 3000)
    }
  }
})
