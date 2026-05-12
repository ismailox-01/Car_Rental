<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@carrental.com',
            'password'          => Hash::make('password'),
            'role'              => 'admin',
            'phone'             => '+1-555-0100',
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);

        // Demo customer
        User::create([
            'name'              => 'John Doe',
            'email'             => 'customer@carrental.com',
            'password'          => Hash::make('password'),
            'role'              => 'customer',
            'phone'             => '+1-555-0200',
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
    }
}
