<?php

class GetAllRuangRequest extends Request
{
    public function request(array $payload)
    {
        $ruangKelasRepository = new RuangKelasRepository(new MySQL());
        $ruangDosenRepository = new RuangDosenRepository(new MySQL());
        $ruangKelasUseCase = new RuangUseCase(ruangRepository: $ruangKelasRepository);
        $ruangDosenUseCase = new RuangUseCase(ruangRepository: $ruangDosenRepository);

        $ruangKelas = $ruangKelasUseCase->getRuangan();
        $ruangDosen = $ruangDosenUseCase->getRuangan();

        $list_ruang = [];

        foreach ($ruangKelas as $ruang) {
            $list_ruang[] = $ruang->toArray();
        }

        foreach ($ruangDosen as $ruang) {
            $list_ruang[] = $ruang->toArray();
        }

        return [
            "status" => "success",
            "data" => $list_ruang,
        ];
    }
}
