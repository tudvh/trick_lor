<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    /**
     * Get list
     *
     * @param array $dataSearch
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
     * @return User
     */
    public function findById(int $id): User
    {
        return $this->userRepository->findBy($id, 'id');
    }

    /**
     * Update
     *
     * @param User $user
     * @param array $attributes
     * @return void
     */
    public function update(User $user, array $attributes): void
    {
        $this->userRepository->update($user, $attributes);
    }
}
