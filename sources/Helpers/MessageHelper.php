<?php

class MessageHelper
{
    public static function message(string $key, string $status, string $message): void
    {
        if (!empty($status) && !empty($message)) {
            $_SESSION["message"][$key] =
                "<div class='alert alert-{$status} alert-dismissible fade show' role='alert'>
                    <strong>{$key}!</strong> {$message}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    }

    public static function get_message(?string $key)
    {
        if (!empty($key) && isset($_SESSION["message"][$key])) {
            $message = $_SESSION["message"][$key];
            unset($_SESSION["message"][$key]);
            return $message;
        }
    }

    public static function load(): void
    {
        if (isset($_SESSION["message"])) {
            foreach ($_SESSION["message"] as $key => $value) {
                echo MessageHelper::get_message($key);
            }
        }
    }
}
