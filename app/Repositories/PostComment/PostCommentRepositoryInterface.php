<?php

namespace App\Repositories\PostComment;

use App\Repositories\RepositoryInterface;

interface PostCommentRepositoryInterface extends RepositoryInterface
{
    public function getList(array $dataSearch);
}
