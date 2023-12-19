<?php

class Jadwal implements HasRequest
{
    private int $jadwalId;
    private int $hari;
    private MataKuliah $mataKuliah;
    private JamKuliah $jamMulai;
    private JamKuliah $jamSelesai;

    /**
     * @param int $jadwalId
     * @param int $hari
     * @param MataKuliah $mataKuliah
     * @param JamKuliah $jamMulai
     * @param JamKuliah $jamSelesai
     */
    public function __construct($jadwalId, $hari, $mataKuliah, $jamMulai, $jamSelesai)
    {
        $this->jadwalId = $jadwalId;
        $this->hari = $hari;
        $this->mataKuliah = $mataKuliah;
        $this->jamMulai = $jamMulai;
        $this->jamSelesai = $jamSelesai;
    }

    public function getJadwalId()
    {
        return $this->jadwalId;
    }

    public function getHari()
    {
        return $this->hari;
    }

    public function getMataKuliah()
    {
        return $this->mataKuliah;
    }

    public function getJamMulai()
    {
        return $this->jamMulai;
    }

    public function getJamSelesai()
    {
        return $this->jamSelesai;
    }

    public function toArray()
    {
        return [
            "jadwalId" => $this->getJadwalId(),
            "mataKuliah" => [
                "mkId" => $this->getMataKuliah()->getMkId(),
                "namaMk" => $this->getMataKuliah()->getNamaMk(),
                "sks" => $this->getMataKuliah()->getSks(),
            ],
            "hari" => $this->getHari(),
            "jamMulai" => [
                "jkId" => $this->getJamMulai()->getJkId(),
                "jamMulai" => $this->getJamMulai()->getJamMulai()->format("H:i:s"),
                "jamSelesai" => $this->getJamMulai()->getJamSelesai()->format("H:i:s")
            ],
            "jamSelesai" => [
                "jkId" => $this->getJamSelesai()->getJkId(),
                "namaMk" => $this->getJamSelesai()->getJamMulai()->format("H:i:s"),
                "sks" => $this->getJamSelesai()->getJamSelesai()->format("H:i:s")
            ],
        ];
    }
}
