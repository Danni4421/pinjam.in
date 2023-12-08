<?php

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

    public static function verify_auth(): void
    {
        static::verify_cookie();
        if (isset($_SESSION["user"]["level"])) {
            $level = $_SESSION["user"]["level"];
            if (isset($_SERVER["PHP_SELF"])) {
                $path = $_SERVER["PHP_SELF"];

                $base_directory = explode('/', $path);

                if ($level == "admin") {
                    if (!in_array("admin", $base_directory)) {
                        header('Location: /admin/index.php');
                    }
                } elseif ($level == "superadmin") {
                    if (!in_array("superadmin", $base_directory)) {
                        header('Location: /superadmin/index.php');
                    }
                } elseif ($level == "user") {
                    if (array_intersect(["admin", "superadmin"], $base_directory)) {
                        header('Location: /');
                    }
                }
            }
        }
    }

    private static function verify_cookie(): void
    {
        if (!isset($_COOKIE["user_id"])) {
            header('Location: /signout.php');
        }
    }

    public static function logout(): void
    {
        session_unset();
        session_destroy();
        setcookie("user_id", "", -3600, '/');
        header('Location: /signin.php');
    }
}
