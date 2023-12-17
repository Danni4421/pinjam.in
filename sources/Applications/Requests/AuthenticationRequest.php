<?php 

class AuthenticationRequest extends Request {
  public function request(array $payload)
  {
    $authenticationRepository = new AuthenticationRepository(new MySQL);
    $userRepository = new UserRepository(new MySQL);
    $userUseCase = new UserUseCase($userRepository);
    $authentnicationUseCase = new AuthenticationUseCase(
      authenticationRepository: $authenticationRepository,
      userRepository: $userRepository
    );

    $message = "";

    if ($payload["type"] == "login") {
      $message = $authentnicationUseCase->login(payload: $payload["data"]);
    } elseif ($payload["type"] == "register") {
      $userUseCase->register(
        payload: $payload["data"]
      );
    }

    return [
      "status" => "success",
      "data" => $message,
    ];
  }
}

?>