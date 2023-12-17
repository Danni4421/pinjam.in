<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pinjam.in - Peminjaman Ruangan JTI</title>
  <?php require_once 'assets/dist/styles/user/styles.php'; ?>
</head>

<body>
  <!-- Navbar -->
  <?php require_once 'assets/components/user/Navbar.php'; ?>
  <!-- End Navbar -->

  <main id="main">
    <section class="content">
      <div class="container-fluid">
        <div class="card" style="padding: 2% 5%; margin-top: 40px;">
          <div class="row g-0">
            <div class="container-fluid">
              <?php
              if (isset($query["amount"])) {
                require_once 'assets/components/user/ruang/kelas/Filtered.php';
              } else {
                require_once 'assets/components/user/ruang/kelas/Main.php';
              }
              ?>
            </div>
          </div>
        </div>

      </div>

    </section>
  </main><!-- End #main -->


  <?php
  require_once 'assets/components/user/Footer.php';
  require_once 'assets/dist/scripts/user/scripts.php';
  ?>
  <script src="../assets/dist/scripts/user/ruang/kelas.js"></script>
</body>

</html>