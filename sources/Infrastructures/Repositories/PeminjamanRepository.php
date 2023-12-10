<?php

class PeminjamanService implements IPeminjamanService
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
            sql: "INSERT INTO peminjaman (tanggal_kegiatan, keterangan, asal_instansi, status, user_id, kode_ruang, jk_mulai, jk_selesai, logo_instansi) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            params: [
                $peminjaman->getTanggalKegiatan(),
                $peminjaman->getKeterangan(),
                $peminjam->getInstansi(),
                $peminjaman->getStatus(),
                $peminjam->getId(),
                $peminjaman->getJamMulai()->getJkId(),
                $peminjaman->getJamSelesai()->getJkId(),
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
            p.id peminjaman_id, p.tanggal_peminjaman, p.tanggal_kegiatan, p.keterangan, p.status, 
            jkm.jk_id jkm_id, jkm.jam_mulai jkm_mulai, jkm.jam_selesai jkm_selesai, 
            jks.jk_id jks_id, jks.jam_mulai jks_mulai, jks.jam_selesai jks_selesai,
            u.id user_id, u.username, u.email, ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil
            FROM peminjaman p
            LEFT OUTER JOIN users u ON u.id = p.user_id
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id
            LEFT OUTER JOIN jamkuliah jkm ON jkm.jk_id = p.jk_mulai
            LEFT OUTER JOIN jamkuliah jks ON jks.jk_id = p.jk_selesai"
        );

        $result_peminjaman = $this->database->result();
        $list_peminjaman = [];

        while ($peminjaman = $result_peminjaman->fetch_assoc()) {
            $ruangan = $this->getRuangByPeminjamanId(peminjaman_id: $peminjaman["peminjaman_id"]);

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
                tanggalKegiatan: new DateTime($peminjaman["tanggal_kegiatan"]),
                jamMulai: new JamKuliah(
                    jkId: $peminjaman["jkm_id"],
                    jamMulai: $peminjaman["jkm_mulai"],
                    jamSelesai: $peminjaman["jkm_selesai"],
                ),
                jamSelesai: new JamKuliah(
                    jkId: $peminjaman["jks_id"],
                    jamMulai: $peminjaman["jks_mulai"],
                    jamSelesai: $peminjaman["jks_selesai"]
                ),
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
            p.id peminjaman_id, p.tanggal_peminjaman, p.tanggal_kegiatan, p.keterangan, p.status, 
            jkm.jk_id jkm_id, jkm.jam_mulai jkm_mulai, jkm.jam_selesai jkm_selesai, 
            jks.jk_id jks_id, jks.jam_mulai jks_mulai, jks.jam_selesai jks_selesai,
            u.id user_id, u.username, u.email, ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp, ud.foto_profil
            FROM peminjaman p
            LEFT OUTER JOIN users u ON u.id = p.user_id
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id
            LEFT OUTER JOIN jamkuliah jkm ON jkm.jk_id = p.jk_mulai
            LEFT OUTER JOIN jamkuliah jks ON jks.jk_id = p.jk_selesai
            WHERE p.user_id = ?",
            params: [
                $user_id
            ]
        );

        $result_peminjaman = $this->database->result();
        $list_peminjaman = [];

        while ($peminjaman = $result_peminjaman->fetch_assoc()) {
            $ruangan = $this->getRuangByPeminjamanId(peminjaman_id: $peminjaman["peminjaman_id"]);

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
                tanggalKegiatan: new DateTime($peminjaman["tanggal_kegiatan"]),
                jamMulai: new JamKuliah(
                    jkId: $peminjaman["jkm_id"],
                    jamMulai: $peminjaman["jkm_mulai"],
                    jamSelesai: $peminjaman["jkm_selesai"],
                ),
                jamSelesai: new JamKuliah(
                    jkId: $peminjaman["jks_id"],
                    jamMulai: $peminjaman["jks_mulai"],
                    jamSelesai: $peminjaman["jks_selesai"]
                ),
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
            p.id peminjaman_id, p.tanggal_peminjaman, p.tanggal_kegiatan, p.keterangan, p.status, 
            jkm.jk_id jkm_id, jkm.jam_mulai jkm_mulai, jkm.jam_selesai jkm_selesai, 
            jks.jk_id jks_id, jks.jam_mulai jks_mulai, jks.jam_selesai jks_selesai,
            u.id user_id, u.username, u.email, ud.nomor_induk, ud.nama_lengkap, ud.alamat, ud.no_telp
            FROM peminjaman p
            LEFT OUTER JOIN users u ON u.id = p.user_id
            LEFT OUTER JOIN userdetails ud ON ud.user_id = u.id
            LEFT OUTER JOIN jamkuliah jkm ON jkm.jk_id = p.jk_mulai
            LEFT OUTER JOIN jamkuliah jks ON jks.jk_id = p.jk_selesai
            WHERE p.id = ?",
            params: [
                $peminjaman_id
            ]
        );

        $peminjaman = $this->database->result()->fetch_assoc();
        $ruangan = $this->getRuangByPeminjamanId(peminjaman_id: $peminjaman["peminjaman_id"]);

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
            tanggalKegiatan: new DateTime($peminjaman["tanggal_kegiatan"]),
            jamMulai: new JamKuliah(
                jkId: $peminjaman["jkm_id"],
                jamMulai: $peminjaman["jkm_mulai"],
                jamSelesai: $peminjaman["jkm_selesai"],
            ),
            jamSelesai: new JamKuliah(
                jkId: $peminjaman["jks_id"],
                jamMulai: $peminjaman["jks_mulai"],
                jamSelesai: $peminjaman["jks_selesai"]
            ),
            keterangan: $peminjaman["keterangan"],
            status: $peminjaman["status"]
        );
    }

    /**
     * @param int $peminjaman_id
     * @return array
     */
    private function getRuangByPeminjamanId($peminjaman_id)
    {
        $this->database->query(
            sql: "SELECT kode_ruang FROM detailpeminjaman WHERE peminjaman_id = ?",
            params: [
                $peminjaman_id
            ]
        );

        return $this->database->result()->fetch_all();
    }

    /**
     * @param array $peminjaman
     * @return void
     */
    public function update($peminjaman)
    {
        $this->database->query(
            sql: "UPDATE peminjaman SET
                status = ?,
                WHERE id = ?",
            params: [
                $peminjaman["status"],
                $peminjaman["peminjaman_id"],
            ]
        );
    }

    /**
     * @param int $peminjaman_id
     * @return bool
     */
    public function delete($peminjaman_id)
    {
        $this->database->query(
            sql: "DELETE FROM peminjaman
                WHERE status = 'Selesai' AND id = ?",
            params: [
                $peminjaman_id
            ]
        );

        $this->database->query(
            sql: "SELECT id FROM peminjaman WHERE id = ?",
            params: [
                $peminjaman_id
            ]
        );

        return $this->database->result()->num_rows <= 0;
    }
}
