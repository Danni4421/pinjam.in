$(document).ready(function () {
  $.ajax({
      type: "POST",
      url: "../request.php",
      contentType: "application/json",
      processData: false,
      data: JSON.stringify({
        request_key: "RuangRequest",
        payload: {
          method: "GET",
          type: "rd",
        }
      }),
      success: function (response) {
        printRuangDosen(JSON.parse(response))
      }
    });

    function onClickRuangDosen() {
      $('.btn-detail-ruang').off('click').on('click', function() {
        const kodeRuang = $(this).attr('data-ruang-dosen')

        $.ajax({
          type: "POST",
          url: "../request.php",
          contentType: "application/json",
          processData: false,
          data: JSON.stringify({
            request_key: "RuangRequest",
            payload: {
              method: "DETAIL",
              type: "rd",
              kode_ruang: kodeRuang
            }
          }),
          success: function (response) {
            printRuangToModal(JSON.parse(response))
          }
        })
      })
    }

    function printRuangDosen(ruang) {
      $('#ruang-dosen-container').html('')
      
      $.each(ruang, function (index, {kodeRuang, namaRuang, kapasitas, lantai, fotoRuang, fasilitas}) {
        const header = $(`
          <div class="card-header" style="background-color: #1318A5; color: white;">
            <h5 class="card-title"><strong>${namaRuang}</strong></h5>
          </div>
        `)
      
      const image = $(`<img src="../${fotoRuang}" alt="Kapasitas-30" class="img-fluid rounded" style="width: 100%;">`)

      const facilitiesContainer = $(`
        <div class="facility-grid d-flex flex-column gap-2">          
          <h4 class="card-title"><strong>Fasilitas yang dimiliki :</strong></h4>
        </div>
      `)
      $.each(fasilitas, function (index, item) {
        facilitiesContainer.append(`
          <div class="facility">
            <i class="${item.icon} ${item.status ? "main-badge" : "error-main-badge"}"></i>
            <span>${item.namaFasilitas}</span>
          </div>
        `)
      })

      const moreInformation = $(`
        <p class="card-text d-flex gap-2 my-3">
          <span class="secondary-badge">
            <i class="fas fa-users"></i>
            ${kapasitas}
          </span>
          <span class="error-main-badge">
            <i class="fas fa-list-alt"></i>
            ${lantai}
          </span>
        </p>
      `)

      const btnMoreInformation = $(`
        <button type="button" class="btn btn-primary mt-5 btn-detail-ruang" style="width: 100%;" data-ruang-dosen="${kodeRuang}" data-bs-toggle="modal" data-bs-target="#detailDosen">
          Lihat Informasi Ruangan
        </button>
      `)

      const cardBody = $(`<div class="card-body"></div>`)
      const card = $(`<div class="card col p-0" style="max-width: 30% !important; "></div>`)

      cardBody.append(image, moreInformation, facilitiesContainer, btnMoreInformation)
      card.append(header, cardBody)

          $('#ruang-dosen-container').append(card)
      })

      onClickRuangDosen()
    }

    function printRuangToModal({kodeRuang, namaRuang, kapasitas, lantai, fotoRuang, fasilitas, dosen}) {
      $('#ruang-active').text(kodeRuang)
      $('#modal-foto-ruang').attr('src', `../${fotoRuang}`)
      $('#modal-kode-ruang').text(kodeRuang)
      $('#modal-nama-ruang').text(namaRuang)
      $('#modal-kapasitas').text(kapasitas)
      $('#modal-lantai').text(lantai)
      $('#table-list-dosen').DataTable().destroy();

      $.each(fasilitas, function (index, item) {
        const content = $(`
          <div class="facility">
            <i class="${item.icon} ${item.status ? "main-badge" : "error-main-badge"}"></i>
            <span>${item.namaFasilitas}</span>
          </div>
        `)

        $('#modal-facilities').append(content)
      })

      tableDosen = $('#table-list-dosen').DataTable({
        data: dosen,
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
              return `<img src="../${row.fotoProfil}" width="50" height="50" />`
            }
          },
          {
            data: 'nip'
          },
          {
            data: 'namaLengkap'
          },
          {
            data: 'email'
          },
          {
            data: 'noTelp'
          }
        ]
      })


    }
});