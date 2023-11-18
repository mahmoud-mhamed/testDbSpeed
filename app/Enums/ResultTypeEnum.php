<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ResultTypeEnum: string
{
    use EnumOptionsTrait;

    case NORMAL='normal';
    case FULL_TEXT='full_text';
    case INDEX='index';
    case FULL_TEXT_INDEX='full_text_index';

}
