<?php

abstract class Ruang implements HasRequest
{
    protected string $kodeRuang;
    protected string $namaRuang;
    protected int $kapasitas;
    protected int $lantai;

    /** @var Fasilitas[] */
    protected $fasilitas;

    /**
     * @param string $kodeRuang
     * @param string $namaRuang
     * @param int $kapasitas
     * @param int $lantai
     */
    public function __construct($kodeRuang, $namaRuang, $kapasitas, $lantai)
    {
        $this->kodeRuang = $kodeRuang;
        $this->namaRuang = $namaRuang;
        $this->kapasitas = $kapasitas;
        $this->lantai = $lantai;
    }

    public function getKodeRuang()
    {
        return $this->kodeRuang;
    }

    public function getNamaRuang()
    {
        return $this->namaRuang;
    }

    public function getKapasitas()
    {
        return $this->kapasitas;
    }

    public function getLantai()
    {
        return $this->lantai;
    }

    public function getFasilitas()
    {
        $fasilities = [];

        if (!empty($this->fasilitas)) {
            foreach ($this->fasilitas as $fasilitas) {
                $fasilities[] = [
                    "fasilitasId" => $fasilitas->getFasilitasId(),
                    "namaFasilitas" => $fasilitas->getNamaFasilitas(),
                    "status" => $fasilitas->getStatus(),
                ];
            }
        }

        return $fasilities;;
    }
}
