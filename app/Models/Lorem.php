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
 * @property string title_full_one
 * @property string description_full_one
*/
class Lorem extends Model
{
    use HasFactory;
    protected $fillable= [
        'title', 'description',
        'title_full_one','description_full_one',
        'title_full', 'description_full',
        'title_index', 'description_index',
        'title_full_index', 'description_full_index'
    ];
}
