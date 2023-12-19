$(document).ready(function () {
  $('#form-add-jadwal')
    .off('change')
    .on('change', function() {
    const hari = $('#add-hari').val()
    const jamMulai = $('#add-jam-mulai').val()
    const jamSelesai = $('#add-jam-selesai').val()
    const mataKuliah = $('#add-matakuliah').val()
    const kodeRuang = $('#mainModalKodeRuang').text()

    $.ajax({
      type: 'POST',
      url: '../../request.php',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'JadwalRequest',
        payload: {
          method: 'VERIFY',
          data: {
            kode_ruang: kodeRuang,
            hari: hari,
            jam_mulai: jamMulai,
            jam_selesai: jamSelesai
          }
        }
      }),
      success: function(response) {
        const {error} = JSON.parse(response);
        $('#btn-add-jadwal').attr('disabled', error)

        onSubmitAddJadwal({hari, jamMulai, jamSelesai, mataKuliah, kodeRuang})
      }
    })
  })

  $('#form-edit-jadwal')
    .off('change')
    .on('change', function() {
    const hari = $('#add-hari').val()
    const jamMulai = $('#add-jam-mulai').val()
    const jamSelesai = $('#add-jam-selesai').val()
    const mataKuliah = $('#add-matakuliah').val()
    const kodeRuang = $('#mainModalKodeRuang').text()

    $.ajax({
      type: 'POST',
      url: '../../request.php',
      contentType: 'application/json',
      processData: false,
      data: JSON.stringify({
        request_key: 'JadwalRequest',
        payload: {
          method: 'VERIFY',
          data: {
            kode_ruang: kodeRuang,
            hari: hari,
            jam_mulai: jamMulai,
            jam_selesai: jamSelesai
          }
        }
      }),
      success: function(response) {
        const {error} = JSON.parse(response);
        $('#btn-edit-jadwal').attr('disabled', error)

        onSubmitAddJadwal({hari, jamMulai, jamSelesai, mataKuliah, kodeRuang})
      }
    })
  })

  function onSubmitAddJadwal({hari, jamMulai, jamSelesai, mataKuliah, kodeRuang}) {
    $('#form-add-jadwal').off('submit').on('submit', function(e) {
      e.preventDefault()

      $.ajax({
        type: 'POST',
        url: '../../request.php',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'JadwalRequest',
          payload: {
            method: 'ADD',
            data: {
              mk_id: mataKuliah,
              hari,
              jk_mulai: jamMulai,
              jk_selesai: jamSelesai,
              kode_ruang: kodeRuang
            }
          }
        }),
        success: function(response) {
          const message = JSON.parse(response)

          Swal.fire({
          title: 'Berhasil!',
          text: message,
          icon: 'success'
        })

          setTimeout(() => {
            location.reload()
          }, 1500)
        }
      })
    })
  }
});