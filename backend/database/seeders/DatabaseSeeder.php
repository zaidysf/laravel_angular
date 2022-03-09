<?php

namespace Database\Seeders;

use App\Enums\UserTypes;
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
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@laravel.com',
            'password' => Hash::make('12345678'),
            'user_type' => UserTypes::Admin,
        ]);
    }
}
