<?php

if (! function_exists('asset_version')) {
    /**
     * Asset URL with file modification timestamp for cache busting.
     */
    function asset_version(string $path): string
    {
        $normalized = ltrim($path, '/');
        $fullPath = public_path($normalized);
        $version = is_file($fullPath) ? (string) filemtime($fullPath) : (string) time();

        return asset($normalized).'?v='.$version;
    }
}
