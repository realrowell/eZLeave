<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use \app\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'id' => 'usr-00000001',
            'first_name' => 'admin',
            'middle_name' => 'admin',
            'last_name' => 'admin',
            'user_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$QTmFTxmJKLQHrbF3PG.uK.mjr2h/Wa3eLW.H0b.e5/ox0SMghlKJu', //admin123
            'role_id' => 'rol-0001',
            'status_id' => 'sta-0006',
        ]);
    }
}
