<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'], // 検索条件
            [
                'name' => 'テストユーザー',
                'password' => Hash::make('password'),
            ]
        );
    }
}