<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{

    /**      
     * @var Model      
     */
    protected $model;
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return User
     */

    public function find($id): User
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return User
     */

    public function save($data): User
    {
        return $this->model->create($data);
    }

    /**
     * @return Collection
     */
    public function paginate($perPage)
    {
        return $this->model->paginate($perPage);
    }
}
