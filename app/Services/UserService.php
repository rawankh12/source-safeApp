<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class UserService
{
    protected $userRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getUserById(int $id)
    {
        return $this->userRepository->findById($id);
    } 
    public function createUser(array $data)
    {
        $user = new \App\Models\User($data);
        return $this->userRepository->save($user);
    }
}
