<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Peminjaman</title>
    <link href="../assets/img/favicon.png" rel="icon">
    <style>
        @page {
          margin: 0 10%;
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page" id="result">
            <table style="width: 100%;">
                <tr>
                    <td><img src="https://psdkukediri.polinema.ac.id/wp-content/uploads/2020/06/LOGO-POLINEMA-transparent-3.png" alt="Foto" style="width: 140px;"></td>
                    <td>
                        <div style="text-align: center; font-size: 20px; letter-spacing: 0.5px;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, <br>RISET, DAN TEKNOLOGI <br> POLITEKNIK NEGERI MALANG <br> JURUSAN TEKNOLOGI INFORMASI
                            <p style="font-size: 15px; margin-top: 0px;"> Jl. Soekarno Hatta No. 9 Malang 65141
                                <br> Telp (0341)404424 - 404425 Fax (0341)404420
                                <br> Laman://www.polinema.ac.id</p>
                        </div>
                    </td>
                </tr>
            </table>
            <hr style="border: 2px solid black; margin-top: 0px;">
            <table>
                <tr>
                    <td style="width: 100px;">Nomor</td>
                    <td>:</td>
                    <td>&nbsp;
                      <span id="id-peminjaman"></span>/PR.TI/<span id="month"></span>/<span id="year"></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Perihal</td>
                    <td>:</td>
                    <td><b>&nbsp;Permohonan Peminjaman Ruangan</td>
                </tr>
            </table>
            <p style="margin-top: 50px; margin-bottom: 30px; line-height:1.5;">Kepada Yth.:
                <br>Ketua Jurusan Teknologi Informasi
                <br>Politeknik Negeri Malang
            </p>
            <p style="margin-top: 30px;line-height:1.5;">
              Dengan hormat, 
              <br> Dalam rangka kegiatan 
              <b id="keterangan"></b> 
              kami <span id="instansi"></span> mengajukan permohonan peminjaman ruangan <b id="list-ruang"></b> yang ada di Gedung Jurusan Teknologi Informasi Politeknik Negeri Malang, 
              Adapun rencana kegiatan akan dilaksanakan pada:
            </p>
            <table>
                <tr>
                    <td style="width: 100px;">Hari/Tanggal</td>
                    <td>:</td>
                    <td id="tanggal-kegiatan">&nbsp;
                      <span id="tanggal-kegiatan-mulai"></span> / 
                      <span id="tanggal-kegiatan-selesai"></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100px;">Pukul</td>
                    <td>:</td>
                    <td>&nbsp;
                      <span id="jam-mulai"></span> s/d
                      <span id="jam-selesai"></span> WIB
                    </td>
                </tr>
            </table>
            <p style="margin-top: 30px;line-height:1.5;">Demikian permohonan ini disampaikan, atas perhatian dan bantuannya diucapkan terima kasih.</p>
            <div style="margin-top: 80px;float:right">
                <div style="width: 280px;text-align: left;  line-height: 5px;">
                    <p id="tanggal-persetujuan"></p>
                    <p>Disetujui Ketua Jurusan,</p>
                    <p style="margin-top: 80px;  line-height: 20px;">(Dr.Eng.Rosa Andrie Asmara, ST., MT.) <br>NIP. 19711110199031002</p>
                </div>
            </div>
            <div style="margin-top: 300px;float:left">
                <div style="width: 200px;text-align: left; line-height: 5px;">
                    <p>Tembusan: 1. OB Gedung JTI</p>
                    <p style="margin-left: 75px;">2. SATPAM</p>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'assets/dist/scripts/user/scripts.php' ?>
    <script src="../../assets/dist/scripts/user/surat.js"></script>
</body>

</html>
