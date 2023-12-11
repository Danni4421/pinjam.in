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
                        fotoProfil: $payload["fotoProfil"],
                        kodeRuang: $payload["kodeRuang"],
                        isDosen: 1,
                    ),
                );
            }

            header("Location: /login");
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

    private function imageProfileProcess($oldPhoto, $payload)
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
        $imagePath = $this->imageProfileProcess($data["old_foto_profil"], $payload["files"]);

        foreach ($data as $key => $value) {
            $data[$key] = $value == "-" ? NULL : $value;
        }

        if (!$this->userRepository->verifyUserDetailsIsExists($userId)) {
            $this->addUserDetail($userId, [...$data, "foto_profil" => $imagePath]);
        } else {
            $this->userRepository->update(
                user: new User(
                    id: $userId,
                    userDetails: new UserDetails(
                        nomorInduk: $data["nomor_induk"],
                        namaLengkap: $data["nama_lengkap"],
                        alamat: $data["alamat"],
                        noTelp: $data["no_telp"],
                        fotoProfil: $imagePath,
                        kodeRuang: $this->userRepository instanceof DosenRepository ? $payload["kode_ruang"] : NULL
                    ),
                ),
            );
            MessageHelper::message("Berhasil", "success", "Memperbarui Informasi Akun!");
        }
    }

    public function deleteUser($userId)
    {
        $this->userRepository->delete($userId);
    }
}
