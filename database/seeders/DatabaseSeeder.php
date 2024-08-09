<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profile;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'username' => 'ryan111199',
            'email' => 'ryanzulkarnaen99@gmail.com',
            'password' => Hash::make('password'),
            'ticket' => null,
            'email_verified_at' => now()
        ]);
        Profile::create([
            'user_id' => $user->id
        ]);
        Role::insert([
            ['name' => 'Member', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manager', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
