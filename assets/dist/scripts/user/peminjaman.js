$(document).ready(function () {
  $('.select-ruang').select2()

  // Input Tanggal
  const currentDate = new Date().toISOString().split('T')[0]
  $('#tanggal_kegiatan_mulai').val(currentDate)
  $('#tanggal_kegiatan_selesai').val(currentDate)

  // Request Ruang Kelas
  $.ajax({
    type: 'POST',
    url: '../request.php',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'RuangRequest',
      payload: {
        method: 'GET',
        type: 'rk'
      }
    }),
    success: function (response) {
      printRuang(JSON.parse(response))
    }
  })

  const url = window.location.search
  const params = new URLSearchParams(url)
  const selectedKodeRuang = params.has('kode') ? params.get('kode').split(',') : []

  if (selectedKodeRuang) {
    const startDate = $('#tanggal_kegiatan_mulai').val()
    const endDate = $('#tanggal_kegiatan_selesai').val()
    const jamMulai = $('#jam_mulai').val()
    const jamSelesai = $('#jam_selesai').val()

    $('.select-ruang')
      .find('option')
      .each(function () {
        const optionValue = $(this).val()

        if (selectedValues.includes(optionValue)) {
          $(this).prop('selected', true)
        } else {
          $(this).prop('selected', false)
        }
      })

    $('.select-ruang').select2().trigger('change')
    verifyAvailabilityRuang(selectedKodeRuang, { startDate, endDate, jamMulai, jamSelesai })
  }

  // On Change Ruang Selection
  $('#form-peminjaman').on('change', function (e) {
    const startDate = $('#tanggal_kegiatan_mulai').val()
    const endDate = $('#tanggal_kegiatan_selesai').val()
    const jamMulai = $('#jam_mulai').val()
    const jamSelesai = $('#jam_selesai').val()
    let selectedRuang = $('.select-ruang').val()

    if (selectedKodeRuang) {
      selectedRuang = selectedRuang.concat(selectedKodeRuang)
    }

    verifyAvailabilityRuang(selectedRuang, { startDate, endDate, jamMulai, jamSelesai })
  })

  // Verify Availability of Ruang
  function verifyAvailabilityRuang(ruang, { startDate, endDate, jamMulai, jamSelesai }) {
    $.ajax({
      type: 'POST',
      url: '../request.php',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'PeminjamanRequest',
        payload: {
          method: 'VERIFY',
          data: {
            tanggalKegiatanMulai: startDate,
            tanggalKegiatanSelesai: endDate,
            jamMulai,
            jamSelesai,
            ruang: ruang
          }
        }
      }),
      success: function (response) {
        const { data } = JSON.parse(response)
        $('#selected-ruang').html('')

        const selectedRuang = ruang.reduce((acc, currentValue) => {
          acc[currentValue] = false
          return acc
        }, {})

        if (data !== null) {
          for (const ruang in data) {
            if (Object.keys(selectedRuang).includes(ruang)) {
              selectedRuang[ruang] = data[ruang]
            }
          }
        }

        let status = ruang.length > 0
        for (const ruang in selectedRuang) {
          if (!selectedRuang[ruang]) {
            status = false
          }
          printSelectedRuang(ruang, selectedRuang[ruang])
        }

        $('#btn-peminjaman').attr('disabled', !status)
      }
    })
  }

  // Print Ruang
  function printRuang(ruang) {
    $('.select-ruang').empty()

    $.each(ruang, function (index, item) {
      const option = new Option(item.namaRuang, item.kodeRuang)
      $('.select-ruang').append(option)
    })

    $('.select-ruang').select2()
  }

  // Print Selected Ruang
  function printSelectedRuang(kodeRuang, isAvailable) {
    $.ajax({
      type: 'POST',
      url: '../request.php',
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
        const { fotoRuang, namaRuang, kapasitas } = JSON.parse(response)

        const content = `
              <div class="row align-items-center">
                  <div class="col-md-4">
                  <img src="${fotoRuang}" class="img-fluid rounded-start" width="150" height="150">
                  </div>
                  <div class="col-md-8 ps-1">
                      <div class="card-body p-0">
                          <h6 class="card-title pt-2">${namaRuang}</h6>
                          <p class="card-text">Kapasitas: <span class="text-bold">${kapasitas}</span></p>
                          <p class="card-text">
                            ${
                              isAvailable
                                ? '<span class="badge text-bg-success">Available</span>'
                                : '<span class="badge text-bg-danger">Unavailable</span>'
                            }
                          </p>
                      </div>
                  </div>
              </div>`

        $('#selected-ruang').append(content)
      }
    })
  }

  // On Submit Form
  $('#form-peminjaman')
    .off('submit')
    .on('submit', function (e) {
      e.preventDefault()

      const form = new FormData()
      const userId = $('#user_id').val()

      if (userId === '') {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 1500,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer
            toast.onmouseleave = Swal.resumeTimer
          }
        })

        Toast.fire({
          icon: 'error',
          title: 'Anda perlu login.'
        })

        setTimeout(() => {
          window.location = '/login'
        }, 1500)
      } else {
        const instansi = $('#input_instansi').val()
        const keterangan = $('#input_keterangan').val()
        const tanggalPeminjaman = new Date().toLocaleDateString()
        const tanggalMulai = $('#tanggal_kegiatan_mulai').val()
        const tanggalSelesai = $('#tanggal_kegiatan_selesai').val()
        const jamMulai = $('#jam_mulai').val()
        const jamSelesai = $('#jam_selesai').val()
        let selectedRuang = $('.select-ruang').val()
        const fileInput = $('#foto_instansi')[0]
        const fotoInstansi = fileInput.files[0]

        if (selectedKodeRuang) {
          selectedRuang = selectedRuang.concat(selectedKodeRuang)
        }

        form.append('request_key', 'AddPeminjamanRequest')
        form.append('payload[user_id]', userId)
        form.append('payload[instansi]', instansi)
        form.append('payload[keterangan]', keterangan)
        form.append('payload[tanggal_peminjaman]', tanggalPeminjaman)
        form.append('payload[tanggal_kegiatan_mulai]', tanggalMulai)
        form.append('payload[tanggal_kegiatan_selesai]', tanggalSelesai)
        form.append('payload[jam_mulai]', jamMulai)
        form.append('payload[jam_selesai]', jamSelesai)
        form.append('payload[logo]', fotoInstansi)
        selectedRuang.forEach((value, index) => {
          form.append(`payload[ruang][${index}]`, value)
        })

        $.ajax({
          url: '../request.php',
          type: 'POST',
          contentType: false,
          processData: false,
          data: form,
          success: function (response) {
            $('#input_instansi').val('')
            $('#input_keterangan').val('')
            $('#tanggal_kegiatan_mulai').val('')
            $('#tanggal_kegiatan_selesai').val('')
            $('#jam_mulai').val('')
            $('#jam_selesai').val('')
            $('#foto_instansi').val('')
            $('#selected-ruang').html('')

            Swal.fire({
              title: 'Berhasil!',
              text: `Berhasil meminjam ruangan.`,
              icon: 'success'
            })
          }
        })
      }
    })
})
