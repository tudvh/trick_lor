<?php

namespace App\Enums\User;

use App\Traits\EnumToArray;

enum UserStatus: int
{
    use EnumToArray;

    case REGISTER = 1;
    case VERIFIED = 2;
    case BLOCKED = 3;
}
