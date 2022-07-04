<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function find($id): User;
    public function save($data): User;
    public function paginate(int $perPage);
}
