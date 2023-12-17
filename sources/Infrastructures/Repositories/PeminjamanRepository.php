<?php

class PeminjamanRepository implements IPeminjamanRepository
{
    private MySQL $database;

    public function __construct(MySQL $database)
    {
        $this->database = $database;
    }

    /**
     * @param Peminjaman $peminjaman
     * @return void
     */
    public function add($peminjaman)
    {
        $peminjam = $peminjaman->getPeminjam();

        $this->database->query(
            sql: "INSERT INTO peminjaman (
                tanggal_peminjaman, 
                tanggal_kegiatan_mulai, 
                tanggal_kegiatan_selesai, 
                keterangan, 
                asal_instansi, 
                status, 
                user_id, 
                jam_mulai, 
                jam_selesai, 
                logo_instansi) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            params: [
                $peminjaman->getTanggalPeminjaman()->format("Y-m-d"),
                $peminjaman->getTanggalKegiatanMulai()->format("Y-m-d"),
                $peminjaman->getTanggalKegiatanSelesai()->format("Y-m-d"),
                $peminjaman->getKeterangan(),
                $peminjam->getInstansi(),
                $peminjaman->getStatus(),
                $peminjam->getId(),
                $peminjaman->getJamMulai()->format('H:i:s'),
                $peminjaman->getJamSelesai()->format('H:i:s'),
                $peminjam->getLogoInstansi(),
            ]
        );

        $peminjaman_id = $this->database->get_last_inserted_id();
        $ruangan = $peminjaman->getRuang();

        foreach ($ruangan as $ruang) {
            $this->database->query(
                sql: "INSERT INTO detailpeminjaman (peminjaman_id, kode_ruang) VALUES (?, ?)",
                params: [
                    $peminjaman_id,
                    $ruang->getKodeRuang(),
                ]
            );
        }
    }

    /**
     * @return array
     */
    public function get()
    {
        $this->database->query(
            sql: "SELECT
            p.id peminjaman_id, p.tanggal_peminjaman, p.tanggal_kegiatan_mulai, p.tanggal_kegiatan_selesai, 
            p.keterangan, p.status, p.asal_instansi, p.logo_instansi, p.jam_mulai, p.jam_selesai,
            u.id user_id, u.username, u.email, ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil
            FROM peminjaman p
            LEFT OUTER JOIN users u ON u.id = p.user_id
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id
            ORDER BY p.tanggal_peminjaman DESC"
        );

        $result_peminjaman = $this->database->result();
        $list_peminjaman = [];

        while ($peminjaman = $result_peminjaman->fetch_assoc()) {
            $ruangan = $this->getRuangByPeminjamanId(peminjamanId: $peminjaman["peminjaman_id"]);

            $list_peminjaman[] = new Peminjaman(
                peminjamanId: $peminjaman["peminjaman_id"],
                peminjam: new Peminjam(
                    id: $peminjaman["user_id"],
                    username: $peminjaman["username"],
                    email: $peminjaman["email"],
                    userDetails: new UserDetails(
                        nomorInduk: $peminjaman["nomor_induk"],
                        namaLengkap: $peminjaman["nama_lengkap"],
                        alamat: $peminjaman["alamat"],
                        noTelp: $peminjaman["no_telp"],
                        fotoProfil: $peminjaman["foto_profil"],
                    ),
                    instansi: $peminjaman["asal_instansi"],
                    logoInstansi: $peminjaman["logo_instansi"],
                ),
                ruang: $ruangan,
                tanggalPeminjaman: new DateTime($peminjaman["tanggal_peminjaman"]),
                tanggalKegiatanMulai: new DateTime($peminjaman["tanggal_kegiatan_mulai"]),
                tanggalKegiatanSelesai: new DateTime($peminjaman["tanggal_kegiatan_selesai"]),
                jamMulai: new DateTime($peminjaman["jam_mulai"]),
                jamSelesai: new DateTime($peminjaman["jam_selesai"]),
                keterangan: $peminjaman["keterangan"],
                status: $peminjaman["status"]
            );
        }

        return $list_peminjaman;
    }

    /**
     * @param string $status
     * @return array
     */
    public function getPeminjamanByStatus($status)
    {
        $this->database->query(
            sql: "SELECT
            p.id peminjaman_id, p.tanggal_peminjaman, p.tanggal_kegiatan_mulai, p.tanggal_kegiatan_selesai, 
            p.keterangan, p.status, p.jam_mulai, p.jam_selesai,
            u.id user_id, u.username, u.email, ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil
            FROM peminjaman p
            LEFT OUTER JOIN users u ON u.id = p.user_id
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id
            WHERE p.status = ?",
            params: [
                $status
            ]
        );

        $result_peminjaman = $this->database->result();
        $list_peminjaman = [];

        while ($peminjaman = $result_peminjaman->fetch_assoc()) {
            $ruangan = $this->getRuangByPeminjamanId(peminjamanId: $peminjaman["peminjaman_id"]);

            $list_peminjaman[] = new Peminjaman(
                peminjamanId: $peminjaman["peminjaman_id"],
                peminjam: new Peminjam(
                    id: $peminjaman["user_id"],
                    username: $peminjaman["username"],
                    email: $peminjaman["email"],
                    password: $peminjaman["password"],
                    role: $peminjaman["level"],
                    userDetails: new UserDetails(
                        nomorInduk: $peminjaman["nomor_induk"],
                        namaLengkap: $peminjaman["nama_lengkap"],
                        alamat: $peminjaman["alamat"],
                        noTelp: $peminjaman["no_telp"],
                        fotoProfil: $peminjaman["foto_profil"],
                    ),
                    instansi: $peminjaman["intansi"],
                    logoInstansi: $peminjaman["logo_instansi"],
                ),
                ruang: $ruangan,
                tanggalPeminjaman: new DateTime($peminjaman["tanggal_peminjaman"]),
                tanggalKegiatanMulai: new DateTime($peminjaman["tanggal_kegiatan_mulai"]),
                tanggalKegiatanSelesai: new DateTime($peminjaman["tanggal_kegiatan_selesai"]),
                jamMulai: new DateTime($peminjaman["jam_mulai"]),
                jamSelesai: new DateTime($peminjaman["jam_selesai"]),
                keterangan: $peminjaman["keterangan"],
                status: $peminjaman["status"]
            );
        }

        return $list_peminjaman;
    }

    /**
     * @param string $user_id
     * @return array
     */
    public function getByUser($user_id)
    {
        $this->database->query(
            sql: "SELECT
            p.id peminjaman_id, p.tanggal_peminjaman, p.tanggal_kegiatan_mulai, p.tanggal_kegiatan_selesai, 
            p.keterangan, p.status, p.jam_mulai, p.jam_selesai, u.id user_id, u.username, u.email, 
            ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil
            FROM peminjaman p
            LEFT OUTER JOIN users u ON u.id = p.user_id
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id
            WHERE p.user_id = ?",
            params: [
                $user_id
            ]
        );

        $result_peminjaman = $this->database->result();
        $list_peminjaman = [];

        while ($peminjaman = $result_peminjaman->fetch_assoc()) {
            $ruangan = $this->getRuangByPeminjamanId(peminjamanId: $peminjaman["peminjaman_id"]);

            $list_peminjaman[] = new Peminjaman(
                peminjamanId: $peminjaman["peminjaman_id"],
                peminjam: new Peminjam(
                    id: $peminjaman["user_id"],
                    username: $peminjaman["username"],
                    email: $peminjaman["email"],
                    userDetails: new UserDetails(
                        nomorInduk: $peminjaman["nomor_induk"],
                        namaLengkap: $peminjaman["nama_lengkap"],
                        alamat: $peminjaman["alamat"],
                        noTelp: $peminjaman["no_telp"],
                        fotoProfil: $peminjaman["foto_profil"],
                    )
                ),
                ruang: $ruangan,
                tanggalPeminjaman: new DateTime($peminjaman["tanggal_peminjaman"]),
                tanggalKegiatanMulai: new DateTime($peminjaman["tanggal_kegiatan_mulai"]),
                tanggalKegiatanSelesai: new DateTime($peminjaman["tanggal_kegiatan_selesai"]),
                jamMulai: new DateTime($peminjaman["jam_mulai"]),
                jamSelesai: new DateTime($peminjaman["jam_selesai"]),
                keterangan: $peminjaman["keterangan"],
                status: $peminjaman["status"]
            );
        }

        return $list_peminjaman;
    }

    /**
     * @param int $peminjaman_id
     * @return Peminjaman
     */
    public function getById($peminjaman_id)
    {
        $this->database->query(
            sql: "SELECT
            p.id peminjaman_id, p.tanggal_peminjaman, p.tanggal_kegiatan_mulai, p.tanggal_kegiatan_selesai, 
            p.keterangan, p.status, p.jam_mulai, p.jam_selesai,
            u.id user_id, u.username, u.email, ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp
            FROM peminjaman p
            LEFT OUTER JOIN users u ON u.id = p.user_id
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id
            WHERE p.id = ?",
            params: [
                $peminjaman_id
            ]
        );

        $peminjaman = $this->database->result()->fetch_assoc();
        $ruangan = $this->getRuangByPeminjamanId(peminjamanId: $peminjaman["peminjaman_id"]);

        return new Peminjaman(
            peminjamanId: $peminjaman["peminjaman_id"],
            peminjam: new Peminjam(
                id: $peminjaman["user_id"],
                username: $peminjaman["username"],
                email: $peminjaman["email"],
                userDetails: new UserDetails(
                    nomorInduk: $peminjaman["nomor_induk"],
                    namaLengkap: $peminjaman["nama_lengkap"],
                    alamat: $peminjaman["alamat"],
                    noTelp: $peminjaman["no_telp"],
                    fotoProfil: $peminjaman["foto_profil"],
                )
            ),
            ruang: $ruangan,
            tanggalPeminjaman: new DateTime($peminjaman["tanggal_peminjaman"]),
            tanggalKegiatanMulai: new DateTime($peminjaman["tanggal_kegiatan_mulai"]),
            tanggalKegiatanSelesai: new DateTime($peminjaman["tanggal_kegiatan_selesai"]),
            jamMulai: new DateTime($peminjaman["jam_mu"]),
            jamSelesai: new DateTime($peminjaman["jam_selesai"]),
            keterangan: $peminjaman["keterangan"],
            status: $peminjaman["status"]
        );
    }

    /**
     * @param int $peminjamanId
     * @return array
     */
    private function getRuangByPeminjamanId($peminjamanId)
    {
        $this->database->query(
            sql: "SELECT kode_ruang FROM detailpeminjaman WHERE peminjaman_id = ?",
            params: [
                $peminjamanId
            ]
        );

        $result = $this->database->result();
        $ruangan = [];

        while ($row = $result->fetch_assoc()) {
            $ruangan[] = new RuangKelas(
                kodeRuang: $row["kode_ruang"],
            );
        }

        return $ruangan;
    }

    /**
     * @param array $peminjaman
     * @return void
     */
    public function update($peminjaman)
    {
        $this->database->query(
            sql: "UPDATE peminjaman SET
                tanggal_kegiatan_mulai = ?,
                tanggal_kegiatan_selesai = ?,
                jam_mulai = ?,
                jam_selesai = ?,
                status = ?
                WHERE id = ?",
            params: [
                $peminjaman["tanggalKegiatanMulai"],
                $peminjaman["tanggalKegiatanSelesai"],
                $peminjaman["jamMulai"],
                $peminjaman["jamSelesai"],
                $peminjaman["status"],
                $peminjaman["peminjamanId"],
            ]
        );
    }

    /**
     * @param int $peminjamanId
     * @return void
     */
    public function delete($peminjamanId)
    {
        $this->database->query(
            sql: 'DELETE FROM detailpeminjaman WHERE peminjaman_id = ?',
            params: [
                $peminjamanId
            ]
        );

        $this->database->query(
            sql: "DELETE FROM peminjaman WHERE id = ?",
            params: [
                $peminjamanId
            ]
        );
    }
}
