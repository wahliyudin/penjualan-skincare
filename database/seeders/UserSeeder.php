<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'code' => 'ADM-001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(1234567890),
        ]);
    }
}
