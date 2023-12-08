<?php

class Input
{
    public static MySQL $database;

    public static function anti_injection(array $payload): array
    {
        $result = [];
        static::initialize();
        foreach ($payload as $key => $value) {
            $result[$key] = static::$database->verifyInput($value);
        }

        return $result;
    }

    public static function initialize(): void
    {
        static::$database = new MySQL();
    }
}
