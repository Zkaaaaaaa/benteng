<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamesSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_nl',
        'title_en',
        'subtitle_nl',
        'subtitle_en',
        'small_title_nl',
        'small_title_en',
        'large_title_nl',
        'large_title_en',
        'small_price',
        'large_surcharge',
        'small_desc',
        'large_desc',
        'instruction_nl',
        'instruction_en',
        'button_label_nl',
        'button_label_en',
        'bottom_title_nl',
        'bottom_title_en',
        'bottom_text_nl',
        'bottom_text_en',
    ];

    protected function casts(): array
    {
        return [
            'small_price' => 'decimal:2',
            'large_surcharge' => 'decimal:2',
        ];
    }
}
