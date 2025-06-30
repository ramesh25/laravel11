<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\HasPosition;

class News extends Model
{

    use Sluggable, HasPosition;

    protected $fillable =['title', 'slug', 'image', 'description', 'highlited_news', 'publish', 'position', 'created_at', 'updated_at'];

    public function categories() {

        return $this->belongsToMany('App\Models\Category', 'category_news', 'news_id', 'category_id');
        
    }

    //delete pivot data while deleting news
    protected static function boot(){
        parent::boot();

        static::deleting(function ($news) {
            $news->categories()->detach();
        });
    }

}
