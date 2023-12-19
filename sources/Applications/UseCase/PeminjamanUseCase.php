<?php

class PeminjamanUseCase
{
  private PeminjamanRepository $peminjamanRepository;
  private ?UserRepository $userRepository;

  /**
   * @param PeminjamanRepository $peminjamanRepository
   * @param ?UserRepository $userRepository
   */
  public function __construct($peminjamanRepository, $userRepository = null)
  {
    $this->peminjamanRepository = $peminjamanRepository;
    $this->userRepository = $userRepository;
  }

  /**
   * @param array $payload
   * @return void
   */
  public function addPeminjaman($payload)
  {
    $payload = Input::anti_injection(payload: $payload);
    $peminjam = $this->userRepository->getById($payload["user_id"]);
    $userDetails = $peminjam->getUserDetails();
    $ruangan = [];

    foreach ($payload["ruang"] as $ruang) {
      $ruangan[] = new RuangKelas(
        kodeRuang: $ruang
      );
    }

    $this->peminjamanRepository->add(
      new Peminjaman(
        peminjamanId: 0,
        peminjam: new Peminjam(
          id: $peminjam->getId(),
          username: $peminjam->getUsername(),
          email: $peminjam->getEmail(),
          userDetails: new UserDetails(
            nomorInduk: $userDetails->getNomorInduk(),
            namaLengkap: $userDetails->getNamaLengkap(),
            alamat: $userDetails->getAlamat(),
            noTelp: $userDetails->getNoTelp(),
          ),
          instansi: $payload["instansi"],
          logoInstansi: $payload["logo"]
        ),
        tanggalPeminjaman: new DateTime($payload["tanggal_peminjaman"]),
        tanggalKegiatanMulai: new DateTime($payload["tanggal_kegiatan_mulai"]),
        tanggalKegiatanSelesai: new DateTime($payload["tanggal_kegiatan_selesai"]),
        jamMulai: new DateTime($payload["jam_mulai"]),
        jamSelesai: new DateTime($payload["jam_selesai"]),
        keterangan: $payload["keterangan"],
        status: "Diproses",
        ruang: $ruangan
      ),
    );
  }

  /**
   * ?@param int $userId
   * @return Peminjaman[]
   */
  public function getPeminjaman($userId = null)
  {
    if (!is_null($userId)) {
      return $this->peminjamanRepository->getByUser($userId);
    }

    return $this->peminjamanRepository->get();
  }

  /**
   * @param int $peminjamanId
   * @return Peminjaman[]
   */
  public function getOnProcessPeminjaman()
  {
    return $this->peminjamanRepository->getPeminjamanByStatus("Diproses");
  }

  /**
   * Get peminjaman with status not done yet
   *
   * @return Peminjaman[]
   */
  public function getPeminjamanNotDone()
  {
    return [
      ...$this->peminjamanRepository->getPeminjamanByStatus("Diproses"),
      ...$this->peminjamanRepository->getPeminjamanByStatus("Disetujui")
    ];
  }

  /**
   * @param int $peminjamanId
   * @return Peminjaman
   */
  public function getDetailPeminjaman($peminjamanId)
  {
    return $this->peminjamanRepository->getById($peminjamanId);
  }

  /**
   * @param array $payload
   * @return void
   */
  public function updatePeminjaman($payload)
  {
    $payload = Input::anti_injection(payload: $payload);

    $tanggalMulai = new DateTime($payload["tanggalKegiatanMulai"]);
    $tanggalSelesai = new DateTime($payload["tanggalKegiatanSelesai"]);
    $jamMulai = new DateTime($payload["jamMulai"]);
    $jamSelesai = new DateTime($payload["jamSelesai"]);

    $this->peminjamanRepository->update(peminjaman: [
      "tanggalKegiatanMulai" => $tanggalMulai->format("Y-m-d"),
      "tanggalKegiatanSelesai" => $tanggalSelesai->format("Y-m-d"),
      "jamMulai" => $jamMulai->format("H:i:s"),
      "jamSelesai" => $jamSelesai->format("H:i:s"),
      "status" => $payload["status"],
      "peminjamanId" => $payload["peminjamanId"]
    ]);
  }

  /**
   * @param int $peminjamanId
   * @return void
   */
  public function deletePeminjaman($peminjamanId)
  {
    $payload = Input::anti_injection(payload: ["peminjamanId" => $peminjamanId]);
    $this->peminjamanRepository->delete($payload["peminjamanId"]);
  }
}
