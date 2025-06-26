<?php

namespace App\Custom\Helpers;
use Illuminate\Support\Arr;
class Helper {

    public static function fileName($file) {
        $explode = explode(".", stripslashes($file));
        return $explode[sizeof($explode) - 2];
    }

    public static function formatDate($date) {
        $date = strtotime($date);
        return date("D, jS  F Y", $date);
    }

    public static function availablePoint($user_id){
        $added_points = \App\Models\Point::where('user_id', $user_id)->sum('added_points');
        $reduced_points = \App\Models\Point::where('user_id', $user_id)->sum('reduced_points');
        $available_points = $added_points - $reduced_points;
        return $available_points;
    }

    public static function leadingZeros($value, $qty) {

        if ($qty - strlen($value) > 0) {
            $data = '';
            $difference = $qty - strlen($value);
            for ($i = 1; $i <= $difference; $i++) {
                $data .= "0";
            }
            return $data . $value;
        } else {
            return $value;
        }
    }


    public static function difficultyLevel($level) {
        switch ($level) {
            case 1 : return 'Pleasure';
                break;
            case 2 : return 'Easy';
                break;
            case 3 : return 'Moderate';
                break;
            case 4 : return 'Streneous';
                break;
            case 5 : return 'Difficult';
                break;
            case 6 : return 'Alpine Climbing';
                break;
            case 7 : return 'Causion About Altitude';
                break;
            default : return 'None';
                break;
        }
    }

    public static function monthName($num) {
        switch ($num) {
            case 1: return "January";
                break;
            case 2: return "February";
                break;
            case 3: return "March";
                break;
            case 4: return "April";
                break;
            case 5: return "May";
                break;
            case 6: return "June";
                break;
            case 7: return "July";
                break;
            case 8: return "August";
                break;
            case 9: return "September";
                break;
            case 10: return "October";
                break;
            case 11: return "November";
                break;
            case 12: return "December";
                break;
            default: return 'Error';
                break;
        }
    }

    public static function extension($file_name) {
        $explode = explode(".", stripslashes($file_name));
        return $extension = $explode[sizeof($explode) - 1];
    }

   public function getCategories(){

            $categories=\App\Models\Menu::where('parent_id', 1)->orderBy('position','asc')->select('id','title','url','type')->where('publish', 1)->get();//united

            $categories=$this->addRelation($categories);

            return $categories;

        }

        protected function selectChild($id)
        {
            $categories=\App\Models\Menu::where('parent_id',$id)->orderBy('position','asc')->select('id','title','url','type')->where('publish', 1)->get(); //rooney

            $categories=$this->addRelation($categories);

            return $categories;

        }

        protected function addRelation($categories){

            $categories->map(function ($item, $key) {
                
                $sub=$this->selectChild($item->id); 
                
                return $item= Arr::add($item, 'subCategory', $sub);

            });

            return $categories;
        }
    }