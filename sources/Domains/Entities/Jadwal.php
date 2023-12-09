<?php

class Jadwal
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
        switch ($this->hari) {
            case 1:
                return "Minggu";
            case 2:
                return "Senin";
            case 3:
                return "Selasa";
            case 4:
                return "Rabu";
            case 5:
                return "Kamis";
            case 6:
                return "Jumat";
            case 7:
                return "Sabtu";
        }
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
}
