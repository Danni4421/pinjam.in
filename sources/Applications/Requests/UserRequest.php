<?php

class UserRequest extends Request
{
  public function request(array $payload)
  {
    $userRepository = new UserRepository(new MySQL());
    $ruangRepository = new RuangDosenRepository(new MySQL());
    $userUseCase = new UserUseCase(userRepository: $userRepository);
    $ruangUseCase = new RuangUseCase(ruangRepository: $ruangRepository);

    if ($payload["method"] == "ADD") {
      if ($payload["type"] == "user") {

      } elseif ($payload["type"] == "dosen") {

      }
    } elseif ($payload["method"] == "GET") {
      if ($payload["type"] == "all") {
        return $this->getAllUser($userUseCase);
      }
      return $this->getUserById($userUseCase, $payload["userId"]);
    } elseif ($payload["method"] == "DELETE") {
      return $this->deleteUser($userUseCase, $ruangUseCase, $payload);
    }
  }

  /**
   * Get All Detail of User
   *
   * @param UserUseCase $userUseCase
   * @return array
   */
  private function getAllUser($userUseCase)
  {
    $users = $userUseCase->getUsers();
    $list_users = [];

    foreach ($users as $user) {
      $list_users[] = [
        "userId" => $user->getId(),
        "fotoProfil" => ImageManagerHelper::get(
          is_null($user->getUserDetails()->getFotoProfil()) ? "" :
            $user->getUserDetails()->getFotoProfil(),
          "profile"
        ),
        "nomorInduk" => $user->getUserDetails()->getNomorInduk(),
        "email" => $user->getEmail(),
        "namaLengkap" => $user->getUserDetails()->getNamaLengkap(),
        "alamat" => $user->getUserDetails()->getAlamat(),
        "noTelp" => $user->getUserDetails()->getNoTelp(),
      ];
    }

    return [
      "status" => "success",
      "data" => $list_users
    ];
  }

  /**
   * Get Detail User By Id
   *
   * @param UserUseCase $userUseCase
   * @param array $payload
   * @return array
   */
  private function getUserById($userUseCase, $userId)
  {
    $user = $userUseCase->getUserById([
      "user_id" => $userId
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
        "kodeRuang" => $user->getUserDetails()->getKodeRuang(),
      ],
    ];
  }

  /**
   * Delete User
   *
   * @param UserUseCase $userUseCase
   * @param RuangUseCase $ruangUseCase
   * @param int $userId
   * @return array
   */
  private function deleteUser($userUseCase, $ruangUseCase, $payload)
  {
    $userUseCase->deleteUser($payload["userId"]);

    $result = [];
    if (isset($payload["kodeRuang"])) {
      $result = $ruangUseCase->getRuanganById($payload["kodeRuang"]);
      $result = $result->toArray();
    }

    return [
      "status" => "success",
      "data" => $result,
    ];
  }
}
