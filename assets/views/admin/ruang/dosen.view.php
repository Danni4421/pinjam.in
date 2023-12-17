<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Dosen</title>
    <?php require_once 'assets/dist/styles/admin/styles.php'; ?>
    <link rel="stylesheet" href="<?= $relativePath ?>assets/dist/styles/admin/ruang.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php
        require 'assets/components/admin/Navbar.php';
        require 'assets/components/superadmin/Sidebar.php';

        require 'assets/components/admin/Footer.php';
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="text-align: center;">Ruang Dosen</h1>
                        </div>
                    </div>
                </div>
            </section>


            <section class="content">
                <div class="container-fluid">
                    <div class="card" style="padding: 2%;">
                        <div class="row" id="ruang-dosen">
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php
        require_once 'assets/components/admin/ruang/modal/dosen/Main.php';
        require_once 'assets/components/admin/ruang/modal/dosen/AddDosen.php';
        require_once 'assets/components/admin/ruang/modal/dosen/EditDosen.php';
        ?>

        <?php require_once 'assets/dist/scripts/admin/scripts.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
        <script src="<?= $relativePath ?>assets/dist/scripts/admin/ruang/main.js"></script>
        <script>
            $(document).ready(function() {
                getRuang('rd');
            });
        </script>
</body>

</html>