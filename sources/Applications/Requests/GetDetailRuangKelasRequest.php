<?php

class GetDetailRuangKelasRequest extends Request
{
    public function request(array $payload)
    {
        $ruangKelasService = new RuangKelasRepository(new MySQL());
        $ruangKelasUseCase = new RuangUseCase(
            ruangRepository: $ruangKelasService
        );

        $ruangKelas = $ruangKelasUseCase->getRuanganById($payload["kode_ruang"]);
        return [
            "status" => "success",
            "data" => $ruangKelas->toJSON()
        ];
    }
}
