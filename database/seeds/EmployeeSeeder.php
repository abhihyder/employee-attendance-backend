<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'user_id' =>1,
                'role_id' =>1,
                'branch_id' =>1,
                'designation' =>"Development Manager",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' =>2,
                'role_id' =>2,
                'branch_id' =>1,
                'designation' =>"Software Developer",
                'created_at' => now(),
                'updated_at' => now()
            ],
            
           
        ]);
    }
}
