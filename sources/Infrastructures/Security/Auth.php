<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Auth
{
    public static function setAuth(int $id, array $payload): void
    {
        if (!isset($_SESSION["user"])) {
            $_SESSION["user"]["username"] = $payload["username"];
            $_SESSION["user"]["level"] = $payload["level"];
        }

        if (!is_null($id)) {
            $expired_time = time() + 3600;
            setcookie("user_id", $id, $expired_time, '/');
        }
    }

    public static function verify_cookie(): bool
    {
        return isset($_COOKIE["user_id"]);
    }

    public static function logout(): void
    {
        session_unset();
        session_destroy();
        setcookie("user_id", "", -3600, '/');
        header('Location: /login');
    }
}
