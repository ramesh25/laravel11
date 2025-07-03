<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Input;
use App\Traits\HasPosition;

class Menu extends Model
{
    use HasFactory, HasPosition;
    protected $table = 'navs';
    protected $guarded = array('id', 'created_at', 'updated_at', 'search_txt');

    public function submenu() {

        return $this->hasMany('App\Models\Menu', 'parent_id');

    }
 public static function deleteLinkModels($type, $id) {

        $models = Menu::where('type', $type)->where('type_id', $id)->get();
        if (sizeof($models) > 0) {
            foreach ($models as $m) {
                Menu::where('id', $m->id)->delete();
                $childs = Menu::where('parent_id', $m->id)->count();
                if ($childs > 0)
                    Menu::deleteChildModels($m->id);
            }
        }
    }

    public static function deleteChildModels($id) {
        $models = Menu::where('parent_id', $id)->get(array('id'));
        if (sizeof($models) > 0) {
            foreach ($models as $m) {
                Menu::where('id', $m->id)->delete();
                $childs = Menu::where('parent_id', $m->id)->count();
                if ($childs > 0)
                    Menu::deleteChildModels($m->id);
            }
        }
    }
    
}
