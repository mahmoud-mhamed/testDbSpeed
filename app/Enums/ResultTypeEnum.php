<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ResultTypeEnum: string
{
    use EnumOptionsTrait;

    case NORMAL_LIKE_1COL='normal_like_1col';
    case NORMAL_LIKE_2COL='normal_like_2col';
    case FULL_TEXT_2COL='full_text_2col';
    case INDEX_LIKE_1COL='index_like_1col';
    case INDEX_LIKE_2COL='index_like_2col';
    case FULL_TEXT_INDEX_2COL='full_text_index_2col';
    case FULL_TEXT_1COL='full_text_1_col';
    case FULL_TEXT_1_COL_INDEX='full_text_1col_index';

}
