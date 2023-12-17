<?php

class RuangKelasRepository extends RuangRepository
{
    public function __construct(MySQL $database)
    {
        parent::__construct(database: $database);
    }

    public function addJadwal(Ruang $ruang, Jadwal $jadwal): void
    {
        $this->database->query(
            sql: "INSERT INTO jadwal (kode_ruang, hari, mk_id, jk_mulai, jk_selesai) VALUES (?, ?, ?, ?, ?)",
            params: [
                $ruang->getKodeRuang(),
                $jadwal->getHari(),
                $jadwal->getMataKuliah()->getMkId(),
                $jadwal->getJamMulai()->getJkId(),
                $jadwal->getJamSelesai()->getJkId()
            ]
        );
    }

    /**
     * @return array
     */
    public function get()
    {
        $this->database->query(
            sql: "SELECT * FROM ruang WHERE is_ruang_dosen = 0",
        );

        $result = $this->database->result();
        $ruangan = [];

        while ($row = $result->fetch_assoc()) {
            $ruangan[] = new RuangKelas(
                kodeRuang: $row["kode_ruang"],
                namaRuang: $row["nama_ruang"],
                kapasitas: $row["kapasitas"],
                lantai: $row["lantai"],
                fotoRuang: $row["foto_ruang"],
                fasilitas: $this->getFasilitas(kodeRuang: $row["kode_ruang"]),
                jadwal: $this->getJadwal(kodeRuang: $row["kode_ruang"])
            );
        }

        return $ruangan;
    }

    /**
     * @param string $kodeRuang
     * @return RuangKelas
     */
    public function getById($kodeRuang)
    {
        $this->database->query(
            sql: "SELECT
            kode_ruang, nama_ruang, kapasitas, lantai, foto_ruang
            FROM ruang
            WHERE is_ruang_dosen = 0 AND kode_ruang = ?",
            params: [
                $kodeRuang
            ]
        );

        $ruang_result = $this->database->result();
        $ruang = $ruang_result->fetch_assoc();

        return new RuangKelas(
            kodeRuang: $ruang["kode_ruang"],
            namaRuang: $ruang["nama_ruang"],
            kapasitas: $ruang["kapasitas"],
            lantai: $ruang["lantai"],
            fotoRuang: $ruang["foto_ruang"],
            fasilitas: $this->getFasilitas(kodeRuang: $ruang["kode_ruang"]),
            jadwal: $this->getJadwal(kodeRuang: $ruang["kode_ruang"])
        );
    }

    /**
     * Get Ruang By Capacity
     *
     * @param int $amount
     * @return RuangKelas[]
     */
    public function getRuangTeoriByCapacity($amount)
    {
        $this->database->query(
            sql: "SELECT * FROM ruang WHERE is_ruang_dosen = 0 AND tipe = 'RT' AND kapasitas = ?",
            params: [
                $amount
            ]
        );

        $result = $this->database->result();
        $ruangan = [];

        while ($row = $result->fetch_assoc()) {
            $ruangan[] = new RuangKelas(
                kodeRuang: $row["kode_ruang"],
                namaRuang: $row["nama_ruang"],
                kapasitas: $row["kapasitas"],
                lantai: $row["lantai"],
                fotoRuang: $row["foto_ruang"],
                fasilitas: $this->getFasilitas(kodeRuang: $row["kode_ruang"]),
                jadwal: $this->getJadwal(kodeRuang: $row["kode_ruang"])
            );
        }

        return $ruangan;
    }

    /**
     * @param RuangKelas $ruang
     * @return array
     */
    public function getJadwal($kodeRuang)
    {
        $this->database->query(
            sql: "SELECT j.id jadwal_id, mk.mk_id, mk.nama_mk, mk.sks, j.hari hari_id,
            jkm.jk_id jkm_id, jkm.jam_mulai jkm_mulai, jkm.jam_selesai jkm_selesai, 
            jks.jk_id jks_id, jks.jam_mulai jks_mulai, jks.jam_selesai jks_selesai 
            FROM jadwal j 
            JOIN matakuliah mk ON mk.mk_id = j.mk_id 
            JOIN jamkuliah jkm ON jkm.jk_id = j.jk_mulai 
            JOIN jamkuliah jks ON jks.jk_id = j.jk_selesai 
            WHERE j.kode_ruang =  ?",
            params: [
                $kodeRuang
            ]
        );

        $jadwalResult = $this->database->result();

        $jadwal = [];

        while ($row = $jadwalResult->fetch_assoc()) {
            $jadwal[] = new Jadwal(
                jadwalId: $row["jadwal_id"],
                mataKuliah: new MataKuliah(
                    mkId: $row["mk_id"],
                    namaMk: $row["nama_mk"],
                    sks: $row["sks"]
                ),
                hari: $row["hari_id"],
                jamMulai: new JamKuliah(
                    jkId: $row["jkm_id"],
                    jamMulai: new DateTime($row["jkm_mulai"]),
                    jamSelesai: new DateTime($row["jkm_selesai"]),
                ),
                jamSelesai: new JamKuliah(
                    jkId: $row["jks_id"],
                    jamMulai: new DateTime($row["jks_mulai"]),
                    jamSelesai: new DateTime($row["jks_selesai"])
                ),
            );
        }

        return $jadwal;
    }

    /**
     * @param Jadwal $jadwal
     * @return void
     */
    public function updateJadwal($jadwal)
    {
        $this->database->query(
            sql: "UPDATE jadwal SET
                    hari = ?,
                    mk_id = ?,
                    jk_mulai = ?,
                    jk_selesai = ?
                WHERE id = ?",
            params: [
                $jadwal->getHari(),
                $jadwal->getMataKuliah()->getMkId(),
                $jadwal->getJamMulai()->getJkId(),
                $jadwal->getJamSelesai()->getJkId(),
                $jadwal->getJadwalId()
            ]
        );
    }

    /**
     * @param RuangKelas $ruang
     * @return void
     */
    public function updateRuang($ruang)
    {
        $this->database->query(
            sql: "UPDATE ruang SET
                    nama_ruang = ?,
                    kapasitas = ?,
                    lantai = ?,
                    foto_ruang = ?
                WHERE kode_ruang = ?",
            params: [
                $ruang->getNamaRuang(),
                $ruang->getKapasitas(),
                $ruang->getLantai(),
                $ruang->getFotoRuang(),
                $ruang->getKodeRuang()
            ]
        );
    }

    /**
     * @param Jadwal $jadwal
     * @return void
     */
    public function deleteJadwal($jadwal)
    {
        $this->database->query(
            sql: "DELETE FROM jadwal WHERE id = ?",
            params: [
                $jadwal->getJadwalId()
            ]
        );
    }
}
