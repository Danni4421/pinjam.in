<?php

class MataKuliahRequest extends Request
{
  public function request(array $payload)
  {
    $mataKuliahRepository = new MataKuliahRepository(new MySQL());
    $mataKuliahUseCase = new MataKuliahUseCase(mataKuliahRepository: $mataKuliahRepository);

    if ($payload["method"] == "ADD") {
      $result = $mataKuliahUseCase->addMataKuliah($payload["data"]);

      if ($result["status"] == "fail") {
        return [
          "status" => "success",
          "data" => [
            "error" => true,
            "message" => $result["message"]
          ],
        ];
      }

      return [
        "status" => "success",
        "data" => $result["message"]
      ];
    } elseif ($payload["method"] == "GET") {
      $mataKuliah = $mataKuliahUseCase->getMataKuliah();

      $list_mk = [];

      foreach ($mataKuliah as $mk) {
        $list_mk[] = [
          "mkId" => $mk->getMkId(),
          "namaMk" => $mk->getNamaMk(),
          "sks" => $mk->getSks()
        ];
      }

      return [
        "status" => "success",
        "data" => $list_mk,
      ];
    } elseif ($payload["method"] == "DETAIL") {
      $mataKuliah = $mataKuliahUseCase->getMataKuliahById($payload["mkId"]);

      return [
        "status" => "success",
        "data" => [
          "mkId" => $mataKuliah->getMkId(),
          "namaMk" => $mataKuliah->getNamaMk(),
          "sks" => $mataKuliah->getSks()
        ],
      ];
    } elseif ($payload["method"] == "UPDATE") {
      $mataKuliahUseCase->updateMataKuliah(
        mkId: $payload["data"]["mkId"],
        payload: $payload["data"]
      );

      return [
        "status" => "success",
        "data" => "berhasil update"
      ];
    } elseif ($payload["method"] == "DELETE") {
      $mataKuliahUseCase->deleteMataKuliah(mkId: $payload["mkId"]);

      return [
        "status" => "success",
        "data" => "berhasil delete"
      ];
    }
  }
}
