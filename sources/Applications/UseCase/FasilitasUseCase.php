<?php

class FasilitasUseCase
{

  private FasilitasRepository $fasilitasRepository;

  /**
   * @param FasilitasRepository $fasilitasRepository
   */
  public function __construct($fasilitasRepository)
  {
    $this->fasilitasRepository = $fasilitasRepository;
  }

  /**
   * @param array $payload
   * @return void
   */
  public function addFasilitas($payload)
  {
    $this->fasilitasRepository->add(
      fasilitas: new Fasilitas(
        fasilitasId: 0,
        namaFasilitas: $payload["nama_fasilitas"],
        icon: $payload["icon"],
        status: ""
      ),
    );
  }

  public function addFasilitasToRuang($payload)
  {
    foreach ($payload["fasilitas"] as $fasilitas) {
      $this->fasilitasRepository->addIntoRuang(fasilitasId: $fasilitas, kodeRuang: $payload["kode_ruang"]);
    }
  }

  /**
   * @return array
   */
  public function getAllFasilitas()
  {
    $fasilitas = $this->fasilitasRepository->get();
    $list_fasilitas = [];

    foreach ($fasilitas as $facility) {
      $list_fasilitas[] = [
        "fasilitasId" => $facility->getFasilitasId(),
        "namaFasilitas" => $facility->getNamaFasilitas(),
        "icon" => $facility->getIcon()
      ];
    }

    return $list_fasilitas;
  }

  /**
   * @param string $kodeRuang
   * @return array
   */
  public function getFasilitasByRuang($kodeRuang)
  {
    $fasilitas = $this->fasilitasRepository->getByRuang($kodeRuang);
    $list_fasilitas = [];

    foreach ($fasilitas as $f) {
      $list_fasilitas[] = [
        "fasilitasId" => $f->getFasilitasId(),
        "namaFasilitas" => $f->getNamaFasilitas(),
        "icon" => $f->getIcon(),
        "status" => $f->getStatus()
      ];
    }

    return $list_fasilitas;
  }

  /**
   * @param int $fasilitasId
   * @return array
   */
  public function getFasilitasById($fasilitasId)
  {
    $fasilitas = $this->fasilitasRepository->getById($fasilitasId);

    return [
      "fasilitasId" => $fasilitas->getFasilitasId(),
      "namaFasilitas" => $fasilitas->getNamaFasilitas(),
    ];
  }

  /**
   * @param int $fasilitasId
   * @param array $payload
   * @return void
   */
  public function updateFasilitas($fasilitasId, $payload)
  {
    $this->fasilitasRepository->update(
      fasilitas: new Fasilitas(
        fasilitasId: $fasilitasId,
        namaFasilitas: $payload["nama_fasilitas"],
        icon: $payload["icon"],
        status: ""
      ),
    );
  }

  /**
   * @param int $fasilitasId
   * @return void
   */
  public function deleteFasilitas($fasilitasId)
  {
    $this->fasilitasRepository->delete(fasilitasId: $fasilitasId);
  }

  public function deleteFasilitasByRuang($kodeRuang, $fasilitasId)
  {
    $this->fasilitasRepository->deleteByRuang(kodeRuang: $kodeRuang, fasilitasId: $fasilitasId);
  }
}
