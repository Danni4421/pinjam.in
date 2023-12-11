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

                switch ($user->getRole()) {
                    case "user":
                        header("Location: /");
                        break;
                    case "admin" || "superadmin":
                        header("Location: /admin");
                        break;
                }
            } else {
                MessageHelper::message("Gagal", "danger", "Password Anda Tidak Valid!");
            }
        } else {
            MessageHelper::message("Gagal", "danger", "Email Anda Tidak Terdaftar!");
        }
    }
}
