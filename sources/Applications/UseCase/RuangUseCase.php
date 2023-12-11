<?php

class RuangUseCase
{
    private RuangRepository $ruangRepository;

    /**
     * @param RuangRepository $ruangRepository
     */
    public function __construct($ruangRepository)
    {
        $this->ruangRepository = $ruangRepository;
    }

    /**
     * @param array $payload
     * @return void
     */
    public function addRuang($payload)
    {
        if ($this->ruangRepository instanceof RuangKelasRepository) {
            $this->ruangRepository->add(new RuangKelas(
                kodeRuang: $payload["kode_ruang"],
                namaRuang: $payload["nama_ruang"],
                kapasitas: $payload["kapasitas"],
                lantai: $payload["lantai"]
            ));
        } else {
            $this->ruangRepository->add(new RuangDosen(
                kodeRuang: $payload["kode_ruang"],
                namaRuang: $payload["nama_ruang"],
                kapasitas: $payload["kapasitas"],
                lantai: $payload["lantai"]
            ));
        }
    }

    /**
     * @return Ruang[]
     */
    public function getRuangan()
    {
        return $this->ruangRepository->get();
    }

    /**
     * @param string $kodeRuang
     * @return Ruang
     */
    public function getRuanganById($kodeRuang)
    {
        return $this->ruangRepository->getById($kodeRuang);
    }

    /**
     * @param string $searchString
     * @return Ruang[]
     */
    public function searchRuang($searchString)
    {
        return $this->ruangRepository->search($searchString);
    }

    /**
     * @param string $kodeRuang
     * @param array $payload
     * @return void
     */
    public function updateRuang($kodeRuang, $payload)
    {
        if ($this->ruangRepository instanceof RuangKelasRepository) {
            $this->ruangRepository->update(new RuangKelas(
                kodeRuang: $kodeRuang,
                namaRuang: $payload["nama_ruang"],
                kapasitas: $payload["kapasitas"],
                lantai: $payload["lantai"]
            ));
        } else {
            $this->ruangRepository->update(new RuangDosen(
                kodeRuang: $kodeRuang,
                namaRuang: $payload["nama_ruang"],
                kapasitas: $payload["kapasitas"],
                lantai: $payload["lantai"]
            ));
        }
    }

    /**
     * @param string $kodeRuang
     * @return void
     */
    public function deleteRuang($kodeRuang)
    {
        $this->ruangRepository->delete($kodeRuang);
    }
}
