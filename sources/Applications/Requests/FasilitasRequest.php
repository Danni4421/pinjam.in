<?php

class FasilitasRequest extends Request
{
  public function request(array $payload)
  {
    $fasilitasRepository = new FasilitasRepository(new MySQL());
    $fasilitasUseCase = new FasilitasUseCase(fasilitasRepository: $fasilitasRepository);

    if ($payload["type"] == "add") {
      $fasilitasUseCase->addFasilitas($payload["data"]);

      return [
        "status" => "success",
        "data" => "berhasil menambah fasilitas"
      ];
    } elseif ($payload["type"] == "get") {
      $fasilitas = $fasilitasUseCase->getAllFasilitas();

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
        "data" => "berhasil update"
      ];
    } elseif ($payload["type"] == "delete") {
      $fasilitasUseCase->deleteFasilitas(fasilitasId: $payload["fasilitas_id"]);

      return [
        "status" => "success",
        "data" => "berhasil delete"
      ];
    }
  }
}
