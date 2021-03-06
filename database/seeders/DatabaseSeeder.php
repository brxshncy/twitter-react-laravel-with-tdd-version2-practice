<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'email' => 'bruce@test.com',
            'password' => bcrypt('test123'),
            'name' => 'admin bruce'
        ]);
        
    }
}
