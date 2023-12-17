<?php

class GetDetailDosenRequest extends Request
{
  public function request(array $payload)
  {
    $dosenRepository = new DosenRepository(new MySQL());
    $userUseCase = new UserUseCase($dosenRepository);

    $dosen = $userUseCase->getUserById([
      "user_id" => $payload["userId"]
    ]);

    if ($dosen instanceof Dosen) {
      $dosen = $dosen->toArray();
    }

    return [
      "status" => "success",
      "data" => $dosen,
    ];
  }
}
