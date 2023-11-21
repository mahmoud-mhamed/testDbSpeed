<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ResultSearchTypeEnum: string
{
    use EnumOptionsTrait;
    case FIND='find';
    case FIND_IN_TOP='find_in_top';
    case FIRST='first';
    case LAST='lastByLatest';
    case LAST_BY_ID='lastById';
    case GET='get';
}
