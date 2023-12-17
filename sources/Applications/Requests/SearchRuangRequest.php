<?php

class SearchRuangRequest extends Request
{
    public function request(array $payload)
    {
        if (empty($payload["search_input"])) {
            return [
                "status" => "fail",
            ];
        }

        $ruangRepository = new RuangKelasRepository(new MySQL());
        $ruangUseCase = new RuangUseCase(ruangRepository: $ruangRepository);

        $ruangan = $ruangUseCase->searchRuang($payload["search_input"]);
        $list_ruang = [];

        foreach ($ruangan as $ruang) {
            $list_ruang[] = $ruang->toArray();
        }

        return [
            "status" => "success",
            "data" => $list_ruang,
        ];
    }
}
