<?php

class JamKuliahRequest extends Request
{
  public function request(array $payload)
  {
    $jamKuliahRepository = new JamKuliahRepository(new MySQL());
    $jamKuliahUseCase = new JamKuliahUseCase(jamKuliahRepository: $jamKuliahRepository);

    if ($payload["method"] == "ADD") {
      $result = $jamKuliahUseCase->addJamKuliah($payload["data"]);

      if ($result["status"] == "fail") {
        return [
          "status" => "success",
          "data" => [
            "error" => true,
            "message" => $result["message"]
          ]
        ];
      }

      return [
        "status" => "success",
        "data" => "berhasil menambah jam kuliah"
      ];
    } elseif ($payload["method"] == "GET") {
      $jamKuliah = $jamKuliahUseCase->getJamKuliah();
      $list_jam_kuliah = [];

      foreach ($jamKuliah as $jk) {
        $list_jam_kuliah[] = [
          "jkId" => $jk->getJkId(),
          "jamMulai" => $jk->getJamMulai()->format("H:i:00"),
          "jamSelesai" => $jk->getJamSelesai()->format("H:i:00")
        ];
      }

      return [
        "status" => "success",
        "data" => $list_jam_kuliah
      ];
    } elseif ($payload["method"] == "DETAIL") {
      $jamKuliah = $jamKuliahUseCase->getJamKuliahById($payload["jkId"]);

      return [
        "status" => "success",
        "data" => [
          "jkId" => $jamKuliah->getJkId(),
          "jamMulai" => $jamKuliah->getJamMulai()->format("H:i:00"),
          "jamSelesai" => $jamKuliah->getJamSelesai()->format("H:i:00")
        ]
      ];
    } elseif ($payload["method"] == "UPDATE") {
      $jamKuliahUseCase->updateJamKuliah(
        jkId: $payload["jkId"],
        payload: $payload["data"]
      );

      return [
        "status" => "success",
        "data" => "Berhasil memperbarui jam kuliah"
      ];
    } elseif ($payload["method"] == "DELETE") {
      $jamKuliahUseCase->deleteJamKuliah(jkId: $payload["jkId"]);

      return [
        "status" => "success",
        "data" => "Berhasil menghapus jam kuliah"
      ];
    }
  }
}
