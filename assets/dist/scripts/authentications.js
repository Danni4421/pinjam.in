$(document).ready(function () {
  $('.info-item .btn').click(function () {
    $('.container').toggleClass('log-in')
  })

  $('#form-login')
    .off('submit')
    .on('submit', function (e) {
      e.preventDefault()

      const email = $('#login-email').val()
      const password = $('#login-password').val()

      $.ajax({
        type: 'POST',
        url: '../request.php',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'AuthenticationRequest',
          payload: {
            type: 'login',
            data: {
              email,
              password
            }
          }
        }),
        success: function (response) {
          const result = JSON.parse(response)

          console.log(result)

          if (result.status === 'success') {
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
              icon: 'success',
              title: 'Login Berhasil'
            })

            switch (result.data) {
              case 'user':
                location.href = '/'
                break
              case 'admin':
              case 'superadmin':
                location.href = '/admin'
                break
            }
          } else {
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
              title: 'Login Gagal'
            })
          }
        }
      })
    })

  $('#form-register')
    .off('submit')
    .on('keyup', function (e) {
      e.preventDefault()

      const password = $('#register-password').val()
      const confirmPassword = $('#register-confirm-password').val()

      $('#btn-register').attr('disabled', password !== confirmPassword)
    })
    .on('submit', function (e) {
      e.preventDefault()

      const username = $('#register-username').val()
      const email = $('#register-email').val()
      const password = $('#register-password').val()

      $.ajax({
        type: 'POST',
        url: '../request.php',
        contentType: 'application/json',
        processData: false,
        data: JSON.stringify({
          request_key: 'AuthenticationRequest',
          payload: {
            type: 'register',
            data: {
              username,
              email,
              password
            }
          }
        }),
        success: function (response) {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer
              toast.onmouseleave = Swal.resumeTimer
            }
          })
          Toast.fire({
            icon: 'success',
            title: 'Registrasi Berhasil'
          })

          $('#register-username').val('')
          $('#register-email').val('')
          $('#register-password').val('')
          $('.container').removeClass('log-in')
        }
      })
    })
})
