<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findById(int $id);
    public function findAll();
    public function save($user);
    public function delete(int $id);
    
}
