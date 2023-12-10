<?php


abstract class RuangService implements IRuangService
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
     * @param string $kode_ruang
     * @return array
     */
    public function getFasilitas($kode_ruang)
    {
        $this->database->query(
            sql: 'SELECT f.fasilitas_id, f.nama_fasilitas, df.status
            FROM detailfasilitas df 
            INNER JOIN ruang r ON r.kode_ruang = df.kode_ruang
            INNER JOIN fasilitas f ON f.fasilitas_id = df.fasilitas_id
            WHERE r.kode_ruang = ?',
            params: [
                $kode_ruang
            ]
        );

        $result = $this->database->result();
        $fasilitas = [];

        while ($row = $result->fetch_assoc()) {
            $fasilitas[] = new Fasilitas(
                fasilitasId: $row["fasilitas_id"],
                namaFasilitas: $row["nama_fasilitas"],
                status: $row["status"]
            );
        }

        return $fasilitas;
    }
    /**
     * @param string $nama_ruang
     * @return array
     */
    public function search($nama_ruang)
    {
        $this->database->query(
            sql: "SELECT 
                kode_ruang, nama_ruang, kapasitas, lantai, foto_ruang, is_ruang_dosen
            FROM ruang
            WHERE nama_ruang LIKE '%$nama_ruang%'"
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
                    fasilitas: $row["fasilitas"],
                );
            } else {
                $ruangan[] = new RuangKelas(
                    kodeRuang: $row["kode_ruang"],
                    namaRuang: $row["nama_ruang"],
                    kapasitas: $row["kapasitas"],
                    lantai: $row["lantai"],
                    fotoRuang: $row["foto_ruang"],
                    fasilitas: $row["fasilitas"],
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
     * @param Ruang $ruang
     * @return void
     */
    public function delete($ruang)
    {
        $this->database->query(
            sql: 'DELETE FROM ruang WHERE kode_ruang = ?',
            params: [
                $ruang->getKodeRuang(),
            ]
        );
    }
}
