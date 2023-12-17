function getAllRuang() {
  $.ajax({
    url: 'request.php',
    type: 'POST',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'GetAllRuangRequest',
      payload: []
    }),
    success: function (response) {
      printRuang(JSON.parse(response))
    }
  })
}

function search(searchInput) {
  $.ajax({
    url: 'request.php',
    type: 'POST',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'SearchRuangRequest',
      payload: {
        search_input: searchInput.toLowerCase()
      }
    }),
    success: function (response) {
      printRuang(JSON.parse(response))
    }
  })
}

function filterRuang(filter) {
  $.ajax({
    url: 'request.php',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
      request_key: 'FilterRuangRequest',
      payload: {
        filter_input: filter
      }
    }),
    success: function (response) {
      printRuang(JSON.parse(response))
    }
  })
}

function printRuang(ruang) {
  $('#list_ruang').html('')

  $.each(ruang, function (index, item) {
    const card = $("<div class='card col-12 col-md-6 col-lg-3 rounded'></div>")
    const image = $(`<img class='card-img' src='${item.fotoRuang}' />`)
    const button = $(`
              <button 
                  type='button' 
                  class="${item.isRuangDosen ? 'ruang-dosen-button' : 'ruang-kelas-button'} card-img-overlay col-12 col-md-6 col-lg-3" 
                  kode-ruang='${item.kodeRuang}' 
                  data-bs-toggle='modal' 
                  data-bs-target="${item.isRuangDosen ? '#modalRuangDosen' : '#modalRuangKelas'}">
  
                  <h4 class="card-title">${item.namaRuang}</h4>
              </button>
          `)

    card.append(image, button)

    $('#list_ruang').append(card)
  })

  onClickRuangDosen()
  onClickRuangKelas()
}

function onClickRuangKelas() {
  $('.ruang-kelas-button').click(function (e) {
    const kodeRuang = this.getAttribute('kode-ruang')

    $.ajax({
      url: 'request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'GetDetailRuangKelasRequest',
        payload: {
          kode_ruang: kodeRuang
        }
      }),
      success: function (response) {
        const { kodeRuang, namaRuang, fotoRuang, kapasitas, fasilitas, jadwal } = JSON.parse(response)

        $('#modal-kode-ruang').text(kodeRuang)
        $('#modal-img-ruang').attr('src', fotoRuang)
        $('#modal-nama-ruang').text(namaRuang)
        $('#modal-kapasitas-ruang').text(kapasitas)

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

        const namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
        const badgeColor = ['success', 'danger', 'secondary', 'warning', 'info', 'primary', 'dark']
        $('#tbody-jadwal').html('')

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

          $('#tbody-jadwal').append(jadwalRow)
        }
      }
    })
  })
}

function onClickRuangDosen() {
  $('.ruang-dosen-button').click(function (e) {
    $('#tbody-fasilitas').html('')
    $('#tbody-dosen').html('')
    const kodeRuang = this.getAttribute('kode-ruang')

    $.ajax({
      url: 'request.php',
      type: 'POST',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'GetDetailRuangDosenRequest',
        payload: {
          kode_ruang: kodeRuang
        }
      }),
      success: function (response) {
        const { kodeRuang, namaRuang, kapasitas, fotoRuang, fasilitas, dosen } = JSON.parse(response)

        $('#modal-kode-ruang-dosen').text(kodeRuang)
        $('#modal-img-ruang-dosen').attr('src', fotoRuang)
        $('#modal-nama-ruang-dosen').text(namaRuang)
        $('#modal-kapasitas-ruang-dosen').text(kapasitas)

        $('#tbody-fasilitas-ruang-dosen').html('')
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
                                <td>${item.nama_fasilitas}</td>
                                <td class='badge text-bg-${status}'>${item.status}</td>
                            </tr>
                        `

            $('#tbody-fasilitas').append(fasilitasRow)
          })
        } else {
          $('#tbody-fasilitas-ruang-dosen').append(`
                            <tr>
                                <td>none</td>
                                <td>
                                    <span class="badge text-bg-secondary">none</span>
                                </td>
                            </tr>
                        `)
        }

        $.each(dosen, function (index, item) {
          const newRow = `
                            <tr>
                                <td>
                                    <img src='${item.fotoProfil}' width="50" height="50" style='border-radius: 50%'>
                                </td>
                                <td>${item.namaLengkap}</td>
                                <td>${item.nip}</td>
                                <td>${item.email}</td>
                                <td>${item.noTelp}</td>
                            </tr>
                        `

          $('#tbody-dosen').append(newRow)
        })
      }
    })
  })
}
