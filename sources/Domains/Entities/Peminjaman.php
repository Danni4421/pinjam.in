<?php

class Peminjaman implements HasRequest
{
    private int $peminjamanId;
    private Peminjam $peminjam;
    private DateTime $tanggalPeminjaman;
    private DateTime $tanggalKegiatanMulai;
    private DateTime $tanggalKegiatanSelesai;
    private DateTime $jamMulai;
    private DateTime $jamSelesai;
    private string $keterangan;
    private string $status;

    /** @var Ruang[] */
    private $ruang;

    public function __construct($peminjamanId, $peminjam, $tanggalPeminjaman, $tanggalKegiatanMulai, $tanggalKegiatanSelesai, $jamMulai, $jamSelesai, $keterangan, $status, $ruang)
    {
        $this->peminjamanId = $peminjamanId;
        $this->peminjam = $peminjam;
        $this->tanggalPeminjaman = $tanggalPeminjaman;
        $this->tanggalKegiatanMulai = $tanggalKegiatanMulai;
        $this->tanggalKegiatanSelesai = $tanggalKegiatanSelesai;
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

    public function getTanggalKegiatanMulai()
    {
        return $this->tanggalKegiatanMulai;
    }

    public function getTanggalKegiatanSelesai()
    {
        return $this->tanggalKegiatanSelesai;
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

    public function toArray()
    {
        $ruangan = [];
        foreach ($this->getRuang() as $ruang) {
            $ruangan[] = [
                "kodeRuang" => $ruang->getKodeRuang(),
            ];
        }

        return [
            "peminjamanId" => $this->getPeminjamanId(),
            "peminjam" => [
                "id" => $this->getPeminjam()->getId(),
                "nomorInduk" => $this->getPeminjam()->getUserDetails()->getNomorInduk(),
                "namaLengkap" => $this->getPeminjam()->getUserDetails()->getNamaLengkap(),
                "alamat" => $this->getPeminjam()->getUserDetails()->getAlamat(),
                "noTelp" => $this->getPeminjam()->getUserDetails()->getNoTelp(),
                "instansi" => $this->getPeminjam()->getInstansi(),
            ],
            "tanggalPeminjaman" => $this->getTanggalPeminjaman()->format("Y-m-d"),
            "tanggalKegiatanMulai" => $this->getTanggalKegiatanMulai()->format("Y-m-d"),
            "tanggalKegiatanSelesai" => $this->getTanggalKegiatanSelesai()->format("Y-m-d"),
            "jamMulai" => $this->getJamMulai()->format("H:i:s"),
            "jamSelesai" => $this->getJamSelesai()->format("H:i:s"),
            "keterangan" => $this->getKeterangan(),
            "status" => $this->getStatus(),
            "ruang" => $ruangan,
        ];
    }
}
