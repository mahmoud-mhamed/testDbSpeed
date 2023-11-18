<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property string title_full
 * @property string description_full
 * @property string title
 * @property string description
 * @property string title_index
 * @property string description_index
 * @property string title_full_index
 * @property string description_full_index
*/
class TestFullText extends Model
{
    use HasFactory;
    protected $fillable= [
        'title_full', 'description_full',
        'title', 'description',
        'title_index', 'description_index',
        'title_full_index', 'description_full_index'
    ];
}
