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
      sql: 'SELECT * FROM fasilias',
    );

    $result = $this->database->result()->fetch_assoc();

    return new Fasilitas(
      fasilitasId: $result["fasilitas_id"],
      namaFasilitas: $result["nama_fasilitas"],
      icon: $result["icon"],
      status: ""
    );
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
}
