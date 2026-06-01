<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PublicStorage
{
    /**
     * Path relatif pada disk public (tanpa prefix storage/).
     * Null jika path bukan file di storage (assets/, URL, dll.).
     */
    public static function diskPath(?string $stored): ?string
    {
        if ($stored === null || $stored === '') {
            return null;
        }

        if (self::isExternalOrAsset($stored)) {
            return null;
        }

        $path = $stored;

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        return $path;
    }

    public static function store(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, 'public');
    }

    public static function delete(?string $stored): void
    {
        $path = self::diskPath($stored);

        if ($path !== null && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public static function url(?string $stored): ?string
    {
        if ($stored === null || $stored === '') {
            return null;
        }

        if (str_starts_with($stored, 'http://') || str_starts_with($stored, 'https://')) {
            return $stored;
        }

        if (str_starts_with($stored, 'assets/')) {
            return asset($stored);
        }

        $path = self::diskPath($stored);

        if ($path === null) {
            return null;
        }

        return asset('storage/'.$path);
    }

    private static function isExternalOrAsset(string $stored): bool
    {
        return str_starts_with($stored, 'http://')
            || str_starts_with($stored, 'https://')
            || str_starts_with($stored, 'assets/');
    }
}
