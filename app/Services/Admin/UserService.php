<?php

namespace App\Services\Admin;

use App\Models\User;

class UserService
{
    public function getAll($searchKey, $searchStatus)
    {
        $users = User::where('role', 'user');

        if ($searchStatus != null) {
            $users = $users->where('status', $searchStatus);
        }
        if ($searchKey != null) {
            $searchKey = '%' . str_replace(' ', '%', trim($searchKey))  . '%';
            $users = $users->where(function ($query) use ($searchKey) {
                $query->where('id', 'like', $searchKey)
                    ->orWhere('full_name', 'like', $searchKey)
                    ->orWhere('email', 'like', $searchKey);
            });
        }

        $users = $users->with(['posts'])
            ->orderBy('id', 'desc')
            ->paginate(20);

        return $users;
    }

    public function getByUsername($userName)
    {
        $users = User::where('username', $userName)
            ->where('status', 'verified')
            ->firstOrFail();

        return $users;
    }

    public function getById($userId)
    {
        $user = User::where('id', $userId)
            ->first();

        return $user;
    }

    public function updateStatus($user, $status)
    {
        $user->status = $status;
        $user->save();
    }
}
