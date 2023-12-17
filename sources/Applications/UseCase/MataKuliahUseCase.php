<?php

class MataKuliahUseCase
{
  private MataKuliahRepository $mataKuliahRepository;

  /**
   * @param MataKuliahRepository $mataKuliahRepository
   */
  public function __construct($mataKuliahRepository)
  {
    $this->mataKuliahRepository = $mataKuliahRepository;
  }

  /**
   * Add Mata Kuliah Use Case
   *
   * @param array $payload
   * @return array
   */
  public function addMataKuliah($payload)
  {
    if ($this->mataKuliahRepository->verifyMataKuliahIsExists($payload["mk_id"])) {
      $this->mataKuliahRepository->add(
        mataKuliah: new MataKuliah(
          mkId: $payload["mk_id"],
          namaMk: $payload["nama_mk"],
          sks: (int) $payload["sks"],
        ),
      );

      return [
        "status" => "success",
        "message" => "Berhasil menambahkan mata kuliah"
      ];
    } else {
      return [
        "status" => "fail",
        "message" => "Kode mata kuliah sudah digunakan!"
      ];
    }
  }

  /**
   * Get All Mata Kuliah
   *
   * @return MataKuliah[]
   */
  public function getMataKuliah()
  {
    return $this->mataKuliahRepository->get();
  }

  /**
   * Get Mata Kuliah Detail
   *
   * @param string $mkId
   * @return MataKuliah
   */
  public function getMataKuliahById($mkId)
  {
    return $this->mataKuliahRepository->getById(mkId: $mkId);
  }

  public function updateMataKuliah($mkId, $payload)
  {
    $this->mataKuliahRepository->update(
      mataKuliah: new MataKuliah(
        mkId: $mkId,
        namaMk: $payload["namaMk"],
        sks: (int) $payload["sks"]
      ),
    );
  }

  public function deleteMataKuliah($mkId)
  {
    $this->mataKuliahRepository->delete(mkId: $mkId);
  }
}
