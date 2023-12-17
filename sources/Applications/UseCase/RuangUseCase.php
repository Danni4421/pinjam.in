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
     * @param array $payload
     * @return void
     */
    public function addDosenToRuangDosen($payload)
    {
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
     * Get Ruang By Capacity
     *
     * @param int $amount
     * @return RuangKelas[]
     */
    public function getRuangByCapacity($amount)
    {
        if ($this->ruangRepository instanceof RuangKelasRepository) {
            return $this->ruangRepository->getRuangTeoriByCapacity(amount: $amount);
        }

        return [];
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

    /**
     * Verify Availability of Room
     * @param array $payload
     * @return array
     */
    public function verifyAvailabilityRoom($payload)
    {
        $tanggalMulai = new DateTime($payload["tanggalKegiatanMulai"]);
        $tanggalSelesai = new DateTime($payload["tanggalKegiatanSelesai"]);
        $jamMulai = new DateTime($payload["jamMulai"]);
        $jamSelesai = new DateTime($payload["jamSelesai"]);
        $tanggalSelesai->add(new DateInterval('P1D'));
        $dateInterval = new DateInterval('P1D');
        $datePeriode = new DatePeriod($tanggalMulai, $dateInterval, $tanggalSelesai);

        $availableRuang = [
            "error" => false,
            "data" => []
        ];
        foreach ($datePeriode as $date) {
            $dayOfWeek = (int) $date->format("N");
            $isWeekend = ($dayOfWeek == 6 || $dayOfWeek == 7);

            foreach ($payload["ruang"] as $ruang) {
                if (
                    ($isWeekend && $jamMulai <= $jamSelesai) ||
                    (!$isWeekend && $jamMulai <= $jamSelesai && $jamMulai >= new DateTime("18:00:00"))
                ) {
                    $result = $this->ruangRepository->verifyIsRuangAvailable(
                        kodeRuang: $ruang,
                        tanggalKegiatan: $date->format('Y-m-d'),
                        jamMulai: $jamMulai->format("H:i:s"),
                        jamSelesai: $jamSelesai->format("H:i:s")
                    );

                    if ($result) {
                        $availableRuang["data"][$ruang] = true;
                    } else {
                        $availableRuang["error"] = true;
                        $availableRuang["data"][$ruang] = false;
                    }
                } else {
                    return [
                        "error" => true,
                        "data" => null
                    ];
                }
            }
        }

        return $availableRuang;
    }
}
