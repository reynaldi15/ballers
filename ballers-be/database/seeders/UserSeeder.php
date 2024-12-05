<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => '1',
            'name' => 'Admin',
            'address' => 'Jakarta Barat',
            'phoneNumber' => '081112131415',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testing123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => '2',
            'name' => 'Buyer',
            'address' => 'Jakarta Barat',
            'phoneNumber' => '081112131415',
            'email' => 'buyer@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testing123'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'role_id' => '3',
            'name' => 'Seller',
            'address' => 'Jakarta Barat',
            'phoneNumber' => '081112131415',
            'email' => 'seller@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testing123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
