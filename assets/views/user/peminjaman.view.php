<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam.in - Peminjaman Ruangan JTI</title>
    <?php require_once 'assets/dist/styles/user/styles.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <?php require_once 'assets/components/user/Navbar.php'; ?>
    <main id="main" style="padding-top: 100px;" class="container row flex-row-reverse justify-content-center mx-auto px-3">
        <section class="col-8 pt-0">
            <?php require_once 'assets/components/user/FormPeminjaman.php'; ?>
        </section>
        <aside class="col-4">
            <h4>Ruang Dipilih</h4>
            <div id="selected-ruang" class="d-flex flex-column justify-content-start gap-3">
                <h6>Tidak ada ruang yang dipilih</h6>
            </div>
        </aside>
    </main>

    <?php 
        require_once 'assets/components/user/Footer.php';
        require_once 'assets/dist/scripts/user/scripts.php';
    ?>
    <script src="../assets/dist/scripts/user/peminjaman.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>