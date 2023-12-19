<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pinjam.in</title>
    <link rel="stylesheet" href="../assets/dist/styles/authentications.css">
    <script
      src="https://code.jquery.com/jquery-3.7.1.js"
      integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container <?= $uri === "/register" ? "log-in" : "" ?>">
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
                <form method="post" id="form-login">
                  <h2 align="center">Login</h2>
                    <input
                    name="email"
                    placeholder="Email"
                    type="text"
                    id="login-email"
                    /><input
                    name="password"
                    placeholder="Password"
                    type="Password"
                    id="login-password"
                    />
                    <button class="btn" type="submit">Sign in</button>
                </form>
              </div>
            </div>
          </div>
          <div class="form-item sign-up">
            <div class="table">
              <div class="table-cell">
                <form method="post" id="form-register">
                  <h2 align="center">Register</h2>
                    <input
                    name="username"
                    placeholder="Username"
                    type="text"
                    id="register-username"
                    /><input 
                    name="email" 
                    placeholder="Email" 
                    type="text" 
                    id="register-email"
                    /><input
                    name="password"
                    placeholder="Password"
                    type="password"
                    id="register-password"
                    /><input
                    name="confirm_password"
                    placeholder="Confirm Password"
                    type="password"
                    id="register-confirm-password"
                    />
                    <button class="btn" id="btn-register" type="submit" disabled>Sign up</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/dist/scripts/authentications.js"></script>
  </body>
</html>
