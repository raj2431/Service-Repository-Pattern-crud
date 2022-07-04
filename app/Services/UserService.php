<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Save User
     * @param array $data 
     * @return User
     */
    public function saveUser(array $data): User
    {
        $data['password'] =  Hash::make(12345678);
        return $this->userRepository->save($data);
    }
}
