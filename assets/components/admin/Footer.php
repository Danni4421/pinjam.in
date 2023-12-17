<!-- Footer -->
<footer class="main-footer" id="main-footer">
    <div class="container">
        <div class="float-left">
            <b>Copyright &copy; 2023 <a href="pinjamin.id">Pinjam.in</a>.</b>
            All rights reserved.
        </div>
        <div class="float-right">
            <b>Version</b> 1.0.0
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="<?= $relativePath ?>assets/plugins/lte/scripts/jquery.overlayScrollbars.min.js"></script>
<script src="<?= $relativePath ?>assets/dist/scripts/admin/index.js"></script>
<script src="<?= $relativePath ?>assets/dist/scripts/components/switcher.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'request.php',
            type: 'POST',
            contentType: 'application/json',
            processData: false,
            data: JSON.stringify({
                request_key: 'GetAllRuangRequest',
                payload: [],
            }),
            success: function(response) {
                const ruang = JSON.parse(response);

                $.each(ruang, function(index, {
                    isRuangDosen,
                    namaRuang,
                    kapasitas
                }) {

                    const content = $(`
                            <tr>
                                <td>${namaRuang}</td>
                                <td>${kapasitas}</td>
                            </tr>
                            `);

                    $(`#${isRuangDosen ? "list-ruang-dosen" : "list-ruang-kelas"}`).append(content);
                });
            },
        });
    });
</script>
</body>

</html>