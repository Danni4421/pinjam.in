<?php

class JamKuliahRepository implements Repository
{
  private MySQL $database;

  public function __construct($database)
  {
    $this->database = $database;
  }

  /**
   * Add Jam Kuliah
   *
   * @param JamKuliah $jamKuliah
   * @return void
   */
  public function add($jamKuliah)
  {
    $this->database->query(
      sql: 'INSERT INTO jamkuliah (jk_id, jam_mulai, jam_selesai) VALUES (?, ?, ?)',
      params: [
        $jamKuliah->getJkId(),
        $jamKuliah->getJamMulai()->format("H:i:s"),
        $jamKuliah->getJamSelesai()->format("H:i:s")
      ]
    );
  }

  /**
   * Get Jam Kuliah
   *
   * @return JamKuliah[]
   */
  public function get()
  {
    $this->database->query(
      sql: 'SELECT * FROM jamkuliah',
    );

    $jamkuliah = $this->database->result();
    $list_jam_kuliah = [];

    while ($row = $jamkuliah->fetch_assoc()) {
      $list_jam_kuliah[] = new JamKuliah(
        jkId: (int) $row["jk_id"],
        jamMulai: new DateTime($row["jam_mulai"]),
        jamSelesai: new DateTime($row["jam_selesai"]),
      );
    }

    return $list_jam_kuliah;
  }

  /**
   * Get Detail Jam Kuliah
   *
   * @param int $jkId
   * @return JamKuliah
   */
  public function getById($jkId)
  {
    $this->database->query(
      sql: 'SELECT * FROM jamkuliah WHERE jk_id = ?',
      params: [
        $jkId
      ]
    );

    $result = $this->database->result()->fetch_assoc();

    return new JamKuliah(
      jkId: (int) $result["jk_id"],
      jamMulai: new DateTime($result["jam_mulai"]),
      jamSelesai: new DateTime($result["jam_selesai"])
    );
  }

  /**
   * Update Jam Kuliah
   * @param JamKuliah $jamKuliah
   * @return void
   */
  public function update($jamKuliah)
  {
    $this->database->query(
      sql: 'UPDATE jamkuliah SET jam_mulai = ?, jam_selesai = ? WHERE jk_id = ?',
      params: [
        $jamKuliah->getJamMulai()->format("H:i:s"),
        $jamKuliah->getJamSelesai()->format("H:i:s"),
        $jamKuliah->getJkId()
      ]
    );
  }

  /**
   * Delete Jam Kuliah
   *
   * @param int $jkId
   * @return void
   */
  public function delete($jkId)
  {
    $this->database->query(
      sql: 'DELETE FROM jamkuliah WHERE jk_id = ?',
      params: [
        $jkId
      ]
    );
  }

  /**
   * Verify Jam Kuliah Is Not Exists
   *
   * @param int $jkId
   * @return bool
   */
  public function verifyJamKuliahIsExists($jkId)
  {
    $this->database->query(
      sql: "SELECT * FROM jamkuliah WHERE jk_id = ?",
      params: [
        $jkId
      ]
    );

    return $this->database->result()->num_rows <= 0;
  }
}
