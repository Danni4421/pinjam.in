<?php

class JadwalRequest extends Request
{
  public function request(array $payload)
  {
    $jadwalRepository = new JadwalRepository(new MySQL());
    $jadwalUseCase = new JadwalUseCase(jadwalRepository: $jadwalRepository);

    if ($payload["method"] == "ADD") {
      return $this->addJadwal(jadwalUseCase: $jadwalUseCase, data: $payload["data"]);
    } elseif ($payload["method"] == "GET") {
      if ($payload["type"] == "ruang") {
        return $this->getByRuang(jadwalUseCase: $jadwalUseCase, kodeRuang: $payload["kode_ruang"]);
      } elseif ($payload["type"] == "detail") {
        return $this->getDetailJadwal(jadwalUseCase: $jadwalUseCase, jadwalId: $payload["jadwal_id"]);
      }
    } elseif ($payload["method"] == "VERIFY") {
      return $this->verifyAvailabilityJadwal(jadwalUseCase: $jadwalUseCase, data: $payload["data"]);
    } elseif ($payload["method"] == "UPDATE") {
      return $this->updateJadwal(jadwalUseCase: $jadwalUseCase, data: $payload["data"]);
    } elseif ($payload["method"] == "DELETE") {
      return $this->deleteJadwal(jadwalUseCase: $jadwalUseCase, jadwalId: $payload["jadwal_id"]);
    }
  }

  /**
   * @param JadwalUseCase $jadwalUseCase
   * @param array $data
   * @return array
   */
  function addJadwal($jadwalUseCase, $data)
  {
    $jadwalUseCase->addJadwal(payload: $data);

    return [
      "status" => "success",
      "data" => "Berhasil menambahkan jadwal"
    ];
  }

  /**
   * @param JadwalUseCase $jadwalUseCase
   * @param string $kodeRuang
   * @return array
   */
  function getByRuang($jadwalUseCase, $kodeRuang)
  {
    $jadwals = $jadwalUseCase->getJadwalByRuang(kodeRuang: $kodeRuang);
    $list_jadwal = [];

    foreach ($jadwals as $jadwal) {
      $list_jadwal[] = $jadwal->toArray();
    }

    return [
      "status" => "success",
      "data" => $list_jadwal
    ];
  }

  /**
   * @param JadwalUseCase $jadwalUseCase
   * @param int $jadwalId
   * @return array
   */
  function getDetailJadwal($jadwalUseCase, $jadwalId)
  {
    $jadwal = $jadwalUseCase->getJadwalDetailById(jadwalId: $jadwalId);

    return [
      "status" => "success",
      "data" => $jadwal->toArray(),
    ];
  }

  /**
   * @param JadwalUseCase $jadwalUseCase
   * @param array $data
   * @return array
   */
  function updateJadwal($jadwalUseCase, $data)
  {
    $jadwalUseCase->updateJadwal(payload: $data);

    return [
      "status" => "success",
      "data" => "Berhasil memperbarui jadwal"
    ];
  }

  /**
   * @param JadwalUseCase $jadwalUseCase
   * @param int $jadwalId
   * @return array 
   */
  function deleteJadwal($jadwalUseCase, $jadwalId)
  {
    $jadwalUseCase->deleteJadwal(jadwalId: $jadwalId);

    return [
      "status" => "success",
      "data" => "Berhasil menghapus jadwal"
    ];
  }

  /**
   * @param JadwalUseCase $jadwalUseCase
   * @param array $data
   * @return array
   */
  function verifyAvailabilityJadwal($jadwalUseCase, $data)
  {
    $result = $jadwalUseCase->verifyJadwal(payload: $data);

    return [
      "status" => "success",
      "data" => $result
    ];
  }
}
