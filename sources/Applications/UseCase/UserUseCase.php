<?php

class UserUseCase
{
    private UserRepository  $userRepository;

    /**
     * @param UserRepository  $userRepository
     */
    public function __construct($userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $payload
     * @return array
     */
    public function register($payload)
    {
        $payload = Input::anti_injection(payload: $payload);

        if ($this->userRepository->verifyAvailableEmail($payload["email"])) {
            $unique_username = time() . "-" . $payload["username"];
            $hashed_password = Password::hash($payload["password"]);
            $salt = Password::get_salt();

            $userId = $this->userRepository->add(new User(
                id: 0,
                username: $unique_username,
                email: $payload["email"],
                password: $hashed_password,
                salt: $salt,
                role: 'user'
            ));


            if ($this->userRepository instanceof DosenRepository) {
                $this->userRepository->addDetails(
                    userId: $userId,
                    userDetails: new UserDetails(
                        nomorInduk: $payload["nomor_induk"],
                        namaLengkap: $payload["nama_lengkap"],
                        alamat: $payload["alamat"],
                        noTelp: $payload["no_telp"],
                        fotoProfil: $payload["foto_profil"],
                        kodeRuang: $payload["kode_ruang"],
                        isDosen: 1,
                    ),
                );
            }

            return [
                "status" => "success",
                "message" => "Berhasil menambahkan user."
            ];
        } else {
            return [
                "status" => "fail",
                "message" => "Email telah digunakan."
            ];
        }
    }

    /**
     * @param string $userId
     * @param array $payload
     * @return void
     */
    private function addUserDetail($userId, $payload)
    {
        $this->userRepository->addDetails(
            userId: $userId,
            userDetails: new UserDetails(
                nomorInduk: $payload["nomor_induk"],
                namaLengkap: $payload["nama_lengkap"],
                alamat: $payload["alamat"],
                noTelp: $payload["no_telp"],
                fotoProfil: $payload["foto_profil"],
            ),
        );
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->userRepository->get();
    }

    /**
     * @param array $payload
     * @return User
     */
    public function getUserById($payload)
    {
        return $this->userRepository->getById($payload["user_id"]);
    }

    public function imageProfileProcess($oldPhoto, $payload)
    {
        if (!empty($payload["foto_profil"]["full_path"])) {
            $piece_ext = explode(".", $payload["foto_profil"]["name"]);
            $extension = end($piece_ext);

            if (ImageManagerHelper::verify(type: $extension, size: $payload["foto_profil"]["size"])) {
                ImageManagerHelper::remove($oldPhoto);
                return ImageManagerHelper::move("profile", $payload["foto_profil"]["name"], "foto_profil");
            }
        } else {
            return $oldPhoto;
        }
    }

    /**
     * @param int $userId
     * @param array $payload
     * @return void
     */
    public function updateUser($userId, $payload)
    {
        $data = Input::anti_injection($payload["data"]);

        foreach ($data as $key => $value) {
            $data[$key] = $value == "-" || empty($value) || is_null($value) ? null : $value;
        }

        if (!$this->userRepository->verifyUserDetailsIsExists($userId)) {
            $this->addUserDetail($userId, $data);
        } else {
            $this->userRepository->update(
                user: new User(
                    id: $userId,
                    userDetails: new UserDetails(
                        nomorInduk: $data["nomor_induk"],
                        namaLengkap: $data["nama_lengkap"],
                        alamat: $data["alamat"],
                        noTelp: $data["no_telp"],
                        fotoProfil: $data["foto_profil"],
                        kodeRuang: $data["kode_ruang"]
                    ),
                ),
            );
            MessageHelper::message("Berhasil", "success", "Memperbarui Informasi Akun!");
        }
    }

    /**
     * @param int $userId
     * @return void
     */
    public function deleteUser($userId)
    {
        $this->userRepository->delete($userId);
    }
}
