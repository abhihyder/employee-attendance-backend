<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Mr. Manager',
                'email' => 'manager@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'phone' => '01245789654',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mr. Developer',
                'email' => 'developer@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'phone' => '01245789244',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ],
            
        ]);
    }
}
