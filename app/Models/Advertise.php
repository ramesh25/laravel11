<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = [
        'title',
        'image',
        'link',
        'position',
        'publish',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
