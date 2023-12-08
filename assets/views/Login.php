<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                            <h4 class="fw-bold">Sign in</h4>
                            <p>
                                Login cepat jangan sampai telat! <br />
                                Ruanganmu menunggumu :)
                            </p>
                        </div>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="inputEmail" name="email" required />
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password" required />
                        </div>
                        <div class="button-group d-flex flex-column gap-3">
                            <button type="submit" class="w-100 btn btn-primary">
                                Login
                            </button>
                            <span class="text-center">Don't have an account yet?</span>
                            <a href="/register" class="w-100 btn btn-outline-primary">
                                Register
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>