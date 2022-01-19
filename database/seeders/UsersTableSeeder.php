<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = max((int)$this->command->ask('How many users would you like?', 20), 1);
        User::factory()->state([
            'name' => 'Minh Tran',
            'email' => 'test@omegatheme.com',
        ])->create();
        User::factory()->count($usersCount)->create();
    }
}
