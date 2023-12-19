<?php

class JadwalUseCase
{
  private JadwalRepository $jadwalRepository;

  /**
   * @param JadwalRepository $jadwalRepository
   */
  public function __construct($jadwalRepository)
  {
    $this->jadwalRepository = $jadwalRepository;
  }

  /**
   * @param array $payload
   * @return void
   */
  public function addJadwal($payload)
  {
    $this->jadwalRepository->add(jadwal: $payload);
  }

  /**
   * @param string $kodeRuang
   * @return Ruang[]
   */
  public function getJadwalByRuang($kodeRuang)
  {
    return $this->jadwalRepository->getByRuang(kodeRuang: $kodeRuang);
  }

  /**
   * @param int $jadwalId
   * @return Jadwal
   */
  public function getJadwalDetailById($jadwalId)
  {
    return $this->jadwalRepository->getById(jadwalId: $jadwalId);
  }

  /**
   * @param array $payload
   * @return array
   */
  public function verifyJadwal($payload)
  {
    $result = $this->jadwalRepository->verifyAvailabilityJadwal(
      kodeRuang: $payload["kode_ruang"],
      hari: (int) $payload["hari"],
      jamMulai: (int) $payload["jam_mulai"],
      jamSelesai: (int) $payload["jam_selesai"],
    );

    if ($result) {
      return [
        "error" => false,
        "message" => "Jadwal bisa digunakan."
      ];
    } else {
      return [
        "error" => true,
        "message" => "Jadwal tidak bisa digunakan."
      ];
    }
  }

  /**
   * @param array $payload
   * @return void
   */
  public function updateJadwal($payload)
  {
    $this->jadwalRepository->update(
      jadwal: new Jadwal(
        jadwalId: $payload["jadwal_id"],
        hari: $payload["hari"],
        mataKuliah: new MataKuliah(
          mkId: $payload["mata_kuliah"]
        ),
        jamMulai: new JamKuliah(
          jkId: $payload["jam_mulai"]
        ),
        jamSelesai: new JamKuliah(
          jkId: $payload["jam_selesai"]
        )
      ),
    );
  }

  /**
   * @param int $jadwalId
   * @return void
   */
  public function deleteJadwal($jadwalId)
  {
  }
}
