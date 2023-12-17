$('#search-button').click(function () {
  const searchResult = $('#search-input').val();
  window.location = 'ruang.php';

  $.ajax({
    type: 'POST',
    url: '/ruang',
    contentType: false,
    data: {
      search: searchResult,
    },
  });
});
