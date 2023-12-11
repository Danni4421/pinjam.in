<?php

class Password
{
    private static string $salt = "";

    public static function hash(string $password, $salt_round = 16): string
    {
        static::$salt = bin2hex(random_bytes($salt_round));
        $combined_password = $password . static::$salt;
        return password_hash($combined_password, PASSWORD_BCRYPT);
    }

    public static function get_salt(): string
    {
        return static::$salt;
    }

    public static function compare(string $password, string $hashed_password): bool
    {
        return password_verify($password, $hashed_password);
    }
}
