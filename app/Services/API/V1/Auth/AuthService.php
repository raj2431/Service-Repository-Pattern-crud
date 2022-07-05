<?php

namespace App\Services\API\V1\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthService
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Save User
     * @param array $data 
     * @return User
     */
    public function signup(array $data): User
    {
        $data['password'] =  Hash::make($data['password']);
        return $this->userRepository->save($data);
    }

    public function signin($data)
    {
        return Auth::attempt(['email'=>$data['email'], 'password' => $data['password']]);
    }

}
