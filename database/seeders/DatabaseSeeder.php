<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StorySeeder::class);

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@stories.com',
            'password' => Hash::make('admin12345'),
            'api_token' => Str::random(60),
        ]);
        $user->update([
            'is_admin' => true,
        ]);
    }
}
