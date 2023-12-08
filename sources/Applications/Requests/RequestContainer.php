<?php

class RequestContainer
{
    private static array $requests = [
        /***
     * Requests
     */
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
