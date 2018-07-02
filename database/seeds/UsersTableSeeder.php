<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $listRole = Role::pluck('id', 'slug_system');

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => $listRole['admin']
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => $listRole['manager']
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => $listRole['user']
            ],
        ]);
    }
}
