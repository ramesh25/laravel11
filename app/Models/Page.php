<?php

namespace App\Models;
use App\Traits\Sluggable;
use App\Traits\HasPosition;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Sluggable, HasPosition;

    protected $fillable =['title', 'slug', 'image', 'description', 'publish', 'position', 'created_at', 'updated_at'];

}
