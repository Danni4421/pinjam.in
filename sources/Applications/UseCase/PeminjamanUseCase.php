<?php

class PeminjamanUseCase
{
  private PeminjamanRepository $peminjamanRepository;
  private UserRepository $userRepository;

  /**
   * @param PeminjamanRepository $peminjamanRepository
   * @param UserRepository $userRepository
   */
  public function __construct($peminjamanRepository, $userRepository)
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
    $peminjam = $this->userRepository->getById($payload["user_id"]);
    $userDetails = $peminjam->getUserDetails();

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
        ),
        tanggalPeminjaman: new DateTime($payload["tanggal_peminjaman"]),
        tanggalKegiatan: new DateTime($payload["tanggal_kegiatan"]),
        jamMulai: new JamKuliah(
          jkId: $payload["jam_mulai"],
        ),
        jamSelesai: new JamKuliah(
          jkId: $payload["jam_mulai"],
        ),
        keterangan: $payload["keterangan"],
        status: "Diproses",
        ruang: []
      ),
    );
  }

  /**
   * @return Peminjaman[]
   */
  public function getPeminjaman()
  {
    return $this->peminjamanRepository->get();
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
    $this->peminjamanRepository->update($payload);
  }

  /**
   * @param int $peminjamanId
   * @return void
   */
  public function deletePeminjaman($peminjamanId)
  {
    $this->peminjamanRepository->delete($peminjamanId);
  }
}
