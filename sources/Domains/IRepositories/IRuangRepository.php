<?php

interface IRuangService extends Repository
{
    /**
     * @param string $kode_ruang
     * @return array
     */
    public function getFasilitas($kode_ruang);

    /**
     * @param string $nama_ruang
     * @return Ruang
     */
    public function search($nama_ruang);
}