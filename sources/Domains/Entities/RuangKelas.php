<?php

class RuangKelas extends Ruang
{
    /** @var Jadwal[] */
    private $jadwal;

    /**
     * @param string $kodeRuang
     * @param string $namaRuang
     * @param int $kapasitas
     * @param int $lantai
     * @param Jadwal[] $dosen
     */
    public function __construct($kodeRuang, $namaRuang, $kapasitas, $lantai, $jadwal)
    {
        parent::__construct(
            kodeRuang: $kodeRuang,
            namaRuang: $namaRuang,
            kapasitas: $kapasitas,
            lantai: $lantai
        );

        $this->jadwal = $jadwal;
    }

    public function getJadwal()
    {
        return $this->jadwal;
    }

    public function toJSON()
    {
        $jadwals = [];
        $jadwal = $this->getJadwal();


        if (!empty($jadwal)) {
            foreach ($jadwal as $jd) {
                $jadwal[] = [
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
            "fasilitas" => $this->getFasilitas(),
            "jadwal" => $jadwal
        ];
    }
}
