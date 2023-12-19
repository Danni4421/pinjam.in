<?php

class FasilitasRequest extends Request
{
  public function request(array $payload)
  {
    $fasilitasRepository = new FasilitasRepository(new MySQL());
    $fasilitasUseCase = new FasilitasUseCase(fasilitasRepository: $fasilitasRepository);

    if ($payload["type"] == "add") {
      if (isset($payload["data"]["kode_ruang"])) {
        $fasilitasUseCase->addFasilitasToRuang($payload["data"]);

        return [
          "status" => "success",
          "data" => "Berhasil menambahkan fasilitas"
        ];
      }

      $fasilitasUseCase->addFasilitas($payload["data"]);

      return [
        "status" => "success",
        "data" => "Berhasil menambahkan fasilitas"
      ];
    } elseif ($payload["type"] == "get") {
      $fasilitas = $fasilitasUseCase->getAllFasilitas();

      return [
        "status" => "success",
        "data" => $fasilitas
      ];
    } elseif ($payload["type"] == "ruang") {
      $fasilitas = $fasilitasUseCase->getFasilitasByRuang($payload["kode_ruang"]);

      return [
        "status" => "success",
        "data" => $fasilitas
      ];
    } elseif ($payload["type"] == "update") {
      $fasilitasUseCase->updateFasilitas(
        fasilitasId: $payload["fasilitas_id"],
        payload: $payload["data"]
      );

      return [
        "status" => "success",
        "data" => "Berhasil memperbarui fasilitas"
      ];
    } elseif ($payload["type"] == "delete") {
      if (isset($payload["kode_ruang"])) {
        $fasilitasUseCase->deleteFasilitasByRuang(kodeRuang: $payload["kode_ruang"], fasilitasId: $payload["fasilitas_id"]);

        return [
          "status" => "success",
          "data" => "Berhasil menghapus fasilitas"
        ];
      }

      $fasilitasUseCase->deleteFasilitas(fasilitasId: $payload["fasilitas_id"]);

      return [
        "status" => "success",
        "data" => "Berhasil menghapus fasilitas"
      ];
    }
  }
}
