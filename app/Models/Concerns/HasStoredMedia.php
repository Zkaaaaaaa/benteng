<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;

trait HasStoredMedia
{
    public function mediaUrl(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }

    public function deleteStoredMedia(?string $path): void
    {
        if ($path === null || $path === '') {
            return;
        }

        if (
            str_starts_with($path, 'http://')
            || str_starts_with($path, 'https://')
            || str_starts_with($path, 'assets/')
        ) {
            return;
        }

        $diskPath = str_starts_with($path, 'storage/')
            ? substr($path, strlen('storage/'))
            : $path;

        Storage::disk('public')->delete($diskPath);
    }
}
