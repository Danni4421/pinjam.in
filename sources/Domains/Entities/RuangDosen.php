<?php

class RuangDosen extends Ruang
{

    /** @var Dosen[] */
    private $dosen;

    /**
     * @param string $kodeRuang
     * @param string $namaRuang
     * @param int $kapasitas
     * @param int $lantai
     * @param Dosen[] $dosen
     */
    public function __construct($kodeRuang, $namaRuang, $kapasitas, $lantai, $dosen)
    {
        parent::__construct(
            kodeRuang: $kodeRuang,
            namaRuang: $namaRuang,
            kapasitas: $kapasitas,
            lantai: $lantai
        );

        $this->dosen = $dosen;
    }

    public function getDosen()
    {
        return $this->dosen;
    }

    public function toJSON()
    {
        $lectures = [];
        $lecture = $this->getDosen();

        if (!empty($lecture)) {
            foreach ($lecture as $lc) {
                $lectures[] = [
                    "id" => $lc->getId(),
                    "username" => $lc->getUsername(),
                    "email" => $lc->getEmail(),
                    "role" => $lc->getRole(),
                    "nip" => $lc->getUserDetails()->getNomorInduk(),
                    "namaLengkap" => $lc->getUserDetails()->getNamaLengkap(),
                    "alamat" => $lc->getUserDetails()->getAlamat(),
                    "noTelp" => $lc->getUserDetails()->getNoTelp(),
                    "fotoProfil" => $lc->getUserDetails()->getFotoProfil(),
                ];
            }
        }

        return [
            "kodeRuang" => $this->getKodeRuang(),
            "namaRuang" => $this->getNamaRuang(),
            "kapasitas" => $this->getKapasitas(),
            "lantai" => $this->getLantai(),
            "fasilitas" => $this->getFasilitas(),
            "dosen" => $lectures
        ];
    }
}
