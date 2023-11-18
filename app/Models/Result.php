<?php

namespace App\Models;

use App\Enums\ResultSearchTypeEnum;
use App\Enums\ResultTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string search_key
 * @property string time
 * @property string query
 * @property string type
*/
class Result extends Model
{
    protected $fillable= [
        'search_type',
        'search_key', 'time', 'query', 'type',
    ];

    protected $casts=[
        'search_type'=>ResultSearchTypeEnum::class,
        'type'=>ResultTypeEnum::class
    ];

}
