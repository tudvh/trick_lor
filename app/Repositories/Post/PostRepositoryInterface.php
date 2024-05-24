<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getListForAdmin(array $dataSearch);

    public function getListForUser();

    public function getListForTrending(string $type);

    public function getListByCategoryId(int $categoryId);

    public function getListSuggested(Post $post);

    public function getBySlug(string $slug);
}
