<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php
    require 'assets/components/admin/Navbar.php';

    if ($_SESSION["user"]["level"] == "admin") {
      require 'assets/components/admin/Sidebar.php';
    } else {
      require 'assets/components/superadmin/Sidebar.php';
    }
