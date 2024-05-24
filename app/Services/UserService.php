<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\BaseService;

abstract class UserService extends BaseService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    /**
     * Update
     *
     * @param User $user
     * @param array $attributes
     *
     * @return void
     */
    public function update(User $user, array $attributes): void
    {
        $this->userRepository->update($user, $attributes);
    }
}
