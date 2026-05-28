<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RamesItem extends Model
{
    protected $fillable = [
        'product_id',
        'section',
        'subsection',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
