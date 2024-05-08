<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => 'admin address',
                'contact' => '13456890',
                'username' => 'admin',
                'profile_picture' => 'admin',
                'role_id' => 1,
                'dob' => '1988-02-01',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'name' => 'rupesh',
                'email' => 'rupesh@customer.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => 'rupesh sejgaya address',
                'contact' => '13456890',
                'username' => 'rupesh',
                'profile_picture' => 'admin',
                'role_id' => 2,
                'dob' => '1998-06-27',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        ]);
    }
}
