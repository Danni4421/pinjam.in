<?php

class RegisterUseCase implements UseCase
{
    private UserRepository  $userReopsitory;
    private array $payload;

    /**
     * @param UserRepository $userRepository
     * @param array $payload
     */
    public function __construct($userRepository, $payload)
    {
        $this->userReopsitory = $userRepository;
        $this->payload = Input::anti_injection($payload);
    }

    public function run()
    {
        if ($this->userReopsitory->verifyAvailableEmail($this->payload["email"])) {
            $unique_username = time() . "-" . $this->payload["username"];
            $hashed_password = Password::hash($this->payload["password"]);
            $salt = Password::get_salt();

            $userId = $this->userReopsitory->add(new User(
                id: 0,
                username: $unique_username,
                email: $this->payload["email"],
                password: $hashed_password,
                salt: $salt,
                role: 'user'
            ));

            if ($this->userReopsitory instanceof DosenRepository) {
                $this->userReopsitory->addDetails(
                    userId: $userId,
                    userDetails: new UserDetails(
                        nomorInduk: $this->payload["nomor_induk"],
                        namaLengkap: $this->payload["nama_lengkap"],
                        alamat: $this->payload["alamat"],
                        noTelp: $this->payload["no_telp"],
                        fotoProfil: $this->payload["fotoProfil"],
                        kodeRuang: $this->payload["kodeRuang"],
                        isDosen: 1,
                    ),
                );
            }
        }
    }
}
