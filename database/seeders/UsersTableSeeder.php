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
                'name'           => 'Admin | NanDaAung',
                'country_code' => "+95",
                'phone'          => '0911111111',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2019-09-10 14:00:26',
                'updated_at'     => '2019-09-10 14:00:26',
            ],
            [
                'name'           => 'Aung Myo Kyaw',
                'country_code' => "+95",
                'phone'          => '0922222222',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2023-08-14 14:00:26',
                'updated_at'     => '2023-08-14 14:00:26',
            ],
            [
                'name'           => 'Customer',
                'country_code' => "+95",
                'phone'          => '0933333333',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2023-08-14 14:00:26',
                'updated_at'     => '2023-08-14 14:00:26',
            ],
            
            [
                'name'           => 'Super Admin',
                'country_code' => "+95",
                'phone'          => '0911111112',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2023-08-14 14:00:26',
                'updated_at'     => '2023-08-14 14:00:26',
            ],
            [
                'name'           => 'Super User',
                'country_code' => "+95",
                'phone'          => '0933333331',
                'password'       => '$2y$10$qyxYm.2dlaXROvs0OrGHseo4qbeissRMqNWdhlcr/vUqE62vN94Fi', // password
                'remember_token' => null,
                'created_at'     => '2023-08-14 14:00:26',
                'updated_at'     => '2023-08-14 14:00:26',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}