<?php

class Fasilitas
{
    private int $fasilitasId;
    private string $namaFasilitas;
    private string $status;

    /**
     * @param int $fasilitasId
     * @param string $namaFasilitas
     * @param string $status
     */
    public function __construct($fasilitasId, $namaFasilitas, $status)
    {
        $this->fasilitasId = $fasilitasId;
        $this->namaFasilitas = $namaFasilitas;
        $this->status = $status;
    }

    public function getFasilitasId()
    {
        return $this->fasilitasId;
    }

    public function getNamaFasilitas()
    {
        return $this->namaFasilitas;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
