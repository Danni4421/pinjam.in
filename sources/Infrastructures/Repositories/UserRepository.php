<?php

class UserRepository implements IUserRepository
{
    protected MySQL $database;
    public function __construct(MySQL $database)
    {
        $this->database = $database;
    }

    /**
     * @param User $user
     * @return int
     */
    public function add($user)
    {
        $this->database->query(
            sql: "INSERT INTO users (username, email, password, salt, level)
            VALUES (?, ?, ?, ?, ?)",
            params: [
                $user->getUsername(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getSalt(),
                $user->getRole()
            ]
        );

        return $this->database->get_last_inserted_id();
    }

    /**
     * @param int $userId
     * @param UserDetails $userDetails
     * @return void
     */
    public function addDetails($userId, $userDetails)
    {
        $this->database->query(
            sql: "INSERT INTO userdetails (user_id, nomor_induk, kode_ruang, nama_lengkap, alamat, no_telp, foto_profil, is_dosen)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            params: [
                $userId,
                $userDetails->getNomorInduk(),
                $userDetails->getKodeRuang(),
                $userDetails->getNamaLengkap(),
                $userDetails->getAlamat(),
                $userDetails->getNoTelp(),
                $userDetails->getFotoProfil(),
                $userDetails->verifyIsDosen(),
            ]
        );
    }

    /**
     * @return User[]
     */
    public function get()
    {
        $this->database->query(
            sql: "SELECT
                u.id user_id, u.username, u.email, u.level, 
                ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil
            FROM users u 
            JOIN userdetails ud ON ud.user_id = u.id
            WHERE ud.is_dosen != 1"
        );

        $result = $this->database->result();
        $users = [];

        while ($row = $result->fetch_assoc()) {
            $users[] = new User(
                id: $row["user_id"],
                username: $row["username"],
                email: $row["email"],
                role: $row["level"],
                userDetails: new UserDetails(
                    nomorInduk: $row["nomor_induk"],
                    namaLengkap: $row["nama_lengkap"],
                    alamat: $row["alamat"],
                    noTelp: $row["no_telp"],
                    fotoProfil: $row["fotoProfil"]
                )
            );
        }

        return $users;
    }

    /**
     * @param string $userId
     * @return User
     */
    public function getById($userId)
    {
        $this->database->query(
            sql: "SELECT 
            u.id user_id, u.username, u.email, u.level, 
            ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil
            FROM users u 
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id
            WHERE u.id = ?",
            params: [
                $userId
            ],
        );

        $row = $this->database->result()->fetch_assoc();
        return new User(
            id: $row["user_id"],
            username: $row["username"],
            email: $row["email"],
            role: $row["level"],
            userDetails: new UserDetails(
                nomorInduk: $row["nomor_induk"],
                namaLengkap: $row["nama_lengkap"],
                alamat: $row["alamat"],
                noTelp: $row["no_telp"],
                fotoProfil: $row["foto_profil"],
            )
        );
    }

    /**
     * @param User $user
     * @return void
     */
    public function update($user)
    {
        $userDetails = $user->getUserDetails();
        $query = "UPDATE userdetails SET
        nomor_induk = ?,
        nama_lengkap = ?,
        alamat = ?,
        no_telp = ?,
        foto_profil = ?
        WHERE user_id = ?";

        $this->database->query(
            sql: $query,
            params: [
                $userDetails->getNomorInduk(),
                $userDetails->getNamaLengkap(),
                $userDetails->getAlamat(),
                $userDetails->getNoTelp(),
                $userDetails->getFotoProfil(),
                $user->getId(),
            ]
        );
    }

    /**
     * @param string $userId
     * @return void
     */
    public function delete($userId)
    {
        $this->database->query(
            sql: "DELETE FROM users WHERE id = ?",
            params: [
                $userId,
            ]
        );
    }

    /**
     * @param string $email
     * @return bool
     */
    public function verifyAvailableEmail($email)
    {
        $this->database->query(
            sql: "SELECT id FROM users WHERE email = ?",
            params: [
                $email
            ]
        );

        return $this->database->result()->num_rows <= 0;
    }
}
