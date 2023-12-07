<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->truncate();
        DB::table('user_types')->insert(array (
            0 => ['name' => 'SupperAdmin'],
            1 => ['name' => 'Admin'],
            2 => ['name' => 'User']
        ));
    }
}
