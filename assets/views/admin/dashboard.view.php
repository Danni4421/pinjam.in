<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require_once 'assets/dist/styles/admin/styles.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php
        require 'assets/components/admin/Navbar.php';

        if ($_SESSION["user"]["level"] == "admin") {
            require 'assets/components/admin/Sidebar.php';
            require_once 'assets/components/admin/Dashboard.php';
        } else {
            require 'assets/components/superadmin/Sidebar.php';
            require_once 'assets/components/superadmin/Dashboard.php';
        }

        require_once 'assets/components/admin/Footer.php';

        require_once 'assets/dist/scripts/admin/scripts.php';
        ?>
        <script src="assets/dist/scripts/main.js"></script>
</body>

</html>