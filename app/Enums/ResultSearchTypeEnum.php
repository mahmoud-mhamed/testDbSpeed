<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ResultSearchTypeEnum: string
{
    use EnumOptionsTrait;
    case LIKE='like';
    case FIND='find';
    case FIRST='first';
    case LAST='lastByLatest';
    case LAST_BY_ID='lastById';
}
