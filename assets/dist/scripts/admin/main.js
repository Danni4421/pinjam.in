$(document).ready(function () {
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
      const ruang = JSON.parse(response)

      $.each(ruang, function (index, { isRuangDosen, namaRuang, kapasitas }) {
        const content = $(`
                            <tr>
                                <td>${namaRuang}</td>
                                <td>${kapasitas}</td>
                            </tr>
                            `)

        $(`#${isRuangDosen ? 'list-ruang-dosen' : 'list-ruang-kelas'}`).append(content)
      })
    }
  })
})
