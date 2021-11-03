<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('users')->insert([
                'nickname' => Str::random(10),
                'type' => random_int(0, 1),
                'remember_token'=>Hash::make('token'),
                'password' => Hash::make('password')
            ]);
        } catch (\Exception $e) {
        }
    }
}
