<?php

class Fasilitas
{
    private int $fasilitasId;
    private string $namaFasilitas;
    private ?string $icon;
    private string $status;

    /**
     * @param int $fasilitasId
     * @param string $namaFasilitas
     * @param ?string $icon
     * @param string $status
     */
    public function __construct($fasilitasId, $namaFasilitas, $icon = null, $status)
    {
        $this->fasilitasId = $fasilitasId;
        $this->namaFasilitas = $namaFasilitas;
        $this->icon = $icon;
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

    public function getIcon()
    {
        return $this->icon;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
