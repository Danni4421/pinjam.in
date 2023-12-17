<?php

class RuangDosen extends Ruang
{

    /** @var ?Dosen[] */
    private $dosen;

    /**
     * @param string $kodeRuang
     * @param ?string $namaRuang
     * @param ?int $kapasitas
     * @param ?int $lantai
     * @param ?string $fotoRuang
     * @param ?Fasilitas[] $fasilitas
     * @param Dosen[] $dosen
     * @param bool $isRuangDosen
     */
    public function __construct($kodeRuang, $namaRuang = null, $kapasitas = null, $lantai = null, $dosen = [], $fotoRuang = null, $fasilitas = null, $isRuangDosen = true)
    {
        parent::__construct(
            kodeRuang: $kodeRuang,
            namaRuang: $namaRuang,
            kapasitas: $kapasitas,
            lantai: $lantai,
            fotoRuang: $fotoRuang,
            fasilitas: $fasilitas,
            isRuangDosen: $isRuangDosen
        );

        $this->dosen = $dosen;
    }

    public function getDosen()
    {
        return $this->dosen;
    }

    public function toArray()
    {
        $lectures = [];
        $lecture = $this->getDosen();

        if (!empty($lecture)) {
            foreach ($lecture as $lc) {
                $lectures[] = $lc->toArray();
            }
        }

        return [
            "kodeRuang" => $this->getKodeRuang(),
            "namaRuang" => $this->getNamaRuang(),
            "kapasitas" => $this->getKapasitas(),
            "lantai" => $this->getLantai(),
            "fasilitas" => $this->getFasilitas(),
            "fotoRuang" => ImageManagerHelper::get(is_null($this->getFotoRuang()) ? "" : $this->getFotoRuang(), "ruang-dosen"),
            "dosen" => $lectures,
            "isRuangDosen" => $this->getIsRuangDosen()
        ];
    }
}
