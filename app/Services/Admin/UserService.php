<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\UserService as BaseUserService;

class UserService extends BaseUserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    /**
     * Get list
     *
     * @param array $dataSearch
     *
     * @return LengthAwarePaginator
     */
    public function getList(array $dataSearch): LengthAwarePaginator
    {
        return $this->userRepository->getList($dataSearch);
    }

    public function getByUsername($userName)
    {
        $users = User::where('username', $userName)
            ->where('status', 'verified')
            ->firstOrFail();

        return $users;
    }

    /**
     * Find by id
     *
     * @param int $id
     *
     * @return User
     */
    public function findById(int $id): User
    {
        return $this->userRepository->findBy($id, 'id');
    }
}
