<?php

class RequestContainer
{
    private static array $requests = [
        # Requests
        GetAllRuangRequest::class,
        GetDetailRuangKelasRequest::class,
        GetDetailRuangDosenRequest::class,
        FilterRuangRequest::class,
        SearchRuangRequest::class,
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
