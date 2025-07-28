<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'title_main',
        'title_highlight',
        'description',
        'address',
        'phone_1',
        'phone_2',
        'opening_hours',
        'telegram_link',
        'map_embed_url',
        'map_directions_link',
    ];
}
