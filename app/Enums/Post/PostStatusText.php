<?php

namespace App\Enums\Post;

use App\Traits\EnumToArray;

enum PostStatusText: string
{
    use EnumToArray;

    case WAITING = 'Đang chờ duyệt';
    case PUBLIC = 'Công khai';
    case PRIVATE = 'Riêng tư';
    case BLOCKED = 'Bị cấm';
}
