<?php

namespace App\Enums\Post;

use App\Traits\EnumToArray;

enum PostStatus: int
{
    use EnumToArray;

    case WAITING = 1;
    case PUBLIC = 2;
    case PRIVATE = 3;
    case BLOCKED = 4;
}
