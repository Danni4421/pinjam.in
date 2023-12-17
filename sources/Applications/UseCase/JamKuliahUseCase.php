<?php

class JamKuliahUseCase
{
  private JamKuliahRepository $jamKuliahRepository;

  /**
   * @param JamKuliahRepository $jamKuliahRepository
   */
  public function __construct($jamKuliahRepository)
  {
    $this->jamKuliahRepository = $jamKuliahRepository;
  }

  /**
   * Add Jam Kuliah
   *
   * @param array $payload
   * @return array
   */
  public function addJamKuliah($payload)
  {
    if ($this->jamKuliahRepository->verifyJamKuliahIsExists($payload["jkId"])) {
      $this->jamKuliahRepository->add(
        jamKuliah: new JamKuliah(
          jkId: (int) $payload["jkId"],
          jamMulai: new DateTime($payload["jam_mulai"]),
          jamSelesai: new DateTime($payload["jam_selesai"])
        ),
      );

      return [
        "status" => "success",
        "message" => "Berhasil menambahkan jam kuliah"
      ];
    } else {
      return [
        "status" => "fail",
        "message" => "Jam Kuliah Sudah Ada!"
      ];
    }
  }

  /**
   * Get Jam Kuliah
   *
   * @return JamKuliah[]
   */
  public function getJamKuliah()
  {
    return $this->jamKuliahRepository->get();
  }

  /**
   * Get Detail Jam Kuliah
   *
   * @param int $jkId
   * @return JamKuliah
   */
  public function getJamKuliahById($jkId)
  {
    return $this->jamKuliahRepository->getById($jkId);
  }

  /**
   * Update Jam Kuliah
   *
   * @param int $jkId
   * @param array $payload
   * @return void
   */
  public function updateJamKuliah($jkId, $payload)
  {
    $this->jamKuliahRepository->update(
      jamKuliah: new JamKuliah(
        jkId: (int) $jkId,
        jamMulai: new DateTime($payload["jam_mulai"]),
        jamSelesai: new DateTime($payload["jam_selesai"])
      ),
    );
  }

  /**
   * Delete Jam Kuliah
   * @param int $jkId
   * @return void
   */
  public function deleteJamKuliah($jkId)
  {
    $this->jamKuliahRepository->delete(
      jkId: $jkId
    );
  }
}
