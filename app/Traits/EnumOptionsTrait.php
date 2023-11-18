<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait EnumOptionsTrait{
    public static function getOptionData(string $name ='name',string $id='id'): Collection
    {
        return collect(self::cases())->map(function ($row)use($id, $name) {
            $item[$id] = $row;
            $item[$name] = __('base.'.class_basename(__CLASS__)  .'.'. $row->value);
            return $item;
        });
    }
}
