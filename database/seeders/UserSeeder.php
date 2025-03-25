<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $adminRole = Role::where('slug', 'admin')->first();
        $userRole = Role::where('slug', 'user')->first();

        User::create([
            'name' => 'Manager',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);
        

 
        User::create([
            'name' => 'user user',
            'email' => 'user@example.com',
            'password' => Hash::make('passwordi'),
            'role_id' => $userRole->id,
            'email_verified_at' => now(),
        ]);
    }
}
