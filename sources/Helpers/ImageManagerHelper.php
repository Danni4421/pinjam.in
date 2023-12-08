<?php

class ImageManagerHelper
{
    private static string $base_path = "resources/images/uploads";
    private static array $type_allowed = ["jpg", "jpeg", "png", ".img"];
    private static int $max_size = 1 * 1024 * 1024;

    public static function move(string $type, string $filename, string $key): string
    {
        $target_path = static::$base_path;
        $postfix = time() . "-" . $filename;

        switch ($type) {
            case "profile":
                $target_path = static::$base_path . "/profiles//" . $postfix;
                break;
            case "peminjaman":
                $target_path = static::$base_path . "/instansi//" . $postfix;
                break;
            case "ruang-dosen":
                $target_path = static::$base_path . '/ruang//dosen/' . $postfix;
                break;
            case "ruang-kelas":
                $target_path = static::$base_path . '/ruang//kelas/' . $postfix;
                break;
        }

        if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_path)) {
            return $target_path;
        } else {
            MessageHelper::message("Error", "danger", "Gagal menambahkan foto");
            return "";
        }
    }

    public static function remove(string $file_path): void
    {
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    public static function get(string $path, string $type): string
    {
        if (!empty($path)) {
            return $path;
        }

        switch ($type) {
            case "profile":
                return static::$base_path . '\\profiles\\' . 'profile.jpg';
            case "form":
                return static::$base_path . '\\instansi\\' . 'default-instansi.jpg';
            case "ruang":
                return static::$base_path . '/../japan-road.png';
            default:
                return "";
        }
    }

    public static function verify(string $type, int $size): bool
    {
        if (!in_array($type, static::$type_allowed)) {
            MessageHelper::message('Error Tipe', 'warning', 'Gambar yang Anda masukkan tidak valid.');
            return false;
        }

        if ($size > static::$max_size) {
            MessageHelper::message('Ukuran Gambar', 'danger', 'Terlalu Besar!');
            return false;
        }

        return true;
    }
}
