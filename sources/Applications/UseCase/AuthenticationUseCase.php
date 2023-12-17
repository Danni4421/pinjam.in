<?php

class AuthenticationUseCase
{
    private AuthenticationRepository $authenticationRepository;
    private UserRepository $userRepository;

    /**
     * @param AuthenticationRepository $authenticationRepository
     * @param UserRepository $userRepository
     */
    public function __construct($authenticationRepository, $userRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $payload
     */
    public function login($payload)
    {
        $payload = Input::anti_injection(payload: $payload);

        if ($this->authenticationRepository->verifyEmailIsExists(email: $payload["email"])) {
            if ($userId = $this->authenticationRepository->verifyPassword(
                email: $payload["email"],
                password: $payload["password"]
            )) {
                $user = $this->userRepository->getById(userId: $userId);

                Auth::setAuth(id: $userId, payload: [
                    "username" => $user->getUsername(),
                    "level" => $user->getRole()
                ]);

                return [
                    "status" => "success",
                    "data" => $user->getRole(),
                ];
            } else {
                return [
                    "status" => "fail",
                    "message" => "Password tidak valid."
                ];
            }
        } else {
            return [
                "status" => "fail",
                "message" => "Email tidak terdaftar."
            ];
        }
    }
}
