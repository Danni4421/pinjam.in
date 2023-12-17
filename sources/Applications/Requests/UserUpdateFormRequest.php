<?php

class UserUpdateFormRequest extends Request
{
  public function request(array $payload)
  {
    $userRepository = new UserRepository(new MySQL());
    $ruangRepository = new RuangDosenRepository(new MySQL());

    $userUseCase = new UserUseCase(userRepository: $userRepository);
    $ruangUseCase = new RuangUseCase(ruangRepository: $ruangRepository);

    $baseUrl = "assets/dist/images/uploads/profiles/";
    if (isset($_FILES["payload"])) {
      # delete existing file before insert
      ImageManagerHelper::remove($payload["old_foto_profil"]);

      # insert new foto profil
      $baseUrl .= time() . '-' . $_FILES["payload"]["name"]["file"];
      move_uploaded_file($_FILES["payload"]["tmp_name"]["file"], $baseUrl);
    } elseif (isset($payload["old_foto_profil"])) {
      $baseUrl = $payload["old_foto_profil"];

      if (empty($payload["old_foto_profil"]) || is_null($payload["old_foto_profil"])) {
        $baseUrl = null;
      }
    }

    $userUseCase->updateUser(userId: $payload["userId"], payload: [
      "data" => [
        "nomor_induk" => $payload["nomor_induk"],
        "nama_lengkap" => $payload["nama_lengkap"],
        "alamat" => $payload["alamat"],
        "no_telp" => $payload["no_telp"],
        "foto_profil" => $baseUrl,
        "kode_ruang" => $payload["kode_ruang"]
      ]
    ]);

    $result = [];
    if (isset($payload["is_dosen"]) && $payload["is_dosen"] == "true") {
      $result = $ruangUseCase->getRuanganById($payload["kode_ruang"]);
      $result = $result->toArray();
    }

    return [
      "status" => "success",
      "data" => $result,
    ];
  }
}
