<?php

interface IRuangRepository extends Repository
{
    /**
     * @param string $kodeRuang
     * @return array
     */
    public function getFasilitas($kodeRuang);

    /**
     * @param string $namaRuang
     * @return Ruang
     */
    public function search($namaRuang);
}
