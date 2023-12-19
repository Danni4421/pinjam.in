$(document).ready(function () {
  const url = window.location.search
  const params = new URLSearchParams(url)
  const peminjamanId = params.has('id') ? params.get('id') : null
  const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }

  $.ajax({
    type: 'POST',
    url: '../../request.php',
    contentType: 'application/json',
    processData: false,
    data: JSON.stringify({
      request_key: 'PeminjamanRequest',
      payload: {
        method: 'DETAIL',
        peminjamanId
      }
    }),
    success: function (response) {
      const { peminjamanId, keterangan, ruang, tanggalKegiatanMulai, tanggalKegiatanSelesai, jamMulai, jamSelesai, tanggalPersetujuan } =
        JSON.parse(response)
      console.log(jamMulai, jamSelesai)

      $('#id-peminjaman').text(peminjamanId)
      $('#month').text(new Date().getMonth())
      $('#year').text(new Date().getFullYear())
      $('#keterangan').text(keterangan)
      $('#list-ruang').text(ruang.map((ruang) => ruang.kodeRuang).join(', '))
      $('#tanggal-kegiatan-mulai').text(new Date(tanggalKegiatanMulai).toLocaleDateString('id-ID', dateOptions))
      $('#tanggal-kegiatan-selesai').text(new Date(tanggalKegiatanSelesai).toLocaleDateString('id-ID', dateOptions))
      $('#jam-mulai').text(jamMulai)
      $('#jam-selesai').text(jamSelesai)
      $('#jam-selesai').text(jamSelesai)
      $('#tanggal-persetujuan').text(new Date(tanggalPersetujuan).toLocaleDateString('id-ID', dateOptions))
    }
  })
})
