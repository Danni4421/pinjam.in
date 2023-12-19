<?php

class RequestContainer
{
    private static array $requests = [
        # Requests
        AddDosenRequest::class,
        AddPeminjamanRequest::class,
        AuthenticationRequest::class,
        GetAllRuangRequest::class,
        GetDetailDosenRequest::class,
        UserRequest::class,
        RuangRequest::class,
        PeminjamanRequest::class,
        MataKuliahRequest::class,
        JadwalRequest::class,
        JamKuliahRequest::class,
        FasilitasRequest::class,
        SearchRuangRequest::class,
        UserUpdateFormRequest::class,
    ];

    public static function resolve(string $request)
    {
        if (in_array($request, static::$requests)) {
            $request = new $request();
            return $request;
        }

        return false;
    }
}
