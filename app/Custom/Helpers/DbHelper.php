<?php

use Illuminate\Support\Facades\Request;
use App\Http\Requests;

class DbHelper {

    public static function dragDropSorting() {
        $sort_orders = explode(',', Request::get('sort_orders'));
        $ids_order = Request::get('ids_order');

        $ids_order = str_replace('sortable[]=', '', $ids_order);
        $ids_order = substr($ids_order, 1);
        $ids_order = explode('&', $ids_order);

        for ($i = 0; $i < sizeof($ids_order); $i++) {
            DB::table(Request::get('table'))
                    ->where('id', $ids_order[$i])
                    ->update(array('position' => $sort_orders[$i]));
        }
    }

    public static function nextSortOrder($table) {
        return DB::table($table)->max('position') + 1;
    }

    public static function updateField() {
        $field_id = strip_tags(trim(Request::get('field_id')));
        $value = strip_tags(trim(Request::get('value')));
        $split_data = explode(':', $field_id);
        $id = $split_data[1];
        $field = $split_data[0];
        if (!empty($id) && !empty($field) && !empty($value)) {
            DB::table(Request::get('table'))
                    ->where('id', $id)
                    ->update(array($field => $value));
        }
    }

    public static function resetSortOrder($table) {
        $models = DB::table($table)->select('id')->orderBy('id', 'asc')->get();
        $i = 1;
        foreach ($models as $m) {
            DB::table($table)->where('id', $m->id)->update(array('position' => $i));
            $i++;
        }
    }
    


}
