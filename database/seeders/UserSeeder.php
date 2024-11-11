<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::create([

            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password'=> bcrypt('password'),
            'id' => 1

        ]);
        User::create([

            'name' => 'rawan',
            'email' => 'rawan@gmail.com',
            'password'=> bcrypt('password1'),
            'id' => 2

        ]);
        User::create([

            'name' => 'kheder',
            'email' => 'kheder@gmail.com',
            'password'=> bcrypt('password2'),
            'id' => 3

        ]);
        User::create([

            'name' => 'aya',
            'email' => 'aya@gmail.com',
            'password'=> bcrypt('password3'),
            'id' => 4

        ]);
        User::create([

            'name' => 'raghad',
            'email' => 'raghad@gmail.com',
            'password'=> bcrypt('password4'),
            'id' => 5

        ]);

        User::create([

            'name' => 'mohamad',
            'email' => 'mohamad@gmail.com',
            'password'=> bcrypt('password5'),
            'id' => 6

        ]);

        User::create([

            'name' => 'bassam',
            'email' => 'bassam@gmail.com',
            'password'=> bcrypt('password6'),
            'id' => 7

        ]);

        User::create([

            'name' => 'mary',
            'email' => 'mary@gmail.com',
            'password'=> bcrypt('password7'),
            'id' => 8

        ]);

        User::create([

            'name' => 'rania',
            'email' => 'rania@gmail.com',
            'password'=> bcrypt('password8'),
            'id' => 9

        ]);

        User::create([

            'name' => 'ar',
            'email' => 'ar@gmail.com',
            'password'=> bcrypt('password9'),
            'id' => 10

        ]);

    }
}
