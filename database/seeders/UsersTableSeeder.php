<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin | NanDaAung',
                'email'          => 'delight@gmail.com',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2019-09-10 14:00:26',
                'updated_at'     => '2019-09-10 14:00:26',
            ],
            [
                'id'             => 2,
                'name'           => 'Aung Myo Kyaw',
                'email'          => 'user@gmail.com',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2023-08-14 14:00:26',
                'updated_at'     => '2023-08-14 14:00:26',
            ],
            [
                'id'             => 3,
                'name'           => 'Customer',
                'email'          => 'customer@gmail.com',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2023-08-14 14:00:26',
                'updated_at'     => '2023-08-14 14:00:26',
            ],
            
            [
                'id'             => 4,
                'name'           => 'Super Admin',
                'email'          => 'superadmin@gmail.com',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2023-08-14 14:00:26',
                'updated_at'     => '2023-08-14 14:00:26',
            ],
            [
                'id'             => 5,
                'name'           => 'Super User',
                'email'          => 'superuser@gmail.com',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2023-08-14 14:00:26',
                'updated_at'     => '2023-08-14 14:00:26',
            ]

        ];

        User::insert($users);
    }
}