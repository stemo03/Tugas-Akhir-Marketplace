<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User_roles;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'ADMIN',
        ]);

        $buyer = Role::create([
            'name' => 'BUYER',
        ]);

        $seller = Role::create([
            'name' => 'SELLER',
        ]);

    }
}
