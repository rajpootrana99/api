<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin G',
            'email' => 'admin@admin.com',
            'is_admin' => 1,
            'is_approved' => 1,
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'User',
            'email' => 'user@user.com',
            'is_admin' => 0,
            'is_approved' => 0,
            'password' => Hash::make('12345678'),
        ]);
    }
}
