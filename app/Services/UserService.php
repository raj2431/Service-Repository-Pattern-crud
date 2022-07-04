<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * To get all users
     */
    public function getAllUsers($perPge): LengthAwarePaginator
    {
        return $this->userRepository->paginate($perPge);
    }

    public function saveUser($data, $id = "")
    {
        return $this->userRepository->save($data);
    }
}
