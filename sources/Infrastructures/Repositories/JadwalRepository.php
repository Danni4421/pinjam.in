<?php

class JadwalRepository implements IJadwalRepository
{
  private MySQL $database;

  /**
   * @param MySQL $database
   */
  public function __construct($database)
  {
    $this->database = $database;
  }

  /**
   * @param array $jadwal
   * @return void
   */
  public function add($jadwal)
  {
    $this->database->query(
      sql: "INSERT INTO jadwal (mk_id, hari, jk_mulai, jk_selesai, kode_ruang) VALUES (?, ?, ?, ?, ?)",
      params: [
        $jadwal["mk_id"],
        $jadwal["hari"],
        $jadwal["jk_mulai"],
        $jadwal["jk_selesai"],
        $jadwal["kode_ruang"]
      ]
    );
  }

  /**
   * @return Jadwal[]
   */
  public function get()
  {
    $this->database->query(
      sql: 'CALL SpGetJadwal(@id_jadwal := null, @kode_ruang := null)'
    );

    $result = $this->database->result();
    $list_jadwal = [];

    while ($row = $result->fetch_assoc()) {
      $list_jadwal[] = new Jadwal(
        jadwalId: $row["jadwal_id"],
        mataKuliah: new MataKuliah(
          mkId: $row["mk_id"],
          namaMk: $row["nama_mk"],
          sks: $row["sks"]
        ),
        jamMulai: new JamKuliah(
          jkId: $row["jam_mulai_id"],
          jamMulai: $row["jkm_mulai"],
          jamSelesai: $row["jkm_selesai"]
        ),
        jamSelesai: new JamKuliah(
          jkId: $row['jam_selesai_id'],
          jamMulai: new DateTime($row["jks_mulai"]),
          jamSelesai: new DateTime($row["jks_selesai"])
        ),
        hari: $row["hari"]
      );
    }

    return $list_jadwal;
  }

  /**
   * @param int $jadwalId
   * @return Jadwal
   */
  public function getById($jadwalId)
  {
    $this->database->query(
      sql: "CALL SpGetJadwal(@id_jadwal := ?, @kode_ruang := null)",
      params: [
        $jadwalId
      ]
    );

    $result = $this->database->result()->fetch_assoc();

    return new Jadwal(
      jadwalId: $result["jadwal_id"],
      mataKuliah: new MataKuliah(
        mkId: $result["mk_id"],
        namaMk: $result["nama_mk"],
        sks: $result["sks"]
      ),
      jamMulai: new JamKuliah(
        jkId: $result["jam_mulai_id"],
        jamMulai: new DateTime($result["jkm_mulai"]),
        jamSelesai: new DateTime($result["jkm_selesai"])
      ),
      jamSelesai: new JamKuliah(
        jkId: $result["jam_selesai_id"],
        jamMulai: new DateTime($result["jks_mulai"]),
        jamSelesai: new DateTime($result["jks_selesai"])
      ),
      hari: $result["hari"]
    );
  }

  /**
   * @param string $kodeRuang
   * @return Jadwal[]
   */
  public function getByRuang($kodeRuang)
  {
    $this->database->query(
      sql: "CALL SpGetJadwal(@id_jadwal := null, @kode_ruang := ?)",
      params: [
        $kodeRuang
      ]
    );

    $result = $this->database->result();
    $list_jadwal = [];

    while ($row = $result->fetch_assoc()) {
      $list_jadwal[] = new Jadwal(
        jadwalId: $row["jadwal_id"],
        mataKuliah: new MataKuliah(
          mkId: $row["mk_id"],
          namaMk: $row["nama_mk"],
          sks: $row["sks"]
        ),
        jamMulai: new JamKuliah(
          jkId: $row["jam_mulai_id"],
          jamMulai: new DateTime($row["jkm_mulai"]),
          jamSelesai: new DateTime($row["jkm_selesai"])
        ),
        jamSelesai: new JamKuliah(
          jkId: $row['jam_selesai_id'],
          jamMulai: new DateTime($row["jks_mulai"]),
          jamSelesai: new DateTime($row["jks_selesai"])
        ),
        hari: $row["hari"]
      );
    }

    return $list_jadwal;
  }

  /**
   * @param Jadwal $jadwal
   * @return void
   */
  public function update($jadwal)
  {
    $this->database->query(
      sql: 'UPDATE 
      jadwal SET
      hari = ?,
      jk_mulai = ?,
      jk_selesai = ?,
      mk_id = ?
      WHERE id = ?',
      params: [
        $jadwal->getHari(),
        $jadwal->getJamMulai()->getJkId(),
        $jadwal->getJamSelesai()->getJkId(),
        $jadwal->getMataKuliah()->getMkId(),
        $jadwal->getJadwalId()
      ]
    );
  }

  /**
   * @param int $jadwalId
   * @return void
   */
  public function delete($jadwalId)
  {
    $this->database->query(
      sql: 'DELETE FROM jadwal WHERE id = ?',
      params: [
        $jadwalId
      ]
    );
  }

  /**
   * @param string $kodeRuang
   * @param int $hari
   * @param int $jamMulai
   * @param int $jamSelesai
   * @return bool
   */
  public function verifyAvailabilityJadwal($kodeRuang, $hari, $jamMulai, $jamSelesai)
  {
    $this->database->query(
      sql: 'SELECT VerifyAvailabilityJadwal(?, ?, ?, ?) as jadwalId',
      params: [
        $hari,
        $jamMulai,
        $jamSelesai,
        $kodeRuang
      ]
    );


    $result = $this->database->result()->fetch_assoc();

    return is_null($result["jadwalId"]);
  }
}
