<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="resources/css/user/index.css">
    <link rel="stylesheet" href="resources/css/user/ruang.css">

</head>

<body>
    <div class="container-fluid">
        <?php
        require 'assets/components/user/Navbar.php';
        ?>

        <div class="container-fluid px-5 mt-5 d-flex justify-content-end">
            <div class="input-group gap-3" style="max-width: 30%;">
                <input type="text" id="search" placeholder="Cari ruang" class="form-control">
                <div class="filter">
                    <select id="filter" class="form-select">
                        <option value="all" selected>Semua Ruang</option>
                        <option value="rk">Ruang Kelas</option>
                        <option value="rd">Ruang Dosen</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container-fluid px-5">
            <div class="row" id="list_ruang">

            </div>
        </div>

        <?php
        require_once 'assets/components/user/ModalRuangKelas.php';
        require_once 'assets/components/user/ModalRuangDosen.php';
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>