<?php

class RuangDosenService extends RuangService
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
            sql: 'SELECT * FROM ruang WHERE is_ruang_dosen = 1',
        );

        $result = $this->database->result();
        $ruangan = [];

        while ($row = $result->fetch_assoc()) {
            $ruang_kelas = new RuangDosen(
                kodeRuang: $row["kode_ruang"],
                namaRuang: $row["nama_ruang"],
                kapasitas: $row["kapasitas"],
                lantai: $row["lantai"],
                fotoRuang: $row["foto_ruang"],
            );

            $ruangan[] = $ruang_kelas;
        }

        return $ruangan;
    }

    /**
     * @param string $kode_ruang
     * @return RuangDosen
     */
    public function getById($kode_ruang)
    {
        $this->database->query(
            sql: 'SELECT * FROM ruang WHERE is_ruang_dosen = 1 AND kode_ruang = ?',
            params: [
                $kode_ruang
            ]
        );

        $ruang_result = $this->database->result();
        $ruang = $ruang_result->fetch_assoc();

        $ruang = new RuangDosen(
            kodeRuang: $ruang["kode_ruang"],
            namaRuang: $ruang["nama_ruang"],
            kapasitas: $ruang["kapasitas"],
            lantai: $ruang["lantai"],
            fotoRuang: $ruang["foto_ruang"],
            fasilitas: $this->getFasilitas(kode_ruang: $kode_ruang)
        );

        return $ruang;
    }

    /**
     * @param string $kode_ruang
     * @return array
     */
    public function getDosen($kode_ruang)
    {
        $this->database->query(
            sql: 'SELECT u.id user_id, u.username, u.email,
            ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil 
            FROM users u 
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id 
            LEFT OUTER JOIN ruang r ON r.kode_ruang = ud.kode_ruang 
            WHERE r.kode_ruang = ?',
            params: [
                $kode_ruang,
            ]
        );

        $result = $this->database->result();
        $list_dosen = [];

        while ($row = $result->fetch_assoc()) {
            $dosen = new Dosen(
                id: $row["user_id"],
                username: $row["username"],
                email: $row["email"],
                userDetails: new UserDetails(
                    nomorInduk: $row["nomor_induk"],
                    namaLengkap: $row["nama_lengkap"],
                    alamat: $row["alamat"],
                    noTelp: $row["no_telp"],
                    fotoProfil: $row["foto_profil"],
                )
            );
            $list_dosen[] = $dosen;
        }

        return $list_dosen;
    }

    /**
     * @param string $kode_ruang
     * @return void
     */
    public function deleteDosen($kode_ruang)
    {
        $this->database->query(
            sql: 'UPDATE userdetails SET kode_ruang = null WHERE kode_ruang = ?',
            params: [
                $kode_ruang
            ]
        );
    }
}
