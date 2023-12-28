<?php

class DosenRepository extends UserRepository
{
    public function __construct(MySQL $database)
    {
        parent::__construct(database: $database);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $this->database->query(
            sql: 'SELECT
            u.id user_id, u.username, u.email, u.level, 
            ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil,
            d.nip, r.kode_ruang, r.nama_ruang, r.kapasitas, r.lantai
            FROM users u 
                JOIN userdetails ud ON ud.user_id = u.id
                JOIN ruang r ON r.kode_ruang  = d.kode_ruang
                WHERE ud.is_dosen = 1'
        );

        $result = $this->database->result();
        $lectures = [];

        while ($row = $result->fetch_assoc()) {
            $lectures[] = new Dosen(
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
                ),
                ruang: new RuangDosen(
                    kodeRuang: $row["kode_ruang"],
                    namaRuang: $row["name_ruang"],
                    kapasitas: $row["kapasitas"],
                    lantai: $row["lantai"],
                ),
            );
        }

        return $lectures;
    }

    /**
     * @param string $id
     * @return Dosen
     */
    public function getById($id)
    {
        $this->database->query(
            sql: 'SELECT
            u.id user_id, u.username, u.email, u.level, 
            ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil,
            r.kode_ruang, r.nama_ruang, r.kapasitas, r.lantai
            FROM users u 
                JOIN userdetails ud ON ud.user_id = u.id
                JOIN ruang r ON r.kode_ruang  = ud.kode_ruang
                WHERE ud.is_dosen = 1 AND u.id = ?',
            params: [
                $id
            ]
        );

        $row = $this->database->result()->fetch_assoc();
        return new Dosen(
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
                kodeRuang: $row["kode_ruang"]
            ),
            ruang: new RuangDosen(
                kodeRuang: $row["kode_ruang"],
                namaRuang: $row["name_ruang"],
                kapasitas: $row["kapasitas"],
                lantai: $row["lantai"],
            ),
        );
    }
}
