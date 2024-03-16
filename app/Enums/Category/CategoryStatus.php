<?php

namespace App\Enums\Category;

use App\Traits\EnumToArray;

enum CategoryStatus: int
{
    use EnumToArray;

    case PUBLIC = 1;
    case PRIVATE = 0;
}
