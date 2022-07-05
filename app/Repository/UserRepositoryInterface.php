<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function find($id): User;
    public function save($data, $id=""): User;
    public function delete($id);
    public function paginate(int $perPage);
    
}
