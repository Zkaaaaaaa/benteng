<?php

namespace App\Models;

use App\Support\PublicStorage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
    ];

    protected static function booted(): void
    {
        static::deleting(function (GalleryPhoto $photo) {
            PublicStorage::delete($photo->path);
        });
    }

    public function getImageUrlAttribute(): ?string
    {
        return PublicStorage::url($this->path);
    }
}
