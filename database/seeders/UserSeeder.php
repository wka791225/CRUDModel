<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\VerificationHistory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            (object) [
                'name' => '最高管理員',
                'email' => 'digipPack@gmail.com',
                'role' => 0,
                'password' => 'Logo@61213906',
            ],
            (object) [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 1,
                'password' => 'Logo20240417',
            ],
            (object) [
                'name' => 'manage',
                'email' => 'manage@gmail.com',
                'role' => 2,
                'password' => 'Logo20240428',
            ],
            (object) [
                'name' => 'Editor',
                'email' => 'editor@gmail.com',
                'role' => 5,
                'password' => 'Logo20240429',
            ],
        ];

        foreach ($data as $value) {
            User::create([
                'name' => $value->name,
                'email' => $value->email,
                'role' => $value->role,
                'email_verified_at' => now(),
                'password' => Hash::make($value->password),
                'status' => 1, // 啟用
            ]);
        }
    }
}
