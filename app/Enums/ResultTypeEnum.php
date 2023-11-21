<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ResultTypeEnum: string
{
    use EnumOptionsTrait;

    case NORMAL_LIKE_ONE_COLUMN='normal_like_one_column';
    case FULL_TEXT_LIKE='FULL_TEXT_LIKE';
    case INDEX_LIKE_ONE_COLUMN='index_like_one_column';
    case FULL_TEXT_INDEX_LIKE='full_text_index_like';

}
