<?php

class RuangRequest extends Request
{
  public function request(array $payload)
  {
    $ruangKelasRepository = new RuangKelasRepository(new MySQL());
    $ruangDosenRepository = new RuangDosenRepository(new MySQL());
    $ruangKelasUseCase = new RuangUseCase(ruangRepository: $ruangKelasRepository);
    $ruangDosenUseCase = new RuangUseCase(ruangRepository: $ruangDosenRepository);

    if ($payload["method"] == "GET") {
      if ($payload["type"] == "all") {
        return $this->getAllRuang(
          ruangKelasUseCase: $ruangKelasUseCase,
          ruangDosenUseCase: $ruangDosenUseCase
        );
      } elseif ($payload["type"] == "rd") {
        return $this->getRuang($ruangDosenUseCase);
      } elseif ($payload["type"] == "rk") {
        if (isset($payload["amount"])) {
          $amount = $payload["amount"];
          return $this->getRuangByCapacity(ruangUseCase: $ruangKelasUseCase, amount: $amount);
        }
        return $this->getRuang($ruangKelasUseCase);
      }
    } elseif ($payload["method"] == "DETAIL") {
      if ($payload["type"] == "rd") {
        return $this->getDetailRuang($ruangDosenUseCase, $payload["kode_ruang"]);
      } elseif ($payload["type"] == "rk") {
        return $this->getDetailRuang($ruangKelasUseCase, $payload['kode_ruang']);
      }
    } elseif ($payload["method"] == "UPDATE") {
      if ($payload["type"] == "rk") {
        return $this->updateRuang($ruangKelasUseCase, $payload["kode_ruang"], $payload["data"]);
      } elseif ($payload["type"] == "rd") {
        return $this->updateRuang($ruangDosenUseCase, $payload["kode_ruang"], $payload["data"]);
      }
    }
  }

  /**
   * Get All Room Details
   *
   * @param RuangUseCase $ruangKelasUseCase
   * @param RuangUseCase $ruangDosenUseCase
   * @return array
   */
  private function getAllRuang($ruangKelasUseCase, $ruangDosenUseCase)
  {
    $ruangKelas = $ruangKelasUseCase->getRuangan();
    $ruangDosen = $ruangDosenUseCase->getRuangan();

    $list_ruang = [];

    foreach ($ruangKelas as $ruang) {
      $list_ruang[] = $ruang->toArray();
    }

    foreach ($ruangDosen as $ruang) {
      $list_ruang[] = $ruang->toArray();
    }

    return [
      "status" => "success",
      "data" => $list_ruang,
    ];
  }

  /**
   * Get Ruang Kelas only
   *
   * @param RuangUseCase $ruangKelasUseCase
   * @return array
   */
  private function getRuang($ruangUseCase)
  {
    $ruangan = $ruangUseCase->getRuangan();

    $list_ruang = [];

    foreach ($ruangan as $ruang) {
      $list_ruang[] = $ruang->toArray();
    }

    return [
      "status" => "success",
      "data" => $list_ruang,
    ];
  }

  /**
   * Get Ruang By Capacity
   *
   * @param RuangUseCase $ruangUseCase
   * @param int $amount
   * @return array
   */
  private function getRuangByCapacity($ruangUseCase, $amount)
  {
    $ruangan = $ruangUseCase->getRuangByCapacity(amount: $amount);
    $list_ruang = [];

    foreach ($ruangan as $ruang) {
      $list_ruang[] = $ruang->toArray();
    }

    return [
      "status" => "success",
      "data" => $list_ruang,
    ];
  }

  /**
   * Get Detail Specific Room
   *
   * @param RuangUseCase $ruangUseCase
   * @param string $kodeRuang
   * @return array
   */
  private function getDetailRuang($ruangUseCase, $kodeRuang)
  {
    $ruangan = $ruangUseCase->getRuanganById($kodeRuang);
    return [
      "status" => "success",
      "data" => $ruangan->toArray()
    ];
  }

  /**
   * Update Room
   *
   * @param RuangUseCase $ruangUseCase
   * @param string $kodeRuang
   * @param array $data
   * @return array
   */
  private function updateRuang($ruangUseCase, $kodeRuang, $data)
  {
    $ruangUseCase->updateRuang(kodeRuang: $kodeRuang, payload: $data);
    $updatedRuang = $ruangUseCase->getRuanganById($kodeRuang);

    return [
      "status" => "success",
      "data" => $updatedRuang->toArray(),
    ];
  }
}
