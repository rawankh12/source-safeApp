<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface {
    public function findById(int $id) {
        return User::find($id);
    }

    public function findAll() {
        return User::all();
    }

    public function save($user) {
        $user->save();
        return $user;
    }

    public function delete(int $id) {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return $user;
    }
}
