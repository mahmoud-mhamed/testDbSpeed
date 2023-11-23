<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ResultTypeEnum: string
{
    use EnumOptionsTrait;

    case NORMAL_LIKE_ONE_COLUMN='normal_like_one_column';
    case NORMAL_LIKE_TWO_COLUMN='normal_like_two_column';
    case FULL_TEXT='full_text';
    case INDEX_LIKE_ONE_COLUMN='index_like_one_column';
    case FULL_TEXT_INDEX='full_text_index';

}
