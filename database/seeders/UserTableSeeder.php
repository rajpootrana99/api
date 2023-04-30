<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            'phone' => '1234567',
            'is_approved' => 1,
            'password' => Hash::make('password'),
        ]);

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Contact']);
        Role::create(['name' => 'Client']);
        Role::create(['name' => 'Supplier']);

        $user->assignRole('Admin');
    }
}
