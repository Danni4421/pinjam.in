<?php

class MataKuliahRepository implements Repository
{
  private MySQL $database;
  public function __construct($database)
  {
    $this->database = $database;
  }
  /**
   * Add Mata Kuliah
   *
   * @param MataKuliah $mataKuliah
   * @return void
   */
  public function add($mataKuliah)
  {
    $this->database->query(
      sql: "INSERT INTO matakuliah (mk_id, nama_mk, sks) VALUES (?, ?, ?)",
      params: [
        $mataKuliah->getMkId(),
        $mataKuliah->getNamaMk(),
        $mataKuliah->getSks()
      ]
    );
  }

  /**
   * Get Mata Kuliah
   *
   * @return MataKuliah[]
   */
  public function get()
  {
    $this->database->query(
      sql: "SELECT * FROM matakuliah",
    );

    $result = $this->database->result();
    $matakuliah = [];

    while ($row = $result->fetch_assoc()) {
      $matakuliah[] = new MataKuliah(
        mkId: $row["mk_id"],
        namaMk: $row["nama_mk"],
        sks: $row["sks"]
      );
    }

    return $matakuliah;
  }

  /**
   * Get Mata Kuliah By Detail
   *
   * @param string $mkId
   * @return MataKuliah
   */
  public function getById($mkId)
  {
    $this->database->query(
      sql: "SELECT * FROM matakuliah WHERE mk_id = ?",
      params: [
        $mkId
      ]
    );

    $result = $this->database->result()->fetch_assoc();
    return new MataKuliah(
      mkId: $result["mk_id"],
      namaMk: $result["nama_mk"],
      sks: $result["sks"]
    );
  }


  /**
   * Update Mata Kuliah
   *
   * @param MataKuliah $mataKuliah
   * @return void
   */
  public function update($mataKuliah)
  {
    $this->database->query(
      sql: "UPDATE matakuliah SET nama_mk = ?, sks = ? WHERE mk_id = ?",
      params: [
        $mataKuliah->getNamaMk(),
        $mataKuliah->getSks(),
        $mataKuliah->getMkId()
      ]
    );
  }

  /**
   * Delete Mata Kuliah
   *
   * @param string $mkId
   * @return void
   */
  public function delete($mkId)
  {
    $this->database->query(
      sql: 'DELETE FROM matakuliah WHERE mk_id = ?',
      params: [
        $mkId
      ]
    );
  }

  /**
   * Verify Mata Kuliah is Exists 
   *
   * @param string $mkId
   * @return bool
   */
  public function verifyMataKuliahIsExists($mkId)
  {
    $this->database->query(
      sql: "SELECT * FROM matakuliah WHERE mk_id = ?",
      params: [
        $mkId
      ]
    );

    return $this->database->result()->num_rows <= 0;
  }
}
