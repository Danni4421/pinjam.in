<?php

class UserDetails
{
    private ?string $nomorInduk;
    private ?string $namaLengkap;
    private ?string $alamat;
    private ?string $noTelp;
    private ?string $fotoProfil;
    private ?string $kodeRuang;
    private int $isDosen;

    /**
     * @param ?string $nomorInduk
     * @param ?string $namaLengkap
     * @param ?string $alamat
     * @param ?string $noTelp
     * @param ?string $fotoProfil
     * @param ?string $kodeRuang
     * @param int $isDosen
     */
    public function __construct(
        $nomorInduk = null,
        $namaLengkap = null,
        $alamat = null,
        $noTelp = null,
        $fotoProfil = null,
        $kodeRuang = null,
        $isDosen = 0
    ) {
        $this->nomorInduk = $nomorInduk;
        $this->namaLengkap = $namaLengkap;
        $this->alamat = $alamat;
        $this->noTelp = $noTelp;
        $this->fotoProfil = $fotoProfil;
        $this->kodeRuang = $kodeRuang;
        $this->isDosen = $isDosen;
    }

    public function getNomorInduk()
    {
        return $this->nomorInduk;
    }

    public function getKodeRuang()
    {
        return $this->kodeRuang;
    }

    public function getNamaLengkap()
    {
        return $this->namaLengkap;
    }

    public function getAlamat()
    {
        return $this->alamat;
    }

    public function getNoTelp()
    {
        return $this->noTelp;
    }

    public function getFotoProfil()
    {
        return $this->fotoProfil;
    }

    public function verifyIsDosen()
    {
        return $this->isDosen;
    }
}
