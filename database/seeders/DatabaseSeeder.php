<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CouriersTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(CouriersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(StoreTableSeeder::class);

    }
}
