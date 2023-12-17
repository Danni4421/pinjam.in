document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar')
  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'id',
    dayHeaderFormat: {
      weekday: 'long'
    },
    selectable: true,
    editable: true,
    events: function (info, successCallback, failureCallback) {
      $.ajax({
        url: '../request.php',
        type: 'POST',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'PeminjamanRequest',
          payload: {
            method: 'GET',
            type: 'not-done'
          }
        }),
        success: function (response) {
          const result = JSON.parse(response)

          const events = result.map((peminjaman) => ({
            peminjamanId: peminjaman.peminjamanId,
            title: peminjaman.keterangan,
            start: new Date(peminjaman.tanggalKegiatanMulai),
            end: new Date(peminjaman.tanggalKegiatanSelesai),
            jamMulai: peminjaman.jamMulai,
            jamSelesai: peminjaman.jamSelesai,
            peminjam: peminjaman.peminjam.namaLengkap,
            ruang: peminjaman.ruang.map((ruang) => ruang.kodeRuang).join(', '),
            deskripsi: peminjaman.keterangan,
            status: peminjaman.status
          }))

          successCallback(events)
        },
        error: function (error) {
          failureCallback(error)
        }
      })
    },
    eventClick: function (e) {
      Swal.fire({
        title: e.event.title,
        html: `<div>
                            <p class="desciption">Keterangan: ${e.event.extendedProps.deskripsi}</p>
                            <p class="peminjam">Peminjam: ${e.event.extendedProps.peminjam ? e.event.extendedProps : 'Tidak ada nama'}</p>
                            <div class="status">
                                Status: 
                                <span class="peminjam badge text-bg-success">${e.event.extendedProps.status}</span>
                            </div>
                        </div>`,
        showCancelButton: true,
        confirmButtonText: 'Delete',
        showLoaderOnConfirm: true,

        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: e.event.title
          })
        }
      })
    },
    eventDrop: function (e) {
      const peminjamanId = e.event.extendedProps.peminjamanId
      const startDate = new Date(e.event.start).toLocaleDateString()
      const endDate = e.event.end ? new Date(e.event.end).toLocaleDateString() : startDate
      const jamMulai = e.event.extendedProps.jamMulai
      const jamSelesai = e.event.extendedProps.jamSelesai
      let ruang = e.event.extendedProps.ruang.split(',')
      ruang = ruang.map((ruang) => ruang.trim())
      const status = e.event.extendedProps.status

      Swal.fire({
        title: 'Ingin Mengubah Jam Kegiatan?',
        html: `
                    <div class="mt-3 d-flex justify-content-center align-items-center overflow-hidden">
                    <div class="form-group">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" id="editJamMulai" class="swal2-input" value="${jamMulai !== null ? jamMulai : ''}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" id="editJamSelesai" class="swal2-input" value="${jamSelesai !== null ? jamSelesai : ''}">
                    </div>
                    </div>
                `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Ubah',
        confirmButtonColor: '#65B741',
        preConfirm: () => {
          return {
            updatedJamMulai: $('#editJamMulai').val(),
            updatedJamSelesai: $('#editJamSelesai').val()
          }
        }
      }).then((response) => {
        if (response.isConfirmed) {
          const { updatedJamMulai, updatedJamSelesai } = response.value

          $.ajax({
            url: '../request.php',
            type: 'POST',
            contentType: 'application/json',
            processData: false,
            data: JSON.stringify({
              request_key: 'PeminjamanRequest',
              payload: {
                method: 'VERIFY',
                data: {
                  tanggalKegiatanMulai: startDate,
                  tanggalKegiatanSelesai: endDate,
                  jamMulai: updatedJamMulai,
                  jamSelesai: updatedJamSelesai,
                  ruang: ruang
                }
              }
            }),
            success: function (response) {
              const result = JSON.parse(response)

              if (result.error) {
                Swal.fire({
                  title: 'Gagal!',
                  text: `Tanggal ${startDate} pada jam ${updatedJamMulai} hingga jam ${updatedJamSelesai} telah digunakan`,
                  icon: 'error'
                })

                calendar.refetchEvents()
              } else {
                Swal.fire({
                  title: 'Apakah yakin ingin merubah tanggal kegiatan?',
                  text: 'Tindakan ini akan merubah tanggal kegiatan!',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Iya, Ubah Tanggal!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $.ajax({
                      url: '../request.php',
                      type: 'POST',
                      contentType: 'application/json',
                      processData: false,
                      data: JSON.stringify({
                        request_key: 'PeminjamanRequest',
                        payload: {
                          method: 'UPDATE',
                          data: {
                            peminjamanId: peminjamanId,
                            tanggalKegiatanMulai: startDate,
                            tanggalKegiatanSelesai: endDate,
                            jamMulai: updatedJamMulai,
                            jamSelesai: updatedJamSelesai,
                            status: status
                          }
                        }
                      }),
                      success: function (response) {
                        Swal.fire({
                          title: 'Berhasil!',
                          text: `Berhasil memperbarui peminjaman`,
                          icon: 'success'
                        })

                        calendar.refetchEvents()
                      }
                    })
                  } else {
                    calendar.refetchEvents()
                  }
                })
              }
            }
          })
        } else {
          calendar.refetchEvents()
        }
      })
    }
  })
  calendar.render()
})
