<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(AdminSeeder::class);
        $this->AdminSeeder();
    }

    public function AdminSeeder(){
        // DB::table('users')->insert([
        //     'id' => 'usr-000000000000000000001',
        //     'first_name' => 'admin',
        //     'middle_name' => 'admin',
        //     'last_name' => 'admin',
        //     'user_name' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'password' => '$2y$10$QTmFTxmJKLQHrbF3PG.uK.mjr2h/Wa3eLW.H0b.e5/ox0SMghlKJu', //admin123
        //     'role_id' => 'rol-0001',
        //     'status_id' => 'sta-2001',
        //     ]
        // );
        // DB::table('employees')->insert([
        //     'id' => 'emp-0000000000000001',
        //     'user_id' => 'usr-000000000000000000001',
        //     'contact_number' => '09090852236',
        //     'address_id' => 'ead-00000001',
        //     'employee_position_id' => 'epo-070000000001',
        //     'birthdate' => '2000-07-19',
        //     'gender_id' => 'gen-0001',
        //     'marital_status_id' => 'mar-0001',
        //     'status_id' => 'sta-2001',
        //     'employment_status_id' => 'ems-0001',
        //     'date_hired' => '2023-05-19',
        //     ]
        // );
        // DB::table('employee_positions')->insert([
        //     'id' => 'epo-070000000001',
        //     'employee_id' => 'emp-0000000000000001',
        //     'position_id' => 'pos-23080001',
        //     'area_of_assignment_id' => 'area-20230720001',
        //     'status_id' => 'sta-1007',
        //     ]
        // );
        // DB::table('system_settings')->insert([
        //     'id' => 'sys-23070001',
        //     'embed_map_provider' => 'https://www.embedmymap.com/',
        //     ]
        // );
        DB::table('leave_types')->insert([
            'id' => 'ltp-10000001',
            'leave_type_title' => 'Vacation Leave',
            'leave_type_description' => 'Vacation Leave Description',
            'leave_days_per_year' => 15.00,
            'max_leave_days' => 15.00,
            'reset_date'=> '2023-09-06 00:00:01',
            'status_id' => 'sta-1007',
            ]
        );
        DB::table('leave_types')->insert([
            'id' => 'ltp-10000002',
            'leave_type_title' => 'Sick Leave',
            'leave_type_description' => 'Sick Leave Description',
            'leave_days_per_year' => 10.00,
            'max_leave_days' => 45.00,
            'reset_date'=> '2023-09-06 00:00:01',
            'status_id' => 'sta-1007',
            ]
        );
    }
    
}
