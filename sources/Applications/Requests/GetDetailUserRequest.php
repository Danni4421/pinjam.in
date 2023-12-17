<?php

class GetDetailUserRequest extends Request
{
  public function request(array $payload)
  {
    $userRepository = new UserRepository(new MySQL());
    $userUseCase = new UserUseCase($userRepository);

    $user = $userUseCase->getUserById([
      "user_id" => $payload["userId"]
    ]);

    return [
      "status" => "success",
      "data" => [
        "id" => $user->getId(),
        "username" => $user->getUsername(),
        "email" => $user->getEmail(),
        "nomorInduk" => $user->getUserDetails()->getNomorInduk(),
        "namaLengkap" => $user->getUserDetails()->getNamaLengkap(),
        "alamat" => $user->getUserDetails()->getAlamat(),
        "noTelp" => $user->getUserDetails()->getNoTelp(),
        "fotoProfil" => ImageManagerHelper::get(
          is_null($user->getUserDetails()->getFotoProfil()) ? "" :
            $user->getUserDetails()->getFotoProfil(),
          "profile"
        ),
      ],
    ];
  }
}
