<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class requestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('request_for_managers')->insert([
                'theme' => Str::random(10),
                'message' => Str::random(10),
                'client_name' => Str::random(10),
                'id_user'=>random_int(0,10),
                'respo'=>Str::random(10),
                'email_client' => Str::random(10).'@gmail.com',
            ]);
        } catch (\Exception $e) {
        }
    }
}
