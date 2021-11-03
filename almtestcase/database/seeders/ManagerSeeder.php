<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('managers')->insert([
                'nickname' => Str::random(10),
                'id_user'=>random_int(0,10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password')
            ]);
        } catch (\Exception $e) {
        }
    }
}
