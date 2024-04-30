<?php

namespace App\Enums\User;

use App\Traits\EnumToArray;

enum UserRole: int
{
    use EnumToArray;

    case ADMIN = 1;
    case USER = 2;
}
