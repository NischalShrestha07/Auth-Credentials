<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'ramesh@gmail.com', // Change this if needed
        ], [
            'name' => 'ramesh Basnet',
            'password' => Hash::make('ramesh123'), // Change this for security
            'role' => 'superadmin',
        ]);
    }
}
