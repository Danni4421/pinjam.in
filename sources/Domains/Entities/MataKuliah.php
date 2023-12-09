<?php

class MataKuliah
{
    private string $mkId;
    private string $namaMk;
    private int $sks;

    /**
     * @param string $mkId
     * @param string $namaMk
     * @param int $sks
     */
    public function __construct($mkId, $namaMk, $sks)
    {
        $this->mkId = $mkId;
        $this->namaMk = $namaMk;
        $this->sks = $sks;
    }

    public function getMkId()
    {
        return $this->mkId;
    }

    public function getNamaMk()
    {
        return $this->namaMk;
    }

    public function getSks()
    {
        return $this->sks;
    }
}
