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
    public function createOrUpdateUser(array $data, $id = ""): User
    {
        $data['password'] =  Hash::make(12345678);
        return $this->userRepository->save($data,$id);
    }

    /**
     * To get single user by id
     * @param int $id
     * @return User
     */
    public function getUserById($id): User
    {
        return $this->userRepository->find($id);
    }


    /**
     * To get single user by id
     * @param int $id
     * @return User
     */
    public function deleteSingleOrMultipleUser($id)
    {
       return $this->userRepository->delete($id);
    }

}
