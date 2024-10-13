<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private array $jobTitleToRole = [
        'User' => 'user',
        'Owner' => 'admin',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)
            ->create()
            ->each(fn(User $user) => $user->assignRole());
    }
}
