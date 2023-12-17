<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userRepository = new UserRepository(new MySQL());
    $userUseCase = new UserUseCase($userRepository);

    $userUseCase->register(
        payload: $_POST,
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row">
            <div class="col-7">
                <img src="assets/dist/images/cover.png" width="560" />
            </div>
            <div class="col-4">
                <div class="container">
                    <div class="navbar-brand d-flex flex-column justify-content-center">
                        <img src="assets/dist/images/logo-dark.png" class="mb-3" width="150" />
                        <div class="tagline mb-3">
                            <h4 class="fw-bold">Sign up</h4>
                            <p>
                                Register cepat jangan sampai telat! <br />
                                Ruanganmu menunggumu :)
                            </p>
                        </div>

                        <?php
                        if (isset($_SESSION["message"])) {
                            MessageHelper::load();
                        }
                        ?>

                    </div>
                    <form method="POST" id="form">
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputUsername" aria-describedby="inputUsername" name="username" required />
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="inputEmail" name="email" required />
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password" required />
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="password" required />
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="confirmRegistration" required>
                            <label class="form-check-label" for="confirmRegistration">Konfirmasi Registrasi</label>
                        </div>
                        <div class="button-group d-flex flex-column gap-3">
                            <button type="submit" id="btnSubmit" class="w-100 btn btn-primary disabled">
                                Register
                            </button>
                            <span class="text-center">Already have an account?</span>
                            <a href="/login" class="w-100 btn btn-outline-primary">
                                Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#form').keyup(function(e) {
                const password = $('#inputPassword').val();
                const confirmPassword = $('#confirmPassword').val();
                if (confirmPassword === password && confirmPassword !== "" && password !== "") {
                    $('#btnSubmit').removeClass('disabled');
                } else {
                    $('#btnSubmit').addClass('disabled');
                }
            })
        });
    </script>
</body>

</html>