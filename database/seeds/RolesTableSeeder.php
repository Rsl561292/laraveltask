<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'slug_system' => 'admin',
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'slug_system' => 'manager',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'slug_system' => 'user',
            ],

        ]);
    }
}
