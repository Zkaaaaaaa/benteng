<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';

    protected $fillable = [
        'title1', 'desc1', 'img1', 'title2', 'desc2', 'img2',
        'store_name1', 'store_name2', 'address1', 'address2', 'phone1', 'phone2',
        'lat_coordinate1', 'lon_coordinate1', 'lat_coordinate2', 'lon_coordinate2',
        'img_store1', 'img_store2', 'store_link1', 'store_link2',
        'email', 'phone', 'address', 'title', 'opening_hour', 'logo',
    ];
}
