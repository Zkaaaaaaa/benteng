<?php

use App\Support\PublicStorage;

if (! function_exists('stored_asset')) {
    function stored_asset(?string $path): ?string
    {
        return PublicStorage::url($path);
    }
}
