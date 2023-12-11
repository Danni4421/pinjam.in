<?php

class FilterRuangRequest extends Request
{
    public function request(array $payload)
    {
        $ruangKelasRepository = new RuangKelasRepository(new MySQL());
        $ruangDosenRepository = new RuangDosenRepository(new MySQL());
        $ruangKelasUseCase = new RuangUseCase(ruangRepository: $ruangKelasRepository);
        $ruangDosenUseCase = new RuangUseCase(ruangRepository: $ruangDosenRepository);

        $ruangan = [];

        switch ($payload["filter_input"]) {
            case "rk":
                $ruangan = $ruangKelasUseCase->getRuangan();
                break;
            case "rd":
                $ruangan = $ruangDosenUseCase->getRuangan();
                break;
            default:
                $ruangan = [
                    ...$ruangDosenUseCase->getRuangan(),
                    ...$ruangKelasUseCase->getRuangan(),
                ];
                break;
        }

        $list_ruang = [];

        foreach ($ruangan as $ruang) {
            $list_ruang[] = $ruang->toJSON();
        }

        return [
            "status" => "success",
            "data" => $list_ruang,
        ];
    }
}
