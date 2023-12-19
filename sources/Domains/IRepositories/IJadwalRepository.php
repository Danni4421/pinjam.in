<?php

interface IJadwalRepository extends Repository
{
  /**
   * @param string $kodeRuang
   * @param int $hari
   * @param int $jamMulai
   * @param int $jamSelesai
   * @return bool
   */
  public function verifyAvailabilityJadwal($kodeRuang, $hari, $jamMulai, $jamSelesai);
}
