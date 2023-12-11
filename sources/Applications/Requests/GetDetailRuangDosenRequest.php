<?php

class GetDetailRuangDosenRequest extends Request
{
    public function request(array $payload)
    {
        $ruangDosenService = new RuangDosenRepository(new MySQL());
        $ruangDosenUseCase = new RuangUseCase(ruangRepository: $ruangDosenService);

        $ruangDosen = $ruangDosenUseCase->getRuanganById($payload["kode_ruang"]);

        return [
            "status" => "success",
            "data" => $ruangDosen->toJSON(),
        ];
    }
}
