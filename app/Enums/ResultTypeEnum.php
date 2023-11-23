<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ResultTypeEnum: string
{
    use EnumOptionsTrait;

    case NORMAL_LIKE_1_COL='normal_like_1_col';
    case NORMAL_LIKE_2_COL='normal_like_2_col';
    case FULL_TEXT_2_COL='full_text_2_col';
    case INDEX_LIKE_1_COL='index_like_1_col';
    case INDEX_LIKE_2_COL='index_like_2_col';
    case FULL_TEXT_INDEX_2_COL='full_text_index_2_col';
    case FULL_TEXT_1_COL='full_text_1_col';
    case FULL_TEXT_1_COL_INDEX='full_text_1_col_index';

}
