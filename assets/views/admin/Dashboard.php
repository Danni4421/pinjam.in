<?php
$uri = "";
if (isset($_SERVER["REQUEST_URI"])) {
    $uri = $_SERVER["REQUEST_URI"];
}

$pathCount = count(array_filter(explode('/', $uri)));
$relativePath = str_repeat('../', $pathCount - 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= $relativePath ?>assets/plugins/lte/styles/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= $relativePath ?>assets/dist/styles/admin/index.css">
    <link rel="stylesheet" href="<?= $relativePath ?>assets/dist/styles/components/switcher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php
        require 'assets/components/admin/Navbar.php';

        if (true) {
            require 'assets/components/admin/Sidebar.php';
            require_once 'assets/components/admin/Dashboard.php';
        } else {
            require 'assets/components/superadmin/Sidebar.php';
            require_once 'assets/components/superadmin/Dashboard.php';
        }

        require 'assets/components/admin/Footer.php';
        ?>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="<?= $relativePath ?>assets/plugins/lte/scripts/jquery.overlayScrollbars.min.js"></script>
        <script src="<?= $relativePath ?>assets/dist/scripts/admin/index.js"></script>
        <script src="<?= $relativePath ?>assets/dist/scripts/components/switcher.js"></script>
</body>

</html>