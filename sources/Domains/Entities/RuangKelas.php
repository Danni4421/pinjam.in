<?php

class RuangKelas extends Ruang
{
    /** @var ?Jadwal[] */
    private $jadwal;

    /**
     * @param string $kodeRuang
     * @param ?string $namaRuang
     * @param ?int $kapasitas
     * @param ?int $lantai
     * @param ?string $fotoRuang
     * @param ?Fasilitas[] $fasilitas
     * @param ?Jadwal[] $jadwal
     * @param bool $isRuangDosen
     */
    public function __construct($kodeRuang, $namaRuang = null, $kapasitas = null, $lantai = null, $jadwal = [], $fotoRuang = null, $fasilitas = null, $isRuangDosen = false)
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

        $this->jadwal = $jadwal;
    }

    public function getJadwal()
    {
        return $this->jadwal;
    }

    /**
     * @param Jadwal[] $jadwal
     */
    public function setJadwal($jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function toArray()
    {
        $jadwals = [];
        $jadwal = $this->getJadwal();


        if (!empty($jadwal)) {
            foreach ($jadwal as $jd) {
                $jadwals[] = [
                    "jadwalId" => $jd->getJadwalId(),
                    "hari" => $jd->getHari(),
                    "mataKuliah" => [
                        "mkId" => $jd->getMataKuliah()->getMkId(),
                        "namaMk" => $jd->getMataKuliah()->getNamaMk(),
                        "sks" => $jd->getMataKuliah()->getSks()
                    ],
                    "jamMulai" => $jd->getJamMulai()->getJkId(),
                    "jamSelesai" => $jd->getJamSelesai()->getJkId(),
                ];
            }
        }

        return [
            "kodeRuang" => $this->getKodeRuang(),
            "namaRuang" => $this->getNamaRuang(),
            "kapasitas" => $this->getKapasitas(),
            "lantai" => $this->getLantai(),
            "fotoRuang" => ImageManagerHelper::get(is_null($this->getFotoRuang()) ? "" : $this->getFotoRuang(), "ruang-kelas"),
            "fasilitas" => $this->getFasilitas(),
            "jadwal" => $jadwals,
            "isRuangDosen" => $this->getIsRuangDosen()
        ];
    }
}
