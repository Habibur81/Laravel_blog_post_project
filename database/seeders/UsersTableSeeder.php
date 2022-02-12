<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = max( (int) $this->command->ask('How many users count like?', 5), 1);
        User::factory()->defaultUser()->create();

        User::factory()->count($users)->create();
    }
}
