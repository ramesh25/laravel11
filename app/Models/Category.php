<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\HasPosition;

class Category extends Model
{
    use Sluggable, HasPosition;

    protected $fillable = ['title', 'slug', 'image', 'description', 'display_home', 'meta_title', 'meta_keywords', 'meta_description', 'publish', 'position'];

    public function childs() {

        return $this->hasMany('App\Models\Category', 'parent_id');

    }
}
