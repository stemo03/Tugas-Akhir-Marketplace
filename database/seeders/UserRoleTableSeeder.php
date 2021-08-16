<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_roles;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
             'name' => 'Admin', 
             'email'=>'stevimonicatarigan03@gmail.com', 
             'password' => bcrypt('monikamonik'), 
             'phone_number'=>'',
        ]);

        $addadmintoadmin = User_roles::create([
            'role_id' => 1,
            'user_id' => 1,
        ]);


        
    }
}
