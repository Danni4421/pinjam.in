<?php

abstract class Ruang implements HasRequest
{
    protected ?string $kodeRuang;
    protected ?string $namaRuang;
    protected ?int $kapasitas;
    protected ?int $lantai;

    /** @var ?Fasilitas[] */
    protected $fasilitas;
    protected ?string $fotoRuang;
    private bool $isRuangDosen;

    /**
     * @param ?string $kodeRuang
     * @param ?string $namaRuang
     * @param ?int $kapasitas
     * @param ?int $lantai
     * @param ?string $fotoRuang
     * @param ?Fasilitas[] $fasilitas 
     * @param bool $isRuangDosen
     */
    public function __construct($kodeRuang, $namaRuang = null, $kapasitas = null, $lantai = null, $fotoRuang = null, $fasilitas = null, $isRuangDosen = false)
    {
        $this->kodeRuang = $kodeRuang;
        $this->namaRuang = $namaRuang;
        $this->kapasitas = $kapasitas;
        $this->lantai = $lantai;
        $this->fotoRuang = $fotoRuang;
        $this->fasilitas = $fasilitas;
        $this->isRuangDosen = $isRuangDosen;
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

    public function getFotoRuang()
    {
        return $this->fotoRuang;
    }

    public function getFasilitas()
    {
        $fasilities = [];

        if (!empty($this->fasilitas)) {
            foreach ($this->fasilitas as $fasilitas) {
                $fasilities[] = [
                    "fasilitasId" => $fasilitas->getFasilitasId(),
                    "namaFasilitas" => $fasilitas->getNamaFasilitas(),
                    "icon" => $fasilitas->getIcon(),
                    "status" => $fasilitas->getStatus(),
                ];
            }
        }

        return $fasilities;
    }

    public function getIsRuangDosen()
    {
        return $this->isRuangDosen;
    }
}
