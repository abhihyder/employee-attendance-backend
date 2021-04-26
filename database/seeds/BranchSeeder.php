<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            [
                'branch_name' => 'Mirpur Branch',
                'branch_address' => 'Mirpur DOHS, Dhaka',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'branch_name' => 'Gulshan Branch',
                'branch_address' => 'Gulshan-2, Dhaka',
                'created_at' => now(),
                'updated_at' => now()
            ],
           
        ]);
    }
}
