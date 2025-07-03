<?php

use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class TreeHelper {

    public static $level = 0;
    private static $option_array = array();
    private static $id_array = array();
    public static $result = null;
    public static $actives = null;

    public static function selectOptions($table, $base_id, $id = null, $terms = NULL, $order_by = NULL, $order = NULL) {
        if (!$terms)
            $terms = '1=1';

        if ($id) {
            $models = DB::table($table)
                    ->where('id', '!=', $id)
                    ->where('parent_id', $base_id)
                    ->whereRaw($terms)
                    ->orderBy($order_by, $order)
                    ->get(array('id', 'parent_id', 'title'));
        } else {

            $models = DB::table($table)
                    ->where('parent_id', $base_id)
                    ->whereRaw($terms)
                    ->orderBy($order_by, $order)
                    ->get(array('id', 'parent_id', 'title'));
        }
        if (sizeof($models) > 0) {
            foreach ($models as $m) {
                $title_prefix = TreeHelper::getTitlePrefix(self::$level);
                self::$option_array[$m->id] = $title_prefix . $m->title;
                $childs = DB::table($table)
                        ->where('parent_id', $m->id)
                        ->whereRaw($terms)
                        ->orderBy($order_by, $order)
                        ->get(array('id', 'parent_id', 'title'));

                if (sizeof($childs) > 0) {
                    self::$level++;
                    TreeHelper::selectOptions($table, $m->id, $id, $terms, $order_by, $order);
                    self::$level--;
                }
            }
            return self::$option_array;
        } else {
            return array();
        }
    }

    public static function getTitlePrefix($level) {
        $prefix = null;
        for ($i = 0; $i <= $level; $i++) {
            $prefix .= ' - - - ';
        }
        return $prefix;
    }

    public static function menuAdmin($table, $base_id, $uri) {
        $models = DB::table($table)
                ->where('parent_id', $base_id)
                ->orderBy('position', 'asc')
                ->get(array('id', 'parent_id', 'title'));

        if (sizeof($models) > 0) {
            self::$result .= '<ul>';
            foreach ($models as $m) {

                $childs = DB::table($table)
                        ->where('parent_id', $m->id)
                        ->orderBy('position', 'asc')
                        ->get(array('id'));


                self::$result .= "<li>";
                if (sizeof($childs) > 0) {
                    self::$result .= "<a href=" . URL::to($uri, array('id' => $m->id)) . ">" . $m->title . "</a>";
                    TreeHelper::menuAdmin($table, $m->id, $uri);
                } else {
                    //self::$result.= link_to($uri.'/'.$m->id, $m->title);
                    self::$result .= "<a href=" . URL::to($uri, array('id' => $m->id)) . ">" . $m->title . "</a>";
                }
                self::$result .= '</li>';
            }
            self::$result .= '</ul>';
        }
        return self::$result;
    }

    public static function menu($base_id, $id = NULL, $class = NULL, $current_class = NULL) {
        $models = Menu::where('parent_id', $base_id)
                ->where('publish', 1)
                ->orderBy('position', 'asc')
                ->get();

        if (sizeof($models) > 0) {
            if (self::$level == 0) {
                    self::$result .= '<ul>';
            } else
                self::$result .= '<ul>';
            self::$level++;
            foreach ($models as $m) {

                $childs = Menu::where('parent_id', $m->id)
                        ->where('publish', 1)
                        ->orderBy('position', 'asc')
                        ->get(array('id'));
                 if (sizeof($childs) > 0) {
                self::$result .= $m->url == Request::path() ? '<li class="submenu" ' . $current_class . '">' : '<li class="submenu">';
                }else{
                    self::$result .= $m->url == Request::path() ? '<li class="' . $current_class . '">' : '<li>';
                }
                if (sizeof($childs) > 0) {
                    if ($m->type == 'none')
                        self::$result .= '<a href="javascript:void(0);">' . $m->title . '</a>';
                    else {
                        $target = $m->target ? "_blank" : "_self";
                        self::$result .= '<a href="' . URL::to($m->url) . '" target="' . $target . '" class="show-submenu">' . $m->title . '</a>';
                    }
                    TreeHelper::menu($m->id, $id, $class, $current_class);
                } else {
                    if ($m->type == 'none')
                        self::$result .= '<a href="javascript:void(0);">' . $m->title . '</a>';
                    else {
                        $target = $m->target ? "_blank" : "_self";
                        self::$result .= '<a href="' . URL::to($m->url) . '" target="' . $target . '">' . $m->title . '</a>';
                    }

                }
                self::$result .= '</li>';
            }
            self::$result .= '</ul>';
        }
        return self::$result;
    }

    public static function checkbox($name, $checkeds, $table, $base_id = NULL, $terms = NULL, $order_by = NULL, $order = NULL)
        {
            if (!$terms)
                $terms = '1=1';

            $models = DB::table($table)
                ->where('parent_id', $base_id)
                ->whereRaw($terms)
                ->orderBy($order_by, $order)
                ->get();

            if ($models->count() > 0) {
                self::$result .= '<ul class="ml-4 space-y-1">';
                foreach ($models as $m) {

                    $childs = DB::table($table)
                        ->where('parent_id', $m->id)
                        ->whereRaw($terms)
                        ->orderBy($order_by, $order)
                        ->get();

                    $checked = in_array($m->id, $checkeds) ? 'checked' : '';

                    self::$result .= '<li>';
                    self::$result .= '<label class="inline-flex items-center space-x-2">';
                    self::$result .= "<input type=\"checkbox\" name=\"{$name}\" value=\"{$m->id}\" class=\"rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-200\" {$checked}>";
                    self::$result .= "<span class=\"text-gray-700\">{$m->title}</span>";
                    self::$result .= '</label>';

                    if ($childs->count() > 0) {
                        TreeHelper::checkbox($name, $checkeds, $table, $m->id, $terms, $order_by, $order);
                    }

                    self::$result .= '</li>';
                }
                self::$result .= '</ul>';
            }

            return self::$result;
        }

    public static function id($table, $id, $terms = NULL, $order_by = NULL, $order = NULL) {
        if (!$terms)
            $terms = '1=1';

        if (self::$level == 0) {
            self::$id_array[] = $id;
        }

        $models = DB::table($table)
                ->where('parent_id', $id)
                ->whereRaw($terms)
                ->orderBy($order_by, $order)
                ->get();

        if (sizeof($models) > 0) {
            foreach ($models as $m) {
                self::$level++;
                self::$id_array[] = $m->id;
                $childs = DB::table($table)
                        ->where('parent_id', $m->id)
                        ->whereRaw($terms)
                        ->orderBy($order_by, $order)
                        ->get(array('id'));
                if (sizeof($childs) > 0) {
                    TreeHelper::id($table, $m->id, $terms, $order_by, $order);
                }
            }
        }

        return self::$id_array;
    }



    public static function trips($name, $cds, $table, $terms=NULL, $order_by=NULL, $order=NULL)
    {
        if(!$terms)$terms='1=1';

        $models=DB::table($table)
            ->whereRaw($terms)          
            ->orderBy($order_by, $order)
            ->get();
        if(!empty($models))
        {   
            self::$actives.= '<ul>';        
                foreach ($models as $m)
                {            
                 $check = in_array($m->id, $cds) ? true : false;
                    self::$actives.= "<li>";                                            
                    self::$actives.= Form::checkbox($name, $m->id,$check).' '.$m->title;
                    
                    self::$actives.= '</li>';
                    
                }
            self::$actives.= '</ul>';
        }
    
        return self::$actives;

    }   

}
