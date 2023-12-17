$(document).ready(function () {
  const amount = $('#list-filtered-ruang').attr('filter-amount')
  
  if (amount !== "") {
    $.ajax({
      type: "POST",
      url: "../request.php",
      contentType: "application/json",
      processData: false,
      data: JSON.stringify({
        request_key: "RuangRequest",
        payload: {
          method: "GET",
          type: "rk",
          amount: amount
        }
      }),
      success: function (response) {
        printFilteredRuang(JSON.parse(response))
      }
    });
  }
  
  function onClickFilteredRuang() {
    $('.ruang').off('click').on('click', function (e) {
      const kodeRuang = $(this).attr('data-kode-ruang')
      
      $.ajax({
        type: "POST",
        url: "../request.php",
        contentType: "application/json",
        processData: false,
        data: JSON.stringify({
          request_key: "RuangRequest",
          payload: {
            method: "DETAIL",
            type: "rk",
            kode_ruang: kodeRuang
          }
        }),
        success: function (response) {
          printRuangToModal(JSON.parse(response))
        }
      })
    })
  }

  function printFilteredRuang(ruang) {
    $.each(ruang, function (index, item)  {
      let facilities = $(`<div class="facilities-container my-2 d-flex gap-2"></div>`)
      $.each(item.fasilitas, function(index, item) {
        facilities.append(`
          <span class="${item.status === "Baik" ? "main-badge" : "error-main-badge"} ">
            <i class="${item.icon}"></i>
          </span>
        `)
      })
    
      const outerContainer = $(`<div class="col-sm-2 mb-3 mb-sm-0"></div>`)
      const innerContainer = $(`<div class="card" id="ruang-teori">
                <img src="../${item.fotoRuang}" class="card-img-top">
              </div>
            `)
      const cardBody = $(`<div class="card-body">
                  <a href="#" class="ruang" data-bs-toggle="modal" data-bs-target="#detail-kelas" data-kode-ruang="${item.kodeRuang}">
                    <h6>${item.namaRuang}</h6>
                  </a>
                </div>
              `)
      cardBody.append(facilities)
      cardBody.append(`<a href="/peminjaman?kode=${item.kodeRuang}" class="btn btn-primary btn-sm">Pinjam Ruangan</a>`)

      innerContainer.append(cardBody)
      outerContainer.append(innerContainer)

      $('#list-filtered-ruang').append(outerContainer)

      onClickFilteredRuang()
    })
  }

  function printRuangToModal({ kodeRuang, namaRuang, kapasitas, lantai, jadwal, fasilitas, fotoRuang }) {
    // Clear State Before
    $('#modal-facilities').html('')
    $('#table-jadwal').html('')

    // Set new State
    $('#modal-foto-ruang').attr('src', `../${fotoRuang}`)
    $('#title-ruang').text(namaRuang)
    $('#kelas-active').text(kodeRuang)
    $('#modal-kode-ruang').text(kodeRuang)
    $('#modal-nama-ruang').text(namaRuang)
    $('#modal-kapasitas').text(kapasitas)
    $('#modal-lantai').text(lantai)
    
    $.each(fasilitas, function (index, item) {
      $('#modal-facilities').append(`
        <div class="facility">
          <i class="${item.icon} ${item.status ? "main-badge" : "error-main-badge"}"></i>
          <span>${item.namaFasilitas}</span>
        </div>
      `)
    })

    const dayName = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']
    for (let dayIndex = 2; dayIndex <= 6; dayIndex++) {
      const row = $('<tr></tr>')
      row.append(`<td>${dayName[dayIndex - 2]}</td>`)

      for (let hour = 1; hour <= 10; hour++) {
        const cell = $('<td></td>')
        let isSpanned = false

        $.each(jadwal, function (index, {hari, jamMulai: start, jamSelesai: end, mataKuliah}) {
          if (hari === dayIndex) {
            if (hour === start) {
              cell.attr('colspan', end - start + 1)
              cell.addClass('in-jadwal')
              cell.append(`<span>${mataKuliah.namaMk}</span>`)
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

      $('#table-jadwal').append(row)
    }

    $('#btn-pinjam').off('click').on('click', function() {
      window.location = `/peminjaman?kode=${kodeRuang}`
    })
  }
});