<?php

namespace App\Services\Site;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\UserService as BaseUserService;

class UserService extends BaseUserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    /**
     * Find by verification token
     *
     * @param string $token
     *
     * @return User
     */
    public function findByVerificationToken(string $token): User|null
    {
        return $this->userRepository->findBy($token, 'verification_token');
    }
}
