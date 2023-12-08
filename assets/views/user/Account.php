<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/styles/user/index.css">
    <link rel="stylesheet" href="assets/dist/styles/user/account.css">
</head>

<body>
    <div class="container-fluid">
        <?php
        require 'assets/components/user/Navbar.php';
        ?>

        <div class="container row row-cols-1 align-items-center justify-content-center mt-5 mx-auto">
            <h2 class="col-9">Profile</h2>
            <form method="POST" enctype="multipart/form-data" id="profile-form" class="col w-75">
                <div class="mb-3 row align-items-center">
                    <div class="input-group-outer col-8">
                        <label for="basic-url" class="form-label">Detail User</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Username</span>
                            <input type="text" class="form-control" placeholder="Username" value="#" id="username" disabled>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                            <input type="email" class="form-control disabled" placeholder="Email" value="#" id="email" disabled>
                        </div>

                        <input type="hidden" name="user_id" value="#">
                    </div>
                    <div class=" profile-pic-wrapper col-3">
                        <div class="pic-holder">
                            <!-- uploaded pic shown here -->
                            <img id="profilePic" class="pic" src="#">

                            <input class="uploadProfileInput" type="file" name="foto_profil" id="newProfilePhoto" accept=".img, .jpg, .jpeg" style="opacity: 0;" />
                            <input type="hidden" value="#" name="old_foto_profil">

                            <label for="newProfilePhoto" class="upload-file-block">
                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="fa fa-camera fa-2x"></i>
                                    </div>
                                    <div class="text-uppercase">
                                        Update <br /> Profile Photo
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="basic-url" class="form-label">Biodata Diri</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">Nama Lengkap</span>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="#">
                    </div>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Alamat</span>
                    <input type="text" class="form-control" name="alamat" id="alamat" value="#">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Nomor Telepon</span>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" value="#">
                </div>

                <button type="submit" class="btn btn-primary" id="btn-submit">Perbarui</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="assets/dist/scripts/user/account.js"></script>
</body>

</html>