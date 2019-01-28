<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'Admin@Admin.com',
            'password' => Hash::make('admin'),
            'role' => 2,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'User@User.com',
            'password' => Hash::make('secret'),
            'role' => 1,
        ]);
    }
}
