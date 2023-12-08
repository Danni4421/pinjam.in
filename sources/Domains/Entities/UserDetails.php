<?php

class UserDetails
{
    private string $nomorInduk;
    private string $namaLengkap;
    private string $alamat;
    private string $noTelp;
    private string $fotoProfil;

    /**
     * @param string $namaLengkap
     * @param string $alamat
     * @param string $noTelp
     * @param $fotoProfil
     */
    public function __construct($nomorInduk, $namaLengkap, $alamat, $noTelp, $fotoProfil)
    {
        $this->nomorInduk = $nomorInduk;
        $this->namaLengkap = $namaLengkap;
        $this->alamat = $alamat;
        $this->noTelp = $noTelp;
        $this->fotoProfil = $fotoProfil;
    }

    public function getNomorInduk()
    {
        return $this->nomorInduk;
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
}
