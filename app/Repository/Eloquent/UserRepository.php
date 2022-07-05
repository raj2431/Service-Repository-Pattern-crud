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

    public function save($data, $id = ""): User
    {
        $user = $this->model->find($id);
        if (empty($user)) {
            $user = $this->model;
        }
        $user->fill($data);
        $user->save();
        return $user;
    }
    /**
     * TO delete single or multile user
     * @param Int or array $Id
     */
    public function delete($Id)
    {
        return $this->model->destroy([$Id]);
    }

    /**
     * @return Collection
     */
    public function paginate($perPage)
    {
        return $this->model->paginate($perPage);
    }
}
