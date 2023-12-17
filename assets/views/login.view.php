<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authenticationRepository = new AuthenticationRepository(new MySQL());
    $userRepository = new UserRepository(new MySQL());
    $loginUseCase = new AuthenticationUseCase(
        authenticationRepository: $authenticationRepository,
        userRepository: $userRepository,
    );

    $loginUseCase->login(payload: $_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pinjam.in</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../assets/dist/styles/authentications.css">
    <script
      src="https://code.jquery.com/jquery-3.7.1.js"
      integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container">
      <div class="box"></div>
      <div class="container-forms">
        <div class="container-info">
          <div class="info-item">
            <div class="table">
              <div class="table-cell">
                <p>Sudah Punya Akun?</p>
                <div class="btn">Sign in</div>
              </div>
            </div>
          </div>
          <div class="info-item">
            <div class="table">
              <div class="table-cell">
                <p>Belum Punya Akun?</p>
                <div class="btn">Sign up</div>
              </div>
            </div>
          </div>
        </div>
        <div class="container-form">
          <div class="form-item log-in">
            <div class="table">
              <div class="table-cell">
                <form method="post">
                    <input
                    name="email"
                    placeholder="Email"
                    type="text"
                    /><input
                    name="password"
                    placeholder="Password"
                    type="Password"
                    />
                </form>
                <button class="btn" type="submit">Sign in</button>
              </div>
            </div>
          </div>
          <div class="form-item sign-up">
            <div class="table">
              <div class="table-cell">
                <form method="post">
                    <input
                    name="username"
                    placeholder="Username"
                    type="text"
                    /><input 
                    name="email" 
                    placeholder="Email" 
                    type="text" 
                    /><input
                    name="password"
                    placeholder="Password"
                    type="password"
                    /><input
                    name="confirm_password"
                    placeholder="Confirm Password"
                    type="password"
                    />
                </form>
                <button class="btn" type="submit">Sign up</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script> -->
    <script src="../assets/dist/scripts/login.js"></script>
  </body>
</html>
