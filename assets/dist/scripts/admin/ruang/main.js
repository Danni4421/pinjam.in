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

      const { kodeRuang, fotoRuang, dosen, fasilitas } = result

      setDetailRuang(result)
      $('#mainModalImage').attr('src', '../../' + fotoRuang)

      $('#btnImageModal')
        .off('click')
        .on('click', function () {
          $('#modalImageBody').html(`<img src='../../${fotoRuang}'/>`)
        })

      $('#btnAddDosen').on('click', function () {
        onSubmitAddDosen()
      })
      setFasilitas(fasilitas);
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
  $('#list-fasilitas').html('')
  const listFasilitas = $('<div></div>')
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

      listFasilitas.append(`
        <span class="fasilitas bg-${status}">
          <i class="${item.icon}"></i>
        </span>
      `)

      $('#list-fasilitas').append(listFasilitas)
  })
}
  
  $('#list-fasilitas').append(`
    <div>
      <button type="button" class="btn btn-add-fasilitas bg-primary" data-toggle="modal" data-target="#addFasilitasModal">
        <i class="fas fa-plus"></i>
        <span>Tambah</span>
      </button>
      <button type="button" class="btn btn-edit-fasilitas bg-warning" data-toggle="modal" data-target="#editFasilitasModal">
        <i class="fas fa-edit"></i>
      </button>
    </div>
  `)

  onClickAddFasilitas()
  onClickEditFasilitas()
}

function onClickAddFasilitas()
{
  $('.btn-add-fasilitas').off('click').on('click', function() {
    const kodeRuang = $('#mainModalKodeRuang').text()

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'FasilitasRequest',
        payload: {
          type: 'get',
        }
      }),
      success: function(response) {
        listFasilitas = JSON.parse(response)
        $('.select-fasilitas').html('')
        $('.select-fasilitas').select2()
        $.each(listFasilitas, function(index, item) {
          $('.select-fasilitas').append(`
            <option value="${item.fasilitasId}"><span class="text-dark">${item.namaFasilitas}</span></option>
          `)
        })
        
        onSubmitAddFasilitas(kodeRuang)
      }
    })
  })
}

function onSubmitAddFasilitas(kodeRuang) {
  $('#form-add-fasilitas').off('submit').on('submit', function(e) {
    e.preventDefault()

    const fasilitas = $('.select-fasilitas').val()

    $.ajax({
      type: 'POST',
      url: '../../request.php',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'FasilitasRequest',
        payload: {
          type: 'add',
          data: {
            fasilitas,
            kode_ruang: kodeRuang,
          }
        }
      }),
      success: function() {
        Swal.fire({
          title: 'Berhasil!',
          text: "Memperbarui jadwal",
          icon: 'success'
        })

        setTimeout(() => {
          location.reload()
        }, 2000)
      }
    })
  })
}

function onClickEditFasilitas()
{
  $('.btn-edit-fasilitas').off('click').on('click', function() {
    const kodeRuang = $('#mainModalKodeRuang').text()
    
    getFasilitasByRuang(kodeRuang)
  })
}

function getFasilitasByRuang(kodeRuang) {
  $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'FasilitasRequest',
        payload: {
          type: 'ruang',
          kode_ruang: kodeRuang
        }
      }),
      success: function(response) {
        const fasilitas = JSON.parse(response);
        $('#modal-fasilitas').html('')

        $.each(fasilitas, function (index, item) {
          $('#modal-fasilitas').append(`
            <li class="list-item-fasilitas">
              <div>
                <i class="${item.icon}"></i>
                <span>${item.namaFasilitas}</span>
              </div>
              <button class="btn-delete-fasilitas bg-danger" onclick="onDeleteFasilitas(${item.fasilitasId})">
                <i class="fas fa-minus-circle"></i>
              </button>
            </li>
          `)
        })
      }
    })
}

function onDeleteFasilitas(fasilitasId) {
  const kodeRuang = $('#mainModalKodeRuang').text()

  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Fasilitas akan terhapus pada ruang!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'FasilitasRequest',
          payload: {
            type: "delete",
            kode_ruang: kodeRuang,
            fasilitas_id: fasilitasId
          }
        }),
        success: function() {
          getFasilitasByRuang(kodeRuang)

          Swal.fire({
            title: 'Berhasil',
            text: 'Fasilitas berhasil dihapus.',
            icon: 'success'
          })

          setTimeout(() => {
            location.reload()
          }, 2000)
        }
      })
    }
  })
}

function setJadwalRuangKelas(jadwal) {
  $('#mainModalBodyJadwal').html('')

  const dayName = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']
  for (let dayIndex = 2; dayIndex <= 6; dayIndex++) {
    const row = $('<tr></tr>')
    row.append(`<td>${dayName[dayIndex - 2]}</td>`)

    for (let hour = 1; hour <= 11; hour++) {
      const cell = $('<td></td>')
      let isSpanned = false

      $.each(jadwal, function (index, {jadwalId, hari, jamMulai: start, jamSelesai: end, mataKuliah}) {
        if (hari === dayIndex) {
          if (hour === start) {
            cell.attr('colspan', end - start + 1)
            cell.addClass('in-jadwal')
            cell.append(`<button class="btn-jadwal" jadwal-id="${jadwalId}" data-toggle="modal" data-target="#modalEditJadwal">
              <span>${mataKuliah.namaMk}</span>
            </button>`)
            row.append(cell)
            isSpanned = true
          } else if (hour > start && hour <= end) {
            isSpanned = true
          }
        }
      })

      if (!isSpanned) {
        row.append(cell)
      }

    }
    
    addJadwal()
    editJadwal()
    $('#mainModalBodyJadwal').append(row)
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
      const nomorInduk = $('#addNomorInduk').val()
      const namaDosen = $('#addNamaDosen').val()
      const alamat = $('#addAlamat').val()
      const noTelp = $('#addNotelp').val()
      const fileInput = $('#addFotoProfil')[0]
      const file = fileInput.files[0]

      form.append('request_key', 'AddDosenRequest')
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
      form.append('payload[user_id]', userId)
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

function onSubmitEditJadwal(jadwalId) {
  $('#form-edit-jadwal').off('submit').on('submit', function(e) {
    e.preventDefault()

    const updatedHari = $('#edit-hari').val()
    const updatedJamMulai = $('#edit-jam-mulai').val()
    const updatedJamSelesai = $('#edit-jam-selesai').val()
    const updatedMataKuliah = $('#edit-matakuliah').val()

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'JadwalRequest',
        payload: {
          method: "UPDATE",
          data: {
            jadwal_id: jadwalId,
            hari: updatedHari,
            mata_kuliah: updatedMataKuliah,
            jam_mulai: updatedJamMulai,
            jam_selesai: updatedJamSelesai
          }
        }
      }),
      success: function() {
        Swal.fire({
          title: 'Berhasil!',
          text: "Memperbarui jadwal",
          icon: 'success'
        })

          setTimeout(() => {
            location.reload()
          }, 1500)
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

function addJadwal() {
  $('#mainBtnAddJadwal').off('click').on('click', function() {
    $('#add-jam-mulai').html('')
    $('#add-jam-selesai').html('')

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({
        request_key: 'JamKuliahRequest',
        payload: {
          method: 'GET',
        }
      }),
      success: function(response) {
        const jamKuliah = JSON.parse(response)

        $.each(jamKuliah, function(index, {jkId}) {
          $('#add-jam-mulai').append(`<option value="${jkId}">${jkId}</option>`)
          $('#add-jam-selesai').append(`<option value="${jkId}">${jkId}</option>`)
        })
      }
    })

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({
        request_key: 'MataKuliahRequest',
        payload: {
          method: 'GET',
        }
      }),
      success: function(response) {
        const matakuliah = JSON.parse(response)
        $('#add-matakuliah').html('')
        $.each(matakuliah, function(index, {mkId, namaMk}) {
          const optionMataKuliah = $(`<option value="${mkId}">${namaMk}</option>`)
          $('#add-matakuliah').append(optionMataKuliah)
        })
      }
    })
  })
}

function editJadwal() {
  $('.btn-jadwal').off('click').on('click', function() {
    const jadwalId = $(this).attr('jadwal-id')

    $.ajax({
      url: '../../request.php',
      type: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({
        request_key: 'JadwalRequest',
        payload: {
          method: 'GET',
          type: 'detail',
          jadwal_id: jadwalId
        }
      }),
      success: function (response) {
        const {jadwalId, hari, jamMulai, jamSelesai, mataKuliah: {mkId: selectedMkId}} = JSON.parse(response)

        $('#edit-hari option').each(function() {
          if ($(this).val() == hari) {
            $(this).attr('selected', true)
          }
        })

        $.ajax({
          url: '../../request.php',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            request_key: 'JamKuliahRequest',
            payload: {
              method: 'GET',
            }
          }),
          success: function(response) {
            const jamKuliah = JSON.parse(response)
            $('edit-jam-mulai').html('')
            $('edit-jam-selesai').html('')

            $.each(jamKuliah, function (index, { jkId }) {
              const optionMulai = $(`<option value="${jkId}">${jkId}</option>`) 
              const optionSelesai = $(`<option value="${jkId}">${jkId}</option>`) 

              if (jamMulai.jkId == jkId) {
                optionMulai.attr('selected', true)
              }

              if (jamSelesai.jkId == jkId) {
                optionSelesai.attr('selected', true)
              }

              $('#edit-jam-mulai').append(optionMulai)
              $('#edit-jam-selesai').append(optionSelesai)
            })
          }
        })

        $.ajax({
          url: '../../request.php',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            request_key: 'MataKuliahRequest',
            payload: {
              method: 'GET',
            }
          }),
          success: function(response) {
            const listMataKuliah = JSON.parse(response)

            $.each(listMataKuliah, function(index, {mkId, namaMk}) {
              const optionMataKuliah = $(`<option value="${mkId}">${namaMk}</option>`)
              
              if (mkId == selectedMkId) {
                optionMataKuliah.attr('selected', true)
              }
                
              $('#edit-matakuliah').append(optionMataKuliah)
            })
          }
        })

        onSubmitEditJadwal(jadwalId)
      }
    })
  })
}