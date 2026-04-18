<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function find($id)
    {
        return User::find($id);
    }

    public function countByRole(string $role)
    {
        return User::where('role', $role)->count();
    }

    public function countAll()
    {
        return User::count();
    }

    public function update($user, array $data)
    {
        $user->update($data);
        return $user;
    }
}
