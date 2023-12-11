<?php

class RuangDosenRepository extends RuangRepository
{
    public function __construct(MySQL $database)
    {
        parent::__construct(database: $database);
    }

    /**
     * @return array
     */
    public function get()
    {
        $this->database->query(
            sql: "SELECT * FROM ruang WHERE is_ruang_dosen = 1",
        );

        $result = $this->database->result();
        $ruangan = [];

        while ($row = $result->fetch_assoc()) {
            $ruangan[] = new RuangDosen(
                kodeRuang: $row["kode_ruang"],
                namaRuang: $row["nama_ruang"],
                kapasitas: $row["kapasitas"],
                lantai: $row["lantai"],
                fotoRuang: $row["foto_ruang"],
                fasilitas: $this->getFasilitas(kodeRuang: $row["kode_ruang"]),
            );
        }

        return $ruangan;
    }

    /**
     * @param string $kodeRuang
     * @return RuangDosen
     */
    public function getById($kodeRuang)
    {
        $this->database->query(
            sql: "SELECT nama_ruang, kapasitas, lantai, foto_ruang FROM ruang WHERE is_ruang_dosen = 1 AND kode_ruang = ?",
            params: [
                $kodeRuang
            ]
        );

        $ruang_result = $this->database->result();
        $ruang = $ruang_result->fetch_assoc();

        $ruang = new RuangDosen(
            kodeRuang: $kodeRuang,
            namaRuang: $ruang["nama_ruang"],
            kapasitas: $ruang["kapasitas"],
            lantai: $ruang["lantai"],
            fotoRuang: $ruang["foto_ruang"],
            fasilitas: $this->getFasilitas(kodeRuang: $kodeRuang),
            dosen: $this->getDosen(kodeRuang: $kodeRuang)
        );

        return $ruang;
    }

    /**
     * @param string $kodeRuang
     * @return array
     */
    public function getDosen($kodeRuang)
    {
        $this->database->query(
            sql: "SELECT u.id user_id, u.username, u.email, u.level,
            ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil 
            FROM users u 
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id 
            LEFT OUTER JOIN ruang r ON r.kode_ruang = ud.kode_ruang 
            WHERE r.kode_ruang = ?",
            params: [
                $kodeRuang,
            ]
        );

        $result = $this->database->result();
        $list_dosen = [];

        while ($row = $result->fetch_assoc()) {
            $list_dosen[] = new Dosen(
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

        return $list_dosen;
    }

    /**
     * @param string $kodeRuang
     * @return void
     */
    public function deleteDosen($kodeRuang)
    {
        $this->database->query(
            sql: 'UPDATE userdetails SET kode_ruang = null WHERE kode_ruang = ?',
            params: [
                $kodeRuang
            ]
        );
    }
}
