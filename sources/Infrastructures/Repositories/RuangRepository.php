<?php


abstract class RuangRepository implements IRuangRepository
{
    protected MySQL $database;

    public function __construct(MySQL $database)
    {
        $this->database = $database;
    }

    /**
     * @param Ruang $ruang
     * @return void
     */
    public function add($ruang)
    {
        $this->database->query(
            sql: 'INSERT INTO ruang (kode_ruang, nama, kapasitas, lantai) VALUES (?, ?, ?, ?)',
            params: [
                $ruang->getKodeRuang(),
                $ruang->getNamaRuang(),
                $ruang->getKapasitas(),
                $ruang->getLantai(),
            ]
        );
    }

    /**
     * @return Ruang[]
     */
    public function get()
    {
        $this->database->query(
            sql: "SELECT * FROM ruang",
        );

        $result = $this->database->result();
        $ruangan = [];

        while ($row = $result->fetch_assoc()) {
            if ($row["is_ruang_dosen"]) {
                $ruangan[] = new RuangDosen(
                    kodeRuang: $row["kode_ruang"],
                    namaRuang: $row["nama_ruang"],
                    kapasitas: $row["kapasitas"],
                    lantai: $row["lantai"],
                    fotoRuang: $row["foto_ruang"],
                    fasilitas: $this->getFasilitas(kodeRuang: $row["kode_ruang"]),
                    dosen: []
                );
            } else {
                $ruangan[] = new RuangKelas(
                    kodeRuang: $row["kode_ruang"],
                    namaRuang: $row["nama_ruang"],
                    kapasitas: $row["kapasitas"],
                    lantai: $row["lantai"],
                    fotoRuang: $row["foto_ruang"],
                    fasilitas: $this->getFasilitas(kodeRuang: $row["kode_ruang"]),
                    jadwal: []
                );
            }
        }

        return $ruangan;
    }

    /**
     * @param string $kodeRuang
     * @return array
     */
    public function getFasilitas($kodeRuang)
    {
        $this->database->query(
            sql: 'SELECT f.fasilitas_id, f.nama_fasilitas, f.icon, df.status
            FROM detailfasilitas df 
            INNER JOIN ruang r ON r.kode_ruang = df.kode_ruang
            INNER JOIN fasilitas f ON f.fasilitas_id = df.fasilitas_id
            WHERE r.kode_ruang = ?',
            params: [
                $kodeRuang
            ]
        );

        $result = $this->database->result();
        $fasilitas = [];

        while ($row = $result->fetch_assoc()) {
            $fasilitas[] = new Fasilitas(
                fasilitasId: $row["fasilitas_id"],
                namaFasilitas: $row["nama_fasilitas"],
                icon: $row["icon"],
                status: $row["status"]
            );
        }

        return $fasilitas;
    }

    /**
     * @param string $namaRuang
     * @return array
     */
    public function search($namaRuang)
    {
        $this->database->query(
            sql: "SELECT 
                kode_ruang, nama_ruang, kapasitas, lantai, foto_ruang, is_ruang_dosen
            FROM ruang
            WHERE nama_ruang LIKE '%$namaRuang%'",
        );

        $result = $this->database->result();
        $ruangan = [];

        while ($row = $result->fetch_assoc()) {
            $fasilitas = $this->getFasilitas(kodeRuang: $row["kode_ruang"]);

            if ($row["is_ruang_dosen"]) {
                $ruangan[] = new RuangDosen(
                    kodeRuang: $row["kode_ruang"],
                    namaRuang: $row["nama_ruang"],
                    kapasitas: $row["kapasitas"],
                    lantai: $row["lantai"],
                    fotoRuang: $row["foto_ruang"],
                    fasilitas: $fasilitas,
                );
            } else {
                $ruangan[] = new RuangKelas(
                    kodeRuang: $row["kode_ruang"],
                    namaRuang: $row["nama_ruang"],
                    kapasitas: $row["kapasitas"],
                    lantai: $row["lantai"],
                    fotoRuang: $row["foto_ruang"],
                    fasilitas: $fasilitas,
                );
            }
        }

        return $ruangan;
    }

    /**
     * @param Ruang $ruang
     * @return void
     */
    public function update($ruang)
    {
        $this->database->query(
            sql: 'UPDATE ruang SET
                nama_ruang = ?,
                kapasitas = ?,
                lantai = ?
                WHERE kode_ruang = ?',
            params: [
                $ruang->getNamaRuang(),
                $ruang->getKapasitas(),
                $ruang->getLantai(),
                $ruang->getKodeRuang()
            ]
        );
    }

    /**
     * @param string $kodeRuang
     * @return void
     */
    public function delete($kodeRuang)
    {
        $this->database->query(
            sql: 'DELETE FROM ruang WHERE kode_ruang = ?',
            params: [
                $kodeRuang,
            ]
        );
    }

    /**
     * @param string $kodeRuang
     * @param int $tanggalKegiatan
     * @param int $jamMulai
     * @param int $jamSelesai
     * @return bool
     */
    public function verifyIsRuangAvailable($kodeRuang, $tanggalKegiatan, $jamMulai, $jamSelesai)
    {
        $this->database->query(
            sql: "SELECT VerifyAvailableRoom(?, ?, ?, ?) as kodeRuang",
            params: [
                $kodeRuang,
                $tanggalKegiatan,
                $jamMulai,
                $jamSelesai
            ]
        );

        $result = $this->database->result()->fetch_assoc();

        return is_null($result["kodeRuang"]);
    }
}
