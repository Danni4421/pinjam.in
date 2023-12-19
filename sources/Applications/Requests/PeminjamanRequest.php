<?php

use LDAP\Result;

class PeminjamanRequest extends Request
{
  public function request(array $payload)
  {
    $peminjamanRepository = new PeminjamanRepository(new MySQL());
    $userRepository = new UserRepository(new MySQL());
    $ruangRepository = new RuangKelasRepository(new MySQL());
    $ruangUseCase = new RuangUseCase(
      ruangRepository: $ruangRepository,
    );
    $peminjamanUseCase = new PeminjamanUseCase(
      peminjamanRepository: $peminjamanRepository,
      userRepository: $userRepository,
    );

    if ($payload["method"] == "GET") {
      if ($payload["type"] == "riwayat") {
        if (isset($payload["userId"])) {
          return $this->getRiwayat($peminjamanUseCase, $payload["userId"]);
        }
        return $this->getRiwayat($peminjamanUseCase);
      } elseif ($payload["type"] == "persetujuan") {
        return $this->getOnProcessPeminjaman($peminjamanUseCase);
      } elseif ($payload["type"] == "validate-ruang") {
        return $this->verifyAvailablity($ruangUseCase, $payload);
      } elseif ($payload["type"] == "not-done") {
        return $this->isNotDonePeminjaman($peminjamanUseCase);
      }
    } elseif ($payload["method"] == "DETAIL") {
      return $this->getDetailPeminjaman($peminjamanUseCase, $payload["peminjamanId"]);
    } elseif ($payload["method"] == "VERIFY") {
      $result = $this->verifyAvailablity($ruangUseCase, $payload["data"]);
      return [
        "status" => "success",
        "data" => $result,
      ];
    } elseif ($payload["method"] == "UPDATE") {
      return $this->updatePeminjaman($peminjamanUseCase, $payload["data"]);
    } elseif ($payload["method"] == "DELETE") {
      return $this->deletePeminjaman($peminjamanUseCase, $payload["peminjamanId"]);
    }
  }

  /**
   * Get All Peminjaman
   * 
   * @param PeminjamanUseCase $peminjamanUseCase
   * @return array
   */
  private function getRiwayat($peminjamanUseCase, $userId = null)
  {
    $peminjaman = is_null($userId) ? $peminjamanUseCase->getPeminjaman() : $peminjamanUseCase->getPeminjaman(userId: $userId);
    $list_peminjaman = [];

    foreach ($peminjaman as $p) {
      $list_peminjaman[] = $p->toArray();
    }

    return [
      "status" => "success",
      "data" => $list_peminjaman,
    ];
  }

  /**
   * Get Peminjaman When On Process
   * 
   * @param PeminjamanUseCase $peminjamanUseCase
   * @return array
   */
  private function getOnProcessPeminjaman($peminjamanUseCase)
  {
    $peminjaman = $peminjamanUseCase->getOnProcessPeminjaman();
    $list_peminjaman = [];

    foreach ($peminjaman as $p) {
      $list_peminjaman[] = $p->toArray();
    }

    return [
      "status" => "success",
      "data" => $list_peminjaman,
    ];
  }

  /**
   * Get Detail Peminjaman
   *
   * @param PeminjamanUseCase $peminjamanUseCase
   * @param int $peminjamanId
   * @return array
   */
  private function getDetailPeminjaman($peminjamanUseCase, $peminjamanId)
  {
    $peminjaman = $peminjamanUseCase->getDetailPeminjaman(peminjamanId: $peminjamanId);
    return [
      "status" => "success",
      "data" => $peminjaman->toArray(),
    ];
  }

  /**
   * Update Peminjaman Request
   *
   * @param PeminjamanUseCase $peminjamanUseCase
   * @param array $payload
   * @return array
   */
  private function updatePeminjaman($peminjamanUseCase, $payload)
  {
    $peminjamanUseCase->updatePeminjaman(payload: $payload);

    return [
      "status" => "success",
      "data" => "Berhasil memperbarui kalender peminjaman",
    ];
  }

  /**
   * Delete Peminjaman Request
   *
   * @param PeminjamanUseCase $peminjamanUseCase
   * @param int $peminjamanId
   * @return array
   */
  private function deletePeminjaman($peminjamanUseCase, $peminjamanId)
  {
    $peminjamanUseCase->deletePeminjaman($peminjamanId);

    return [
      "status" => "success",
      "data" => $peminjamanId . "has been deleted"
    ];
  }

  /**
   * Verify Ruang is Available
   *
   * @param RuangUseCase $ruangUseCase
   * @param array $payload
   * @return array
   */
  private function verifyAvailablity($ruangUseCase, $payload)
  {
    return $ruangUseCase->verifyAvailabilityRoom($payload);
  }

  /**
   * Getting Peminjaman That is not done
   *
   * @param PeminjamanUseCase $peminjamanUseCase
   * @return Peminjaman[]
   */
  private function isNotDonePeminjaman($peminjamanUseCase)
  {
    $peminjaman = $peminjamanUseCase->getPeminjamanNotDone();
    $list_peminjaman = [];

    foreach ($peminjaman as $p) {
      $list_peminjaman[] = $p->toArray();
    }

    return [
      "status" => "success",
      "data" => $list_peminjaman,
    ];
  }
}
