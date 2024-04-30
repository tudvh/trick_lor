<?php

namespace App\Enums\User;

use App\Traits\EnumToArray;

enum UserStatusText: string
{
    use EnumToArray;

    case REGISTER = 'Đã đăng ký';
    case VERIFIED = 'Đã xác minh';
    case BLOCKED = 'Bị cấm';
}
