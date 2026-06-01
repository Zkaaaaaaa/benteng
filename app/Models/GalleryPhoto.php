<?php

namespace App\Models;

use App\Models\Concerns\HasStoredMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;
    use HasStoredMedia;

    protected $fillable = [
        'name',
        'path',
    ];

    protected static function booted(): void
    {
        static::deleting(function (GalleryPhoto $photo) {
            $photo->deleteStoredMedia($photo->path);
        });
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->mediaUrl($this->path);
    }
}
