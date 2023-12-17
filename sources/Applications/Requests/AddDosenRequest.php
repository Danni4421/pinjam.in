<?php

class AddDosenRequest extends Request
{
  public function request(array $payload)
  {
    $ruangDosenRepository = new RuangDosenRepository(new MySQL());
    $dosenRepository = new DosenRepository(new MySQL());

    $ruangUseCase = new RuangUseCase(ruangRepository: $ruangDosenRepository);
    $userUseCase = new UserUseCase(userRepository: $dosenRepository);

    $baseUrl = "assets/dist/images/uploads/profiles/";
    if (isset($_FILES["payload"])) {
      $baseUrl .= time() . $_FILES["payload"]["name"]["file"];
      move_uploaded_file($_FILES["payload"]["tmp_name"]["file"], $baseUrl);
    } else {
      $baseUrl = null;
    }

    $result = $userUseCase->register(payload: [
      "username" => $payload["nomor_induk"],
      "email" => $payload["email"],
      "password" => $payload["nomor_induk"],
      "nomor_induk" => $payload["nomor_induk"],
      "nama_lengkap" => $payload["nama_lengkap"],
      "alamat" => $payload["alamat"],
      "no_telp" => $payload["no_telp"],
      "foto_profil" => $baseUrl,
      "kode_ruang" => $payload["kode_ruang"]
    ]);


    if ($result["status"] == "fail") {
      return [
        "status" => "success",
        "data" => [
          "errorMessage"  => $result["message"]
        ],
      ];
    } else {
      $updatedRuang = $ruangUseCase->getRuanganById($payload["kode_ruang"]);

      return [
        "status" => "success",
        "data" => $updatedRuang->toArray(),
      ];
    }
  }
}
