<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
    <?php require_once 'assets/dist/styles/admin/styles.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php
        require 'assets/components/admin/Navbar.php';

        if ($_SESSION["user"]["level"] == "admin") {
            require 'assets/components/admin/Sidebar.php';
        } else {
            require 'assets/components/superadmin/Sidebar.php';
        }

        require 'assets/components/admin/Footer.php';
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 style="text-align: center;">Kalender</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content" style="padding-top: 1%;">
                <div class="container-fluid">
                    <div class="card card-primary card-outline">
                        <div class="card-header border-transparent">

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="calendar" style="max-height: 70vh;"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php require_once 'assets/dist/scripts/admin/scripts.php'; ?>
        <script src="../assets/dist/scripts/admin/kalender.js"></script>
</body>

</html>