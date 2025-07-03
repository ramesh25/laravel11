<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPosition;

class Advertise extends Model
{
    use HasPosition;

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
