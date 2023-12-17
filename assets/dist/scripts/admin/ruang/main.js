function getRuang(filter) {
  let container
  if (filter === 'rk') {
    container = 'ruang-kelas'
  } else {
    container = 'ruang-dosen'
  }

  $.ajax({
    url: '../../request.php',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      request_key: 'RuangRequest',
      payload: {
        method: 'GET',
        type: filter
      }
    }),
    success: function (response) {
      printRuang(JSON.parse(response), container)
    }
  })
}

function printRuang(ruang, container) {
  $(`#${container}`).html('')

  if (ruang.length <= 0) {
    $(`#${container}`).html('<h1>Tidak ada ruang</h1>')
  }

  $.each(ruang, function (index, item) {
    const card = $(`<div class="col-12 col-md-6 col-lg-3 mb-4"></div>`)
    const images = $(`<img src="../../${item.fotoRuang}" class="room-image"/>`)
    const cardBody = $(`
      <div class="card-body-overlay">
          <h5 class="card-title">${item.namaRuang}</h5>
          <p class="card-text">Lantai ${item.lantai}</p>
          <button type="button" class="btn btn-danger col-sm-4 modal-button" data-toggle="modal" kode-ruang='${item.kodeRuang}' data-target="#detail">
              Details
          </button>
      </div>
    `)

    card.append(images, cardBody)

    $(`#${container}`).append(card)

    $('.modal-button').click(function (e) {
      const kodeRuang = this.getAttribute('kode-ruang')

      if (container === 'ruang-kelas') {
        getDetailRuangKelas(kodeRuang)
      } else {
        getDetailRuangDosen(kodeRuang)
      }
    })
  })
}

function getDetailRuangDosen(kodeRuang) {
  $.ajax({
    url: '../../request.php',
    type: 'POST',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'RuangRequest',
      payload: {
        method: 'DETAIL',
        type: 'rd',
        kode_ruang: kodeRuang
      }
    }),
    success: function (response) {
      const result = JSON.parse(response)

      const { kodeRuang, fotoRuang, dosen } = result

      setDetailRuang(result)
      $('#mainModalImage').attr('src', '../../' + fotoRuang)

      $('#btnImageModal')
        .off('click')
        .on('click', function () {
          $('#modalImageBody').html(`<img src='../../${fotoRuang}'/>`)
        })

      // setFasilitas(fasilitas);
      $('#btnAddDosen').on('click', function () {
        onSubmitAddDosen()
      })
      loadDataDosen({ kodeRuang, dosen })
      editRuangDosen()
    }
  })
}

function getDetailRuangKelas(kodeRuang) {
  $.ajax({
    url: '../../request.php',
    type: 'POST',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'RuangRequest',
      payload: {
        method: 'DETAIL',
        type: 'rk',
        kode_ruang: kodeRuang
      }
    }),
    success: function (response) {
      const result = JSON.parse(response)

      const { fotoRuang, fasilitas, jadwal } = result

      setDetailRuang(result)
      $('#mainModalImage').attr('src', '../../' + fotoRuang)

      $('#btnImageModal').click(function () {
        $('#modalImageBody').html(`<img src='../../${fotoRuang}'/>`)
      })

      setFasilitas(fasilitas)
      setJadwalRuangKelas(jadwal)
      editRuangKelas()
    }
  })
}

function loadDataDosen({ ruangDosen, dosen }) {
  $('#list-dosen').html('')

  $.each(dosen, function (index, item) {
    $('#list-dosen').append(
      `<tr class="table-row-dosen">
        <td class="foto-profil-dosen"><img src="../../${item.fotoProfil}" width="50"/></td>
        <td class="nip-dosen">${item.nip === null ? '-' : item.nip}</td>
        <td class="nama-dosen">${item.namaLengkap === null ? '-' : item.namaLengkap}</td>
        <td class="alamat-dosen">${item.alamat === null ? '-' : item.alamat}</td>
        <td class="notelp-dosen">${item.noTelp === null ? '-' : item.noTelp}</td>
        <td class="cta-field">
          <button class="btn btn-warning on-edit-button" onclick="editDosen(${item.id})" data-toggle="modal" data-target="#editDosen">
            <i class="fa-solid fa-pen-to-square"></i>
            Edit
          </button>
          <button class="btn btn-danger btn-on-delete" onclick="onDeleteDosen(${item.id})">
            <i class="fa-solid fa-trash"></i>
            Hapus
          </button>
        </td>
      </tr>`
    )
  })
}

function setDetailRuang({ kodeRuang, namaRuang, kapasitas, lantai }) {
  $('#mainModalKodeRuang').text(kodeRuang)
  $('#mainModalNamaRuang').text(namaRuang)
  $('#mainModalKapasitas').text(kapasitas)
  $('#mainModalLantai').text(lantai)
}

function setFasilitas(fasilitas) {
  $('#tbody-fasilitas').html('')
  if (fasilitas.length > 0) {
    $.each(fasilitas, function (index, item) {
      let status = ''
      switch (item.status) {
        case 'Baik':
          status = 'success'
          break
        case 'Tidak Baik':
          status = 'danger'
          break
      }

      const fasilitasRow = `
          <tr>
              <td>${item.namaFasilitas}</td>
              <td class='badge text-bg-${status}'>${item.status}</td>
          </tr>
      `

      $('#tbody-fasilitas').append(fasilitasRow)
    })
  } else {
    $('#tbody-fasilitas').append(`
      <tr>
          <td>none</td>
          <td>
              <span class="badge text-bg-secondary">none</span>
          </td>
      </tr>
  `)
  }
}

function setJadwalRuangKelas(jadwal) {
  const namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
  const badgeColor = ['success', 'danger', 'secondary', 'warning', 'info', 'primary', 'dark']
  $('#mainModalBodyJadwal').html('')

  for (let i = 0; i < 7; i++) {
    const jadwalRow = $('<tr></tr>')
    jadwalRow.append(`<td>${namaHari[i]}</td>`)

    for (let j = 1; j <= 11; j++) {
      const jadwalData = $('<td>-</td>')

      $.each(jadwal, function (index, item) {
        if (item.hari === i + 1) {
          if (j >= item.jamMulai && j <= item.jamSelesai) {
            const matkulSplited = item.mataKuliah.namaMk.split(' ')
            const matkul = matkulSplited.map((matkul) => matkul[0]).join('')

            jadwalData.html(`
              <span class='badge text-bg-${badgeColor[i]}'>
                ${matkul}
              </span>
          `)
          }
        }
      })

      jadwalRow.append(jadwalData)
    }

    $('#mainModalBodyJadwal').append(jadwalRow)
  }
}

function editRuangKelas() {
  $('#btnEditModal').click(function () {
    const kodeRuang = $('#mainModalKodeRuang').text()

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'RuangRequest',
        payload: {
          method: 'DETAIL',
          type: 'rk',
          kode_ruang: kodeRuang
        }
      }),
      success: function (response) {
        const { kodeRuang, namaRuang, kapasitas, lantai } = JSON.parse(response)

        $('#modalEditKodeRuang').val(kodeRuang)
        $('#modalEditNamaRuang').val(namaRuang)
        $('#modalEditKapasitas').val(kapasitas)
        $('#modalEditLantai').val(lantai)

        onSubmitEditRuangKelas(kodeRuang)
      }
    })
  })
}

function editRuangDosen() {
  $('#btnEditModal').click(function () {
    const kodeRuang = $('#mainModalKodeRuang').text()

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'RuangRequest',
        payload: {
          method: 'DETAIL',
          type: 'rd',
          kode_ruang: kodeRuang
        }
      }),
      success: function (response) {
        const { kodeRuang, namaRuang, kapasitas, lantai } = JSON.parse(response)

        $('#modalEditKodeRuang').val(kodeRuang)
        $('#modalEditNamaRuang').val(namaRuang)
        $('#modalEditKapasitas').val(kapasitas)
        $('#modalEditLantai').val(lantai)

        onSubmitEditRuangDosen(kodeRuang)
      }
    })
  })
}

function editDosen(userId) {
  $.ajax({
    url: '../../request.php',
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
      const { id, nomorInduk, namaLengkap, alamat, noTelp, fotoProfil, kodeRuang } = JSON.parse(response)

      $('#editNipDosen').val(nomorInduk)
      $('#editNamaDosen').val(namaLengkap)
      $('#editAlamatDosen').val(alamat)
      $('#editTelpDosen').val(noTelp)

      const baseImagePath = `../../${fotoProfil}`
      $('#editImagePreview').attr('src', baseImagePath)
      $('#editImagePreview').val(fotoProfil)
      $('#editFotoProfilLama').val(fotoProfil)

      onSubmitEditDosen({ userId: id, kodeRuang })
    }
  })
}

function onSubmitEditRuangKelas(kodeRuang) {
  $('#formEditRuang').submit(function (e) {
    e.preventDefault()
    const updatedKodeRuang = $('#modalEditKodeRuang').val()
    const updatedNamaRuang = $('#modalEditNamaRuang').val()
    const updatedKapasitas = $('#modalEditKapasitas').val()
    const updatedLantai = $('#modalEditLantai').val()

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'RuangRequest',
        payload: {
          method: 'UPDATE',
          type: 'rk',
          kode_ruang: kodeRuang,
          data: {
            kode_ruang: updatedKodeRuang,
            nama_ruang: updatedNamaRuang,
            kapasitas: updatedKapasitas,
            lantai: updatedLantai
          }
        }
      }),
      success: function (response) {
        const result = JSON.parse(response)
        setDetailRuang(result)
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Berhasil memperbarui ruang kelas',
          showConfirmButton: false,
          timer: 1500
        })
      }
    })
  })
}

function onSubmitEditRuangDosen(kodeRuang) {
  $('#formEditRuang').submit(function (e) {
    e.preventDefault()
    const updatedKodeRuang = $('#modalEditKodeRuang').val()
    const updatedNamaRuang = $('#modalEditNamaRuang').val()
    const updatedKapasitas = $('#modalEditKapasitas').val()
    const updatedLantai = $('#modalEditLantai').val()

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'RuangRequest',
        payload: {
          method: 'UPDATE',
          type: 'rd',
          kode_ruang: kodeRuang,
          data: {
            kode_ruang: updatedKodeRuang,
            nama_ruang: updatedNamaRuang,
            kapasitas: updatedKapasitas,
            lantai: updatedLantai
          }
        }
      }),
      success: function (response) {
        const result = JSON.parse(response)
        setDetailRuang(result)
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Berhasil memperbarui ruang dosen',
          showConfirmButton: false,
          timer: 1500
        })
      }
    })
  })
}

function onSubmitAddDosen() {
  $('#formAddDosen')
    .off('submit')
    .on('submit', function (e) {
      e.preventDefault()

      const kodeRuang = $('#mainModalKodeRuang').text()

      const form = new FormData()
      const email = $('#addEmail').val()
      const nomorInduk = $('#addNomorInduk').val()
      const namaDosen = $('#addNamaDosen').val()
      const alamat = $('#addAlamat').val()
      const noTelp = $('#addNotelp').val()
      const fileInput = $('#addFotoProfil')[0]
      const file = fileInput.files[0]

      form.append('request_key', 'AddDosenRequest')
      form.append('payload[email]', email)
      form.append('payload[nomor_induk]', nomorInduk)
      form.append('payload[nama_lengkap]', namaDosen)
      form.append('payload[alamat]', alamat)
      form.append('payload[no_telp]', noTelp)
      form.append('payload[kode_ruang]', kodeRuang)
      form.append('payload[file]', file)

      $.ajax({
        url: '../../request.php',
        type: 'POST',
        data: form,
        contentType: false,
        processData: false,
        success: function (response) {
          const result = JSON.parse(response)

          if (result.hasOwnProperty('errorMessage')) {
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: result.errorMessage,
              showConfirmButton: false,
              timer: 1500
            })
          } else {
            const { dosen } = result
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Berhasil menambahkan dosen',
              showConfirmButton: false,
              timer: 1500
            })

            $('#addEmail').val('')
            $('#addNomorInduk').val('')
            $('#addNamaDosen').val('')
            $('#addAlamat').val('')
            $('#addNotelp').val('')
            $('#addFotoProfil').val('')

            loadDataDosen({ dosen: dosen })
          }

          $('#addDosen').removeClass('show')
          $('#addDosen').css({ display: 'none' })
        }
      })
    })
}

function onSubmitEditDosen({ userId, kodeRuang }) {
  $('#formEditDosen')
    .off('submit')
    .submit(function (e) {
      e.preventDefault()
      const form = new FormData()

      const nomorInduk = $('#editNipDosen').val()
      const namaDosen = $('#editNamaDosen').val()
      const alamatDosen = $('#editAlamatDosen').val()
      const noTelpDosen = $('#editTelpDosen').val()
      const fotoProfilLama = $('#editFotoProfilLama').val()
      const fileInput = $('#editFotoProfil')[0]
      const file = fileInput.files[0]

      form.append('request_key', 'UserUpdateFormRequest')
      form.append('payload[userId]', userId)
      form.append('payload[nomor_induk]', nomorInduk)
      form.append('payload[nama_lengkap]', namaDosen)
      form.append('payload[alamat]', alamatDosen)
      form.append('payload[no_telp]', noTelpDosen)
      form.append('payload[kode_ruang]', kodeRuang)
      form.append('payload[is_dosen]', true)
      form.append('payload[old_foto_profil]', fotoProfilLama)
      form.append('payload[file]', file)

      $.ajax({
        url: '../../request.php',
        type: 'POST',
        contentType: false,
        processData: false,
        data: form,
        success: function (response) {
          const { kodeRuang, dosen } = JSON.parse(response)

          $('#editNipDosen').val('')
          $('#editNamaDosen').val('')
          $('#editAlamatDosen').val('')
          $('#editTelpDosen').val('')
          $('#editFotoProfilLama').val('')
          $('#editFotoProfil').val('')

          loadDataDosen({ kodeRuang, dosen })

          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Berhasil memperbarui data dosen',
            showConfirmButton: false,
            timer: 1500
          })
        }
      })
    })
}

function onDeleteDosen(userId) {
  $('.table-row-dosen .btn-on-delete').click(function () {
    const kodeRuang = $('#mainModalKodeRuang').text()

    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: 'Tindakan ini akan menghapus data dosen!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '../../request.php',
          type: 'POST',
          contentType: 'application/json',
          processData: false,
          data: JSON.stringify({
            request_key: 'UserRequest',
            payload: {
              method: 'DELETE',
              userId: userId,
              kodeRuang: kodeRuang
            }
          }),
          success: function (response) {
            console.log(response)
            loadDataDosen({ ...JSON.parse(response) })

            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Berhasil menghapus dosen',
              showConfirmButton: false,
              timer: 1500
            })
          }
        })

        Swal.fire({
          title: 'Dosen Terhapus!',
          text: 'Data Dosen Berhasil Terhapus.',
          icon: 'success'
        })
      }
    })
  })
}

function editJadwal() {}
