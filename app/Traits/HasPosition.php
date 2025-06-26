<?php

namespace App\Traits;

trait HasPosition
{
     public static function bootHasPosition()
    {
        static::creating(function ($model) {
            if (empty($model->position)) {
                $model->position = static::max('position') + 1;
            }
        });
    }
}
