<?php

namespace App\Contracts\Repositories;

interface UserRepositoryInterface
{
    public function find($id);
    public function countByRole(string $role);
    public function countAll();
    public function update($user, array $data);
}
