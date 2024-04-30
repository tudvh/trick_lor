<?php

namespace App\Repositories\User;

use App\Enums\User\UserRole;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    /**
     * Get list
     *
     * @param array $dataSearch
     * @return LengthAwarePaginator
     */
    public function getList(array $dataSearch): LengthAwarePaginator
    {
        return $this->model
            ->withCount(['posts'])
            ->where('role', UserRole::USER)
            ->when(!empty($dataSearch['key']), function ($query) use ($dataSearch) {
                $key = '%' . str_replace(' ', '%', trim($dataSearch['key']))  . '%';
                return $query->where('id', 'like', $key)
                    ->orWhere('full_name', 'like', $key)
                    ->orWhere('email', 'like', $key);
            })
            ->when(!empty($dataSearch['status']), function ($query) use ($dataSearch) {
                return $query->where('status', $dataSearch['status']);
            })
            ->orderBy($dataSearch['sort_column'] ?? 'id', $dataSearch['sort_type'] ?? 'desc')
            ->paginate(config('define.pagination.default'));
    }
}
