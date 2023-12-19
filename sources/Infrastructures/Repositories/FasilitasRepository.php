<?php

class FasilitasRepository implements Repository
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
   * @param Fasilitas $fasilitas
   * @return void
   */
  public function add($fasilitas)
  {
    $this->database->query(
      sql: 'INSERT INTO fasilitas (nama_fasilitas) VALUES (?)',
      params: [
        $fasilitas->getNamaFasilitas(),
      ]
    );
  }

  /**
   * @param int $fasilitasId
   * @param string $kodeRuang
   * @param string $status
   * @return void
   */
  public function addIntoRuang($fasilitasId, $kodeRuang, $status = 'Baik')
  {
    $this->database->query(
      sql: 'INSERT INTO detailfasilitas (fasilitas_id, kode_ruang, status) VALUES(?, ?, ?)',
      params: [
        $fasilitasId, $kodeRuang, $status
      ]
    );
  }

  /**
   * @return Fasilitas[]
   */
  public function get()
  {
    $this->database->query(
      sql: 'SELECT * FROM fasilitas'
    );

    $result = $this->database->result();
    $fasilitas = [];

    while ($row = $result->fetch_assoc()) {
      $fasilitas[] = new Fasilitas(
        fasilitasId: $row["fasilitas_id"],
        namaFasilitas: $row["nama_fasilitas"],
        icon: $row["icon"],
        status: ""
      );
    }

    return $fasilitas;
  }

  /**
   * @param int $fasilitasId
   * @return Fasilitas
   */
  public function getById($fasilitasId)
  {
    $this->database->query(
      sql: 'SELECT * FROM fasilitas',
    );

    $result = $this->database->result()->fetch_assoc();

    return new Fasilitas(
      fasilitasId: $result["fasilitas_id"],
      namaFasilitas: $result["nama_fasilitas"],
      icon: $result["icon"],
      status: ""
    );
  }

  public function getByRuang($kodeRuang)
  {
    $this->database->query(
      sql: 'SELECT  f.fasilitas_id, f.nama_fasilitas, f.icon, df.status
      FROM detailfasilitas df
      LEFT OUTER JOIN fasilitas f ON f.fasilitas_id = df.fasilitas_id
      WHERE kode_ruang = ?',
      params: [
        $kodeRuang
      ]
    );

    $result = $this->database->result();
    $list_fasilitas = [];

    while ($row = $result->fetch_assoc()) {
      $list_fasilitas[] = new Fasilitas(
        fasilitasId: $row["fasilitas_id"],
        namaFasilitas: $row["nama_fasilitas"],
        icon: $row["icon"],
        status: $row["status"]
      );
    }

    return $list_fasilitas;
  }

  /**
   * @param Fasilitas $fasilitas
   * @return void
   */
  public function update($fasilitas)
  {
    $this->database->query(
      sql: 'UPDATE fasilitas SET nama_fasilitas = ? WHERE fasilitas_id = ?',
      params: [
        $fasilitas->getNamaFasilitas(),
        $fasilitas->getFasilitasId()
      ]
    );
  }

  /**
   * @param int $fasilitasId
   * @return void
   */
  public function delete($fasilitasId)
  {
    $this->database->query(
      sql: 'DELETE FROM fasilitas WHERE fasilitas_id = ?',
      params: [
        $fasilitasId
      ]
    );
  }

  public function deleteByRuang($kodeRuang, $fasilitasId)
  {
    $this->database->query(
      sql: 'DELETE FROM detailfasilitas WHERE kode_ruang = ? AND fasilitas_id = ?',
      params: [
        $kodeRuang, $fasilitasId
      ]
    );
  }
}
