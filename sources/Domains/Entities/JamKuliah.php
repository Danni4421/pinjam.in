<?php

class JamKuliah
{
    private int $jkId;
    private DateTime $jamMulai;
    private DateTime $jamSelesai;

    /**
     * @param int $jkId
     * @param DateTime $jamMulai
     * @param DateTime $jamSelesai
     */
    public function __construct($jkId, $jamMulai, $jamSelesai)
    {
        $this->jkId = $jkId;
        $this->jamMulai = $jamMulai;
        $this->jamSelesai = $jamSelesai;
    }

    public function getJkId()
    {
        return $this->jkId;
    }

    public function getJamMulai()
    {
        return $this->jamMulai;
    }

    public function getJamSelesai()
    {
        return $this->jamSelesai;
    }
}
