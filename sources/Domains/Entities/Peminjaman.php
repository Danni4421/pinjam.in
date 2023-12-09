<?php

class Peminjaman
{
    private int $peminjamanId;
    private Peminjam $peminjam;
    private DateTime $tanggalPeminjaman;
    private DateTime $tanggalKegiatan;
    private JamKuliah $jamMulai;
    private JamKuliah $jamSelesai;
    private string $keterangan;
    private string $status;

    /** @var Ruang[] */
    private $ruang;

    public function __construct($peminjamanId, $peminjam, $tanggalPeminjaman, $tanggalKegiatan, $jamMulai, $jamSelesai, $keterangan, $status, $ruang)
    {
        $this->peminjamanId = $peminjamanId;
        $this->peminjam = $peminjam;
        $this->tanggalPeminjaman = $tanggalPeminjaman;
        $this->tanggalKegiatan = $tanggalKegiatan;
        $this->jamMulai = $jamMulai;
        $this->jamSelesai = $jamSelesai;
        $this->keterangan = $keterangan;
        $this->status = $status;
        $this->ruang = $ruang;
    }

    public function getPeminjamanId()
    {
        return $this->peminjamanId;
    }

    public function getPeminjam()
    {
        return $this->peminjam;
    }

    public function getTanggalPeminjaman()
    {
        return $this->tanggalPeminjaman;
    }

    public function getTanggalKegiatan()
    {
        return $this->tanggalKegiatan;
    }

    public function getJamMulai()
    {
        return $this->jamMulai;
    }

    public function getJamSelesai()
    {
        return $this->jamSelesai;
    }

    public function getKeterangan()
    {
        return $this->keterangan;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRuang()
    {
        return $this->ruang;
    }
}